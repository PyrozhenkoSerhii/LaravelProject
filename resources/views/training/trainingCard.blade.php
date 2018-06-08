@extends('layouts/app')
@section('content')

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
    <input type="text" value="{{$words}}" id="input_with_words">
    <input type="text" value="{{$translations}}" id="input_with_translations">
    <input type="text" value="{{$learningPercents}}" id="input_with_learningPercents">
    <div class="container " ng-cloak style="min-width: 800px;min-height: 500px; margin-top: 100px;" ng-app="TranslationApp" ng-controller="TransCtrl">
        {{--<div class="card" ng-repeat="item in wordWithTrans">--}}
        {{--<div class="front">--}}
        {{--<h1 class="_w"></h1>--}}
        {{--</div>--}}
        {{--<div class="back" >--}}
        {{--<h1 class="_tr"></h1>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-4 col-md-offset-4">
            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>

            <div class="_card" >
                <div class="front">
                    <h1 class="_w">sdgdsgdsgdsg</h1>
                </div>
                <div class="back" >
                    <h1 class="_tr">dsgdsgdsgdsg}</h1>
                </div>
            </div>
        </div>
    </div>
    <script>


        var _words=document.getElementById("input_with_words").getAttribute("value").split(',');
        var _translations=document.getElementById("input_with_translations").getAttribute("value").split(',');
        var _learningPercents=document.getElementById("input_with_learningPercents").getAttribute("value").split(',');
        var _wordsWithTranslationObjs=getWordWIthTranslations();


        var objects=getWordWIthTranslations();
        var _wordsWithTranslationObjs=get10Objs(objects);
        function get10Objs(_arr){
            _arr.sort(function (a,b) {
                return +a.learningPercent- +b.learningPercent;
            })
            var arr=[];
            for(var i=0;i<_arr.length;i++){
                arr.push(_arr[i]);
                if(i==9)
                    break;
            }



            return arr;
        }
        jQuery(
            jQuery("._card").flip({
                axis:'y',
                trigger:'click'
            }),
            jQuery(".front").css("border","2px solid blue").css("margin","40px"),
            jQuery(".back").css("border","2px solid green").css("margin","40px")

        )


        //jQuery("#_w").val(_words[0])

        var cards=document.getElementsByClassName('.card');
        var wInCards=document.getElementsByClassName('_w');
        var tInCards=document.getElementsByClassName('_tr');
        for(var i=0;i<wInCards.length;i++){
            wInCards[i].innerHTML=_words[i];
            tInCards[i].innerHTML=_translations[i];
        }


        function getWordWIthTranslations(){
            var arr=[];
            if(_words.length!=_translations.length)
                throw  new Error();
            for(var i=0;i<_words.length;i++){
                var obj={word:_words[i],translation:_translations[i],learningPercent:_learningPercents[i]};
                arr.push(obj);
            }
            return arr;


        }

        var app=angular.module("TranslationApp",[]);
        app.controller("TransCtrl",function ($scope) {
            $scope.wordWithTrans=_wordsWithTranslationObjs;


        })

    </script>









@stop