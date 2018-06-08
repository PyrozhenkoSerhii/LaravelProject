@extends('layouts/app')
@section('content')

    <div id="addWord" class="addWord">
        <button style="float: right;" class="btn btn-danger" onclick="closeAddForm()">X</button>
        <br><br>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('dictionaryStore') }}">
            {{ csrf_field() }}
            <p align="center">word</p>
            <textarea class="text-center" rows="1" style="width:50%;" id="name" name="word"></textarea>
            <p align="center">translation</p>
            <textarea class="text-center" rows="1" style="width:50%;" id="name" name="translation"></textarea>
            <br><br>
            <button type="submit"  class="btn btn-primary buttonTranslate">Add</button>
        </form>
    </div>

    <br>
    <div class="container dictionary">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="container" style="width: 100%;">



                        <div style="width: 80%; float:left;">
                            <h2><p style="font-weight: bold;" align="center">My dictionary</p></h2>
                        </div>
                        <div style="width: 20%; float:left;">
                            <br>
                            <input type="button" class="btn-primary" style="height: 35px;" value="Add word" onclick="showAddForm()">
                        </div>
                    </div>

                    <hr>

                    <div class="container" style="width: 100%;">
                        <div style="width: 30%; float:left;">
                            <h4 align="center"><p style="font-weight: bold;">Word</p></h4>
                        </div>
                        <div style="width: 30%; float:left;">
                            <h4 align="center"> <p style="font-weight: bold;">Translation</p></h4>
                        </div>
                        {{--<div style="width: 5%;  float:right;">--}}
                        {{--<h4 align="left"></h4>--}}
                        {{--</div>--}}
                        {{--<div style="width: 20%; float:right;">--}}
                        {{--<h4 align="center"><p style="font-weight: bold;">Added on</p></h4>--}}
                        {{--</div>--}}
                        {{--<div style="width: 15%; float:right;">--}}
                        {{--<h4 align="center"> <p style="font-weight: bold;">Learning</p></h4>--}}
                        {{--</div>--}}


                    </div>
                    @foreach($dictionaries as $dictionary)
                        <div class="container word_translate">
                            <div style="width: 30%; float:left;">
                                <h5 class ="wordTranslate" align="center">{{$dictionary->word}}</h5>
                            </div>
                            <div style="width: 30%;  float:left;">
                                <h5 align="center">{{$dictionary->translation}}</h5>
                            </div>
                            <div style="width: 5%;  float:right;">
                                <h4 class="deleteComment" align="center"> <p><a href="{{ route('deleteWord',['id'=>$dictionary->id])}}" style="color: red" ><img src="../../public/img/delete.png"> </a></p></h4>
                            </div>
                            {{--<div style="width: 20%;  float:right;">--}}
                            {{--<h5 align="center">{{$dictionary->created_at}}</h5>--}}
                            {{--</div>--}}
                            {{--<div style="width: 15%;  float:right;">--}}
                            {{--<h5 align="center">{{$dictionary->learningPercent}}</h5>--}}
                        </div>

                @endforeach
                </div>
                <script>
                    var count = 0;
//                    document.getElementsByClassName("wordTranslate")[count].onload = colorWord();
                    function showAddForm() {
                        $("#addWord").show();
                    }
                    function closeAddForm() {
                        $("#addWord").hide();
                    }
                    function colorWord(){
                        var div = document.getElementsByClassName("wordTranslate")[count];
                        var color;
                        alert(count);
                        if(count % 2 == 0){
                            color = "#862c4c";
                        }else{
                            color = "#77305d";
                        }
                        div.style.color = color;
                        count++;
                    }

                </script>


            </div>
        </div>
    </div>
    </div>
@stop