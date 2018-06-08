@extends('layouts/app')
@section('content')
    <input type="text" hidden id="english_words" value="{{$words}}">
    <input type="text" hidden id="english_translationss" value="{{$translations}}">
    <div ng-app="TrainingApp">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <div  ng-controller="TrainingCtrl" class="col-md-10 container col-md-offset-3" style="margin-top:120px; ;height: 800px;width: 800px" >
            <h1>Select mode</h1>
            <div class="row">
                {{--<div class="col-sm-6" ng-cloak ng-repeat="item in data">--}}
                {{--<div class="well">--}}
                {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}
                {{--<img ng-src="@{{item.image_url}}" class="img-responsive img-rounded">--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}
                {{--<h4>@{{item.type}}</h4>--}}
                {{--<p><strong>Description: </strong>@{{item.description}}</p>--}}
                {{--<button class="btn btn-primary pull-right"  ><a href="{{route('goToTrainingWordTranslation',['id'=>Auth::user()->id])}}">GO</a></button>--}}

                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="col-sm-6" >
                    <div class="well">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="../../../public/img/rus-eng.png" class="img-responsive img-rounded">
                            </div>
                            <div class="col-md-6">
                                <h4>Word-Translation</h4>
                                <p><strong>Description: </strong>give a correct translation to the word</p>
                                <button class="btn btn-primary pull-right"  ><a href="{{route('goToTrainingWordTranslation',['id'=>Auth::user()->id])}}">GO</a></button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6" >
                    <div class="well">
                        <div class="row">
                            <div class="col-md-6">
                                <img ng-src="http://football.hiblogger.net/img/userfiles/2007/12/18/27757/4632f2ff8bc526b042855112f871c338-4d1lh.png" class="img-responsive img-rounded">
                            </div>
                            <div class="col-md-6">
                                <h4>Cards</h4>
                                <p><strong>Description: </strong>guess the words</p>
                                <button class="btn btn-primary pull-right"  ><a href="{{route('goToTrainingCard',['id'=>Auth::user()->id])}}">GO</a></button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<button class="btn btn-primary center-block"  ng-hide="hideCardWord" ng-click="showTest()">--}}
            {{--Card Word-translation--}}
            {{--</button>--}}
            {{--<button class="btn btn-primary center-block"  ng-hide="hideCardTranslation">--}}
            {{--Card Transaltion-Word--}}
            {{--</button>--}}
            {{--<div class=" " ng-repeat="item in items" ng-hide="hideWordsForTranslation" >--}}
            {{--<div class="col-md-10 col-md-offset-1 well">--}}
            {{--<div class="col-md-6">@{{item.word}}</div>--}}
            {{--<div class="col-md-6"> @{{item.translation}}</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<button class="btn btn-success" ng-hide="hideGoButton" ng-click="">Go</button>--}}
        </div>

        <script>
            var app=angular.module("TrainingApp",[]);
            app.controller("TrainingCtrl",function ($scope) {


//        $scope.words=document.getElementById("english_words").getAttribute("value").split(',');
//        $scope.translations=document.getElementById('english_translationss').getAttribute('value').split(',');
//        $scope.hideCardWord=false;
//        $scope.hideCardTranslation=false;
//        $scope.hideWordsForTranslation=true;
//        $scope.showTest=function(){
//            $scope.hideCardWord=true;
//           // alert($scope.words[2])
//            $scope.hideCardTranslation=true;
//            $scope.hideWordsForTranslation=false;
//            $scope.hideGoButton=false;
//            getItems();
//        }
//        $scope.hideGoButton=true;
//        $scope.items=[];
//
//
//
//        function getItems(){
//            for(var i=0;i<$scope.words.length;i++){
//                $scope.items.push({word:$scope.words[i],translation:$scope.translations[i]});
//            }
//
//        }
                data=[{type:"Word-Translation",image_url:"http://media.istockphoto.com/illustrations/translation-word-cloud-concept-illustration-id663661582",description:"dsvdsbvdsbvdsbdfsbdfbdfbdf",route:""},
                    {type:"Translation-Word",image_url:"http://www.k-international.com/wp-content/uploads/2014/09/translation-word-cloud1.jpg",description:"agfvdsgvdsvdsbvdsbvdsbvdsbvdsbvdsbvds",route:""},
                    {type:"Word constructor",image_url:"http://www.javatpoint.com/images/core/constructor.jpg",description:"dsgvdsbdfsbdfsbvrfgherbgerkughrigilur",route:""},
                    {type:"Cards",image_url:"http://i2.kym-cdn.com/photos/images/facebook/001/006/063/1fe.png",description:"best practise",route:""}
                ]

            })
        </script>

    </div>

@stop