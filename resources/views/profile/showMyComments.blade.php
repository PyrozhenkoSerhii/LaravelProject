@extends('profile/mainPageProfile')
@section('contentThird')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 ">
                <div class="panel panel-default" style="border-width:0px;">
                    {{--<h4 align="center">Comments</h4>--}}

                    <div style="width: 100%; color: black; display: block;">
                        @foreach($comments as $comment)
                            <p hidden>{{$name = Auth::user()->name}}</p>

                            @foreach($posts as $post)
                                @if($post->id==$comment->post_id)
                                    <p hidden>{{$name = $name .= ' to article: '}}</p>
                                    <p hidden>{{$articlesName = $name .= $post->title}}</p>
                                @endif
                            @endforeach


                            <div class="comment">
                                <div name="name" style="width: 95%; color: black; font-size: 12px;">
                                    <h5 align="left" style="text-align: center"><a
                                                href="{{ route('showPost',['id'=>$comment->post_id]) }}"
                                                style="color: deepskyblue">{{$name}}</a>
                                    </h5>

                                </div>
                                <div class="image" name="left" style="width:12%; float: left;">
                                    <img src="../../../public/img/photo.jpg">
                                </div>

                                <div name="read">
                                    <textarea align="right" class="text-center" rows="4">{{$comment->text}}</textarea>
                                </div>
                                <div class="container" style="width:100%;">
                                    <div name="added_on" style="width: 20%;float:left;">
                                        <h6>{{$comment->created_at}}</h6>
                                    </div>
                                    <div style="width: 5%; color: black; float:right;">
                                        @if(Auth::user()->id==$comment->created_by)
                                            <h5 class="deleteComment" style="color: red;"><a style="color:red;"
                                                                                             href="{{ route('commentDelete',['id'=>$comment->id]) }}"><img src="../../../public/img/delete.png"></a>
                                            </h5>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>

        <script>
            function deleteComment() {
                //todo delete comment uses ajax
            }
        </script>

@stop