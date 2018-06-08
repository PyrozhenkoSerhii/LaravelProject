@extends('profile/mainPageProfile')
@section('contentThird')
    @foreach($favoriteNews as $news)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div>
                            <h2 align="center">{{$news->title}}</h2>
                        </div>
                        <div class="" id="panel-heading"
                             style="background:url('../../../public/{{$news->img_url}}') 50% 50% no-repeat;">

                        </div>
                        <div align="center" class="panel-body">
                            <p>
                            <h3 align="justify"> {{$news->description}}</h3></p>
                            <hr>
                            <div>
                                <div style="width: 80px; color: blue; float:left;">
                                    <h4 align="left"><p><a href="{{ route('showPost',['id'=>$news->id]) }}"style="color: limegreen">More...</a></p></h4>
                                </div>

                                <div style="width: 300px; color: #a6e1ec; float:right;">
                                    <h4 align="right">{{$news->published_at}}</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop