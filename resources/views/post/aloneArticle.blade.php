@extends('layouts/app')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 post">
                <div class="panel panel-default">
                    <div>
                        <h2 align="center">{{$post->title}}</h2>
                    </div>
                    <div class="" id="panel-heading" style="background:url('../../../public/{{$post->img_url}}') 50% 50% no-repeat;">

                    </div>

                    <!--read an article-->
                    <div align="center" class="panel-body">
                        <p><h3 align="justify" id="hWithArticle"> {{$post->content}}</h3></p>
                        <hr>
                        <div>
                            <div style="width: 100px; color: #a6e1ec; float:left;">
                                @if($post->published == 0)
                                    <h4 align="left"> <p><a href="{{ route('unpublished') }}" style="color: blue" >Back</a></p></h4>
                                @endif
                                @if($post->published == 1)
                                    <h4 align="left"> <p><a href="{{ route('posts') }}" style="color: blue" >Back</a></p></h4>
                                @endif
                            </div>
                            <div style="width: 80px; color: blue; float:left;">
                                <button id="favoriteButton" class="btn btn-default" onclick="addToFavorite({{$post->id}})">☆</button>
                            </div>

                            <!--editingIfAdmin-->
                            @if (!Auth::guest())
                                @foreach($adminsArray as $value)
                                    @if($value == Auth::user()->id)

                                        <div style="width: 100px; color: #a6e1ec; float:left;">
                                            <h4 align="left"> <p><a href="{{ route('postEdit',['id'=>$post->id])}}" style="color: orange" >Edit</a></p></h4>
                                        </div>
                                        <div style="width: 100px; color: #a6e1ec; float:left;">
                                            <h4 align="left"> <p><a href="{{ route('postDelete',['id'=>$post->id])}}" style="color: red" >Delete</a></p></h4>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <div style="width: 300px; color: #a6e1ec; float:right;">
                                <h4  align="right">{{$post->published_at}}</h4>
                            </div>
                        </div>
                        <br><br>
                        <hr>


                        <div id="divForLecsics" style="margin-top: 10px;" class="text-center text-danger">
                            <ol id="listForLecsics" ></ol >
                        </div>

                        <hr>
                        <!--read a comments-->
                        <h4 align="center">Comments</h4>

                        <div style="width: 100%; color: black; display: block;">
                            @foreach($comments as $comment)
                                <p hidden>{{$name = 4}}</p>
                                @foreach($users as $user)
                                    @if($comment->created_by == $user->id)
                                        <p hidden>{{$name = $user->name}}</p>
                                    @endif
                                @endforeach

                                <div class="comments" style="width: 100%; color: black;">
                                    <div name="name" style="width: 95%; color: black; font-size: 12px;">
                                        <h5 align="left">{{$name}}</h5>
                                    </div>
                                    <div class="image" name="left" style="width:12%; float: left;">
                                        <img src="../../../public/img/photo.jpg">
                                    </div>

                                    <div name="read">
                                        <textarea align="left" class="text-center" rows="4">{{$comment->text}}</textarea>
                                    </div>
                                    <div class="added_on" name="added_on">
                                        <h6>{{$comment->created_at}}</h6>
                                    </div>
                                    <div name="delete" style="width: 5%; color: black; float:right;">
                                        @if (!Auth::guest())
                                            <p hidden>{{$alreadyExist = false}}}

                                            @foreach($adminsArray as $value)
                                                @if($value == Auth::user()->id)
                                                    <h5 style="color: red;"><a style="color:red;" href="{{ route('commentDelete',['id'=>$comment->id]) }}">X</a></h5>

                                                    <p hidden>{{$alreadyExist = true}}}</p>
                                                @endif
                                            @endforeach

                                            @if(!$alreadyExist){

                                            @if(Auth::user()->id==$comment->created_by)
                                                <h5 class="deleteComment" style="color: red;"><a style="color:red;" href="{{ route('commentDelete',['id'=>$comment->id]) }}"><img src="../../../public/img/delete.png"></a></h5>
                                            @endif
                                            @endif
                                        @endif
                                    </div>

                                </div>
                            @endforeach

                        </div>
                        <br>
                        <hr style="color:black" width="100%">
                    {{-- <a href = "{{route('testTranslator')}}">testTranslator</a>--}}
                    <!--write a comment-->
                        @if (!Auth::guest())

                            <div class="panel panel-default" style="width: 80%; color: black;">

                                <h4 align="center">Write a comment</h4>

                                <form class="form-horizontal" role="form" method="POST" action="{{ route('commentStore') }}">

                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <textarea class="text-center" rows="0" cols="50" id="name" name="post_id" hidden>{{$post->id}}</textarea>
                                    <textarea class="text-center" rows="0" cols="50" id="name" name="created_by" hidden>{{Auth::user()->id}}</textarea>

                                    <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                        <textarea rows="3" class="text-center" id="name" name="text" style=" width:90%;"></textarea>

                                        @if ($errors->has('text'))
                                            <span class="help-block">
                                                        <strong>{{ $errors->first('text') }}</strong>
                                                    </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-primary">
                                                Sent
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        @else
                            <h4 align="center">You should to <a href="{{ route('login') }}">login</a> to write a comments</h4>
                        @endif
                        <p id="selectedText" style="visibility: hidden;"></p>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Favorite-->
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function showFavorite(post_id) {
            var button = document.getElementById("favoriteButton");
            $.ajax({
                type: 'POST',
                url: 'http://whatshappened/public/post/getFavorite',
                data: {post_id: post_id, _token: CSRF_TOKEN},
                dataType: 'json',
                success: function (data) {

                    if (data.text == 'true') {
                        button.textContent = '★';
                    } else {
                        button.textContent = '☆';
                    }
                }
            });
        }
    </script>

    <!--For lecsics-->
    <input type="text" id="_lecsics" hidden value="{{$post->lecsics}}">
    <script>
        if(document.getElementById('_lecsics').getAttribute('value')!= "") {
            jQuery(function () {

                var text = document.getElementById('hWithArticle').innerText;

                var _lecsics = document.getElementById('_lecsics').getAttribute('value').replace(/\=/gi, '-');

                var lecsics = _lecsics.split('%');
                var _lecsics_arr = _lecsics.split("%");


                //Each lecsics to div
                for (var i = 0; i < _lecsics_arr.length; i++) {

                    var div = document.getElementById('listForLecsics');
                    div.innerHTML += '<li style="font-size:20px;">' + _lecsics_arr[i] + '</li>' + "\n\n";
                }

                var _words = [];
                var _translations = [];
                for (var i = 0; i < _lecsics_arr.length; i++) {
                    var _splited = _lecsics_arr[i].split('-');
                    _words.push(_splited[0]);
                    _translations.push(_splited[1]);
                }

                for (var i = 0; i < _words.length; i++) {
                    text = document.getElementById('hWithArticle').innerHTML;
                    document.getElementById('hWithArticle').innerHTML = wrapSubstring(text, "u", text.indexOf(_words[i]), text.indexOf(_words[i]) + _words[i].length);
                }


            })

            function wrapSubstring(sourceString, tag, startIndex, endIndex) {
                return sourceString.substring(0, startIndex)
                    + "<" + tag + " >"
                    + sourceString.substring(startIndex, endIndex)
                    + "</" + tag + ">"
                    + (endIndex ? sourceString.substring(endIndex) : "");
            }
        }
    </script>
    <script>
        showFavorite({{$post->id}});
    </script>

@stop