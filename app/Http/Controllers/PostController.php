<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Translator;
use App\BingTranslator;
use App\HTTPTranslator;
use App\AccessTokenAuthentication;
use App\Exception;
use App\Message;
class PostController extends Controller
{
    public function published(Post $postModel)
    {
        $posts = $postModel->getPublishedPosts();
        return view('post.published', ['posts' => $posts]);
    }


    public function unpublished(Post $postModel)
    {
        $posts = $postModel->getUnpublishedPosts();
        return view('post.unpublished', ['posts' => $posts]);
    }

    public function create()
    {
        return view('post.create');
    }


    public function store(Post $postModel, Request $request, MessageController $messageController, Message $messageModel)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category' => 'required|max:255',
            'description' => 'required|max:255',
            'content' => 'required',
        ]);

        if ($request->input('published') == null) {
            Post::create([
                'title' => $request->input('title'),
                'category' => $request->input('category'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'created_by' => Auth::user()->id,

                'img_url' => $request->input('img_url'),

                'lecsics' => $request->input('lecsics'),

                'published_at' => date('Y-m-d H:i:s'),
                'published' => 0,

            ]);

            $users = User::where('isAdmin', '=', 1)->get();
                foreach ($users as $value) {
                    if ($value->id == Auth::user()->id) {
                        return redirect()->route('unpublished');
                    }
                }


            return redirect()->route('posts');
        }

        Post::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'created_by' => Auth::user()->id,

            'img_url' => $request->input('img_url'),

            'lecsics' => $request->input('lecsics'),
            'published_at' => date('Y-m-d H:i:s'),
            'published' => 1,

        ]);

        $messageController->sendMessage($request, $messageModel);

        return redirect()->route('posts');


    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
        ]);

        $id = $request->input('id');
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->category = $request->input('category');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->img_url = $request->input('img_url');
        $post->lecsics = $request->input('lecsics');


        if ($request->input('published') == 'on') {
            $post->published = '1';
            $post->published_at = date('Y-m-d H:i:s');
        }
        if ($request->input('published') == null) {
            $post->published = '0';
        }
        $post->save();

        return redirect()->route('posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', ['post' => $post]);
    }

    public function showAlonePost(Comment $commentModel, $id)
    {
        $post = Post::find($id);
        $users = User::all();
        $comments = $commentModel->getComments($id);

        return view('post.aloneArticle', ['post' => $post, 'comments' => $comments, 'users' => $users]);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return back();
    }

    public function translateText()
    {

        $text = $_POST['text'];
        $translator = new Translator('trnsl.1.1.20170519T114537Z.ca4c8a7f5e4e929a.73feaed911b49e81c00153a52057e3b7ee4f724e');
//       $translator = new Translator('trnsl.1.1.20170419T144335Z.84710e827aa22694.23b08b1c3173d7b881f0ef043734bd6b164473d7');
        $translation = $translator->translate($text, 'en-ru');

        return response()->json([
            'text' => $translation
        ]);

    }

    public function testTranslator()
    {
        $text = "designed";
        $translator = new Translator('trnsl.1.1.20170519T114537Z.ca4c8a7f5e4e929a.73feaed911b49e81c00153a52057e3b7ee4f724e');
//       $translator = new Translator('trnsl.1.1.20170419T144335Z.84710e827aa22694.23b08b1c3173d7b881f0ef043734bd6b164473d7');
        $translation = $translator->translate($text, 'en-ru');
        dd($translation);
        return $translation;
    }

    public function publishedByCategory(Post $postModel, $category)
    {
        $posts = $postModel->getPostsByCategory($category);

        return view('post.published', ['posts' => $posts]);
    }


    public function getTranslationBing()
    {
        $text = $_POST['text'];
        try {

            $clientSecret = "9d4c26596a064d049f6cce2191996d06";

            $authObj = new AccessTokenAuthentication();
            $accessToken = $authObj->getToken($clientSecret);
            $authHeader = "Authorization: Bearer " . $accessToken;

            $fromLanguage = "en";
            $toLanguage = "ru";
            $inputStr = $text;
            $contentType = 'text/plain';
            $category = 'general';

            $params = "text=" . urlencode($inputStr) . "&to=" . $toLanguage . "&from=" . $fromLanguage;
            $translateUrl = "https://api.microsofttranslator.com/v2/Http.svc/Translate?$params";

            $translatorObj = new HTTPTranslator();

            $curlResponse = $translatorObj->curlRequest($translateUrl, $authHeader);

            $xmlObj = simplexml_load_string($curlResponse);
            foreach ((array)$xmlObj[0] as $val) {
                $translatedStr = $val;
            }

            return response()->json([
                'translation' => $translatedStr
            ]);
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage() . PHP_EOL;
        }


        function curlRequest($url, $authHeader, $postData = '')
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader, "Content-Type: text/xml"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, False);
            if ($postData) {
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            }
            $curlResponse = curl_exec($ch);
            $curlErrno = curl_errno($ch);
            if ($curlErrno) {
                $curlError = curl_error($ch);
                throw new Exception($curlError);
            }
            curl_close($ch);
            return $curlResponse;
        }
    }

}
