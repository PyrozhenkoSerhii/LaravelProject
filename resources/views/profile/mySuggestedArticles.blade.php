@extends('profile/mainPageProfile')
@section('contentThird')
    @foreach($suggestedArticles as $suggestedArticle)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div>
                            <h2 align="center">{{$suggestedArticle->title}}</h2>
                        </div>
                        <div class="" id="panel-heading"
                             style="background:url('../../../public/{{$suggestedArticle->img_url}}') 50% 50% no-repeat;">

                        </div>
                        <div align="center" class="panel-body">
                            <p>
                            <h3 align="justify"> {{$suggestedArticle->description}}</h3></p>
                            <hr>
                            <div>
                                <div style="width: 80px; color: blue; float:left;">
                                    <h4 align="left"><p><a href="{{ route('showPost',['id'=>$suggestedArticle->id]) }}"style="color: limegreen">More...</a></p></h4>
                                </div>

                                <div style="width: 300px; color: #a6e1ec; float:right;">
                                    <h4 align="right">{{$suggestedArticle->published_at}}</h4>
                                </div>

                                @if($suggestedArticle->published == 0)
                                    <div style="width: 80px; color: #a6e1ec; float:left;">
                                        <h4 align="left"> <p><a href="{{ route('postEdit',['id'=>$suggestedArticle->id])}}" style="color: orange" >Edit</a></p></h4>
                                    </div>
                                    <div style="width: 80px; color: #a6e1ec; float:left;">
                                        <h4 align="left"> <p><a href="{{ route('postDelete',['id'=>$suggestedArticle->id])}}" style="color: red" >Delete</a></p></h4>
                                    </div>
                                @else
                                    <div style="width: 80px; color: #a6e1ec; float:left;">
                                        <h4 align="center"> <p>PUBLISHED!</p></h4>
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop