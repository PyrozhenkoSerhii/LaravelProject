@extends('layouts/app')
@section('content')

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <input type="text" value="{{$words}}" id="input_with_words">
    <input type="text" value="{{$translations}}" id="input_with_translations">
    <input type="text" value="{{$learningPercents}}" id="input_with_learningPercents">

    <div class="container" style="border:2px solid black;min-width: 800px;min-height: 500px; margin-top: 100px;" ng-app="TranslationApp" ng-controller="TransCtrl">
        <div ng-hide="_showTest">
            {{--<div>--}}
            {{--<h1>Select 10 words:</h1>--}}
            {{--<div class="widget">--}}
            {{--<label for="tags">Tags: </label>--}}
            {{--<input id="tags">--}}
            {{--<button id="btnAdd" class="btn btn-danger">Add</button>--}}

            {{--<table id="tableForSelectedWords" class="table table-striped table-striped table-responsive table-bordered table-hover">--}}
            {{--<div class="alert alert-danger" id="alertSelectWords" hidden>--}}
            {{--You have to choose 10 words--}}
            {{--</div>--}}
            {{--<tr><th><strong>Word:</strong> </th><th><strong>Translation:</strong> </th></tr>--}}

            {{--</table>--}}

            {{--</div>--}}
            {{--</div>--}}
            {{--<button class="btn btn-success" id="submitUsersWords" ng-click="showTest()">Submit</button>--}}

            {{--<br/>--}}
            <h2 class="text-center">learn recomended words: </h2>
            <table class="table table-striped table-striped table-responsive table-bordered table-hover">
                <tr><th><strong>Word:</strong> </th><th><strong>Translation:</strong> </th></tr>
                <tr ng-cloak ng-repeat="item in wordWithTrans "><td>@{{item.word}}</td><td>@{{ item.translation }}</td></tr>
            </table>
            <button class="btn btn-success pull-right btn-lg" ng-click="showTest()"> GO  </button>
        </div>

        <div ng-show="_showTest">
            <h1>Enter translation: </h1>
            <table class="table table-hover table-bordered table-responsive table-striped ">
                <tr><th><strong>Word: </strong></th><th><strong>Translation: </strong></th></tr>
                <tr ng-cloak ng-repeat="item in wordWithTrans" class="wordsInTr"><td>@{{ item.word }}</td><td>
                        <strong>Translation:</strong> <input type="text" class="forAnswers">
                    </td></tr>
            </table>
            <button class="btn btn-success btn-lg btn-sumbit" onclick="checkAnswers()">Sumbit</button>
        </div>
    </div>

    <script>

        var _words=document.getElementById("input_with_words").getAttribute("value").split(',');
        var _translations=document.getElementById("input_with_translations").getAttribute("value").split(',');
        var _learningPercents=document.getElementById("input_with_learningPercents").getAttribute("value").split(',');
        console.log(_learningPercents);
        //alert(_learningPercents)
        var objects=getWordWIthTranslations();
        var _wordsWithTranslationObjs=get10Objs(objects);
        //alert(_wordsWithTranslationObjs.length)
        var _10WordsWithTranslationObjs;
        var _usersWordsWithTranslationObjsl;
        var _selectedWords=[];
      //  cosnole.log(_wordsWithTranslationObjs);


//        homes.sort(function(a, b) {
//            return parseFloat(a.price) - parseFloat(b.price);
//        });
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
        function getUsersWordWIthTranslations(){
            var arr=[];
            if(_words.length!=_translations.length)
                throw  new Error();
            for(var i=0;i<_selectedWords.length;i++){
                var obj={word:_selectedWords[i],translation:getTranslation(_selectedWords[i])};
                arr.push(obj);
            }
            return arr;


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

        function  checkAnswers() {
            var _answers=jQuery("input.forAnswers");
            var _wordsInTr=jQuery(".wordsInTr");
            //  alert(_answers.length)

            for(var i=0;i<_answers.length;i++){
                if(_answers[i].value!= _wordsWithTranslationObjs[i].translation){
                    jQuery(".wordsInTr:eq("+i+")").css("background","red")
                }else {
                    jQuery(".wordsInTr:eq(" + i + ")").css("background", "limeGreen")
                }
            }

        }

        jQuery("#tags").autocomplete({
            source:_words
        })

        var counter=0;
        jQuery("#btnAdd").click(function(){
            var word=jQuery("#tags").val();
            counter++;
            var translation=getTranslation(word);
            _selectedWords.push(word)
            jQuery("#tableForSelectedWords").append("<tr><td>"+word+"</td><td>"+translation+"</td> </tr>");
            //    <tr ng-cloak ng-repeat="item in wordWithTrans "><td>@{{item.word}}</td><td>@{{ item.translation }}</td></tr>
            //  console.log(_selectedWords)
        })
        jQuery("#submitUsersWords").click(function(event){
            if(counter<10) {
                $("#alertSelectWords").removeAttr("hidden")
                event.preventDefault();

            }

        })



        var app=angular.module("TranslationApp",[]);
        app.controller("TransCtrl",function ($scope) {
            $scope.wordWithTrans=_wordsWithTranslationObjs;
            $scope._showTest=false;
            $scope.showTest=function () {
                $scope._showTest=true;
            }



        })
</script>
@stop