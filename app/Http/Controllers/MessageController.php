<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function getMessage(Message $messageModel){

        $messageArray = $messageModel->getMessages();


        return response()->json([

            'messageArray' => $messageArray
        ]);

    }

    public function deleteMessage(){
        $id = $_POST['id'];
        $message = Message::find($id);
        $message->delete();

        return response()->json([

            'text' => 'success'
        ]);
    }

    public function sendMessage(Request $request, Message $messageModel){
        $category=$request->input('category');
        $title=$request->input('title');

        $usersId = $messageModel->getUsersBySubscribedCategory($category);
        if($messageModel->writeMessage($usersId,$category,$title)){
            return true;
        }

    }

}
