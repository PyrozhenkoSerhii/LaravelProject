@foreach($posts as $post)
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div>
                        <h2 align="center">{{$post->title}}</h2>
                    </div>
                    <div class="" id="panel-heading" style="background:url('../../../public/{{$post->img_url}}') 50% 50% no-repeat;">
                    </div>

                    <div align="center" class="panel-body">

                        <br>
                        <p><h3 align="justify"> {{$post->description}}</h3></p>
                        <hr>
                        <div>
                            <div style="width: 80px; color: blue; float:left;">
                                <h4 align="left"> <p><a href="{{ route('showPost',['id'=>$post->id]) }}" style="color: limegreen" >More...</a></p></h4>
                            </div>
                            <!--editing-->
                            <div style="width: 80px; color: #a6e1ec; float:left;">
                                <h4 align="left"> <p><a href="{{ route('postEdit',['id'=>$post->id])}}" style="color: orange" >Edit</a></p></h4>
                            </div>
                            <div style="width: 80px; color: #a6e1ec; float:left;">
                                <h4 align="left"> <p><a href="{{ route('postDelete',['id'=>$post->id])}}" style="color: red" >Delete</a></p></h4>
                            </div>

                            <div style="width: 300px; color: #a6e1ec; float:right;">
                                <h4  align="right">{{$post->published_at}}</h4>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach