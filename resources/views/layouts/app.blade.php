<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WhatsHappened') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/regandsign.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--<script src="../../../public/js/globalLayoutScripts.js"></script>-->


    <style>

        .h2{
            font-family: Georgia;
        }
        .h3{
            font-family: Georgia;
        }

        .info, .success, .warning, .error, .validation {
            border: 1px solid;
            margin: 10px 0px;
            padding: 15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
        }

        .info {
            color: #00529B;
            background-color: #BDE5F8;
            background-image: url('../../../public/img/infoMessage.png');
        }

        /* Cначала обозначаем стили для IE8 и более старых версий
т.е. здесь мы немного облагораживаем стандартный чекбокс. */
        .checkbox {
            vertical-align: top;
            margin: 0 3px 0 0;
            width: 17px;
            height: 17px;
        }

        /* Это для всех браузеров, кроме совсем старых, которые не поддерживают
        селекторы с плюсом. Показываем, что label кликабелен. */
        .checkbox + label {
            cursor: pointer;
        }

        /* Далее идет оформление чекбокса в современных браузерах, а также IE9 и выше.
        Благодаря тому, что старые браузеры не поддерживают селекторы :not и :checked,
        в них все нижеследующие стили не сработают. */

        /* Прячем оригинальный чекбокс. */
        .checkbox:not(checked) {
            position: absolute;
            opacity: 0;
        }

        .checkbox:not(checked) + label {
            position: relative; /* будем позиционировать псевдочекбокс относительно label */
            padding: 0 0 0 60px; /* оставляем слева от label место под псевдочекбокс */
        }

        /* Оформление первой части чекбокса в выключенном состоянии (фон). */
        .checkbox:not(checked) + label:before {
            content: '';
            position: absolute;
            top: -4px;
            left: 0;
            width: 50px;
            height: 26px;
            border-radius: 13px;
            background: #CDD1DA;
            box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2);
        }

        /* Оформление второй части чекбокса в выключенном состоянии (переключатель). */
        .checkbox:not(checked) + label:after {
            content: '';
            position: absolute;
            top: -2px;
            left: 2px;
            width: 22px;
            height: 22px;
            border-radius: 10px;
            background: #FFF;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .3);
            transition: all .2s; /* анимация, чтобы чекбокс переключался плавно */
        }

        /* Меняем фон чекбокса, когда он включен. */
        .checkbox:checked + label:before {
            background: deepskyblue;
        }

        /* Сдвигаем переключатель чекбокса, когда он включен. */
        .checkbox:checked + label:after {
            left: 26px;
        }

        /* Показываем получение фокуса. */
        .checkbox:focus + label:before {
            box-shadow: 0 0 0 3px rgba(155, 100, 0, .5);
        }

    </style>
</head>
<body>
<div id="messagesBlock" class="messagesBlock" style="cursor: pointer;background-color: whitesmoke; display: none;font-weight:
    bold !important;margin-right: 10px;position: fixed;text-align: center;top: 25%; right:80%;width: 18%; z-index: 10;">

</div>


@if(Auth::guest())
    <div class="" style="background-color: whitesmoke">
        @endif
        <header class="header" id="header">
            <p class="logo header"><a href="{{ url('/') }}"><img src="../../../public/img/logo.png"></a></p>
            <p class="header loginregistr">
                @if (Auth::guest())
                    <a href="{{ route('login') }}">Sign In</a>
                    <a href="{{ route('register') }}" id="registration">Registration</a>
            @else

                <li class="dropdown dropdown-toggle loginregistr menu__list2">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu menu__drop2" role="menu">
                        {{--isUser--}}
                        @foreach($usersArray as $value)
                            @if($value == Auth::user()->id)
                                <li><a href="{{ route('postCreate') }}" class="">Propose news</a></li>
                            @endif
                        @endforeach

                        {{--isAdmin--}}
                        @foreach($adminsArray as $value)
                            @if($value == Auth::user()->id)
                                <li><a href="{{ route('adminPage') }}" class="">Admin page</a></li>
                            @endif
                        @endforeach

                        {{--isNotGuest--}}
                        <li><a href="{{ route('goToTraining',['id'=>Auth::user()->id]) }}"
                               class="">Training</a></li>
                        <li><a href="{{ route('showDictionary',['id'=>Auth::user()->id]) }}"
                               class="">Dictionary</a></li>
                        <li><a href="{{ route('editProfile') }}" class="">My profile</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>


                    </ul>
                </li>
            @endif
            <div class="main_menu">
                <a href="{{ route('postsByCategory',['name'=>'nature']) }}"><p class="item_of_menu">Nature</p></a>
                <a href="{{ route('postsByCategory',['name'=>'policy']) }}"><p class="item_of_menu">Policy</p></a>
                <a href="{{ route('postsByCategory',['name'=>'sport']) }}"><p class="item_of_menu">Sport</p></a>
                <a href="{{ route('postsByCategory',['name'=>'fashion']) }}"><p class="item_of_menu">Fashion</p></a>
                <a href="{{ route('postsByCategory',['name'=>'cars']) }}"><p class="item_of_menu">Cars</p></a>
                <a href="{{ route('postsByCategory',['name'=>'world']) }}"><p class="item_of_menu">World</p></a>
            </div>
        </header>
        {{--</div>--}}
        <div id="header_flow">
            <div class="img_logo list"><a href="#"><img src="../../../public/img/logo1.jpg"></a>
            </div>
            <ul class="list_menu_flow">
                <a href="{{ route('postsByCategory',['name'=>'nature']) }}">
                    <li class="list">Nature</li>
                </a>
                <a href="{{ route('postsByCategory',['name'=>'policy']) }}">
                    <li class="list">Policy</li>
                </a>
                <a href="{{ route('postsByCategory',['name'=>'sport']) }}">
                    <li class="list">Sport</li>
                </a>
                <a href="{{ route('postsByCategory',['name'=>'fashion']) }}">
                    <li class="list">Fashion</li>
                </a>
                <a href="{{ route('postsByCategory',['name'=>'cars']) }}">
                    <li class="list">Cars</li>
                </a>
                <a href="{{ route('postsByCategory',['name'=>'world']) }}">
                    <li class="list">World</li>
                </a>
            </ul>
            @if(Auth::guest())
            @else
                <li class="dropdown dropdown-toggle loginregistr menu__list2">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu menu__drop2" role="menu">
                        {{--isUser--}}
                        @foreach($usersArray as $value)
                            @if($value == Auth::user()->id)
                                <li><a href="{{ route('postCreate') }}" class="">Propose news</a></li>
                            @endif
                        @endforeach

                        {{--isAdmin--}}
                        @foreach($adminsArray as $value)
                            @if($value == Auth::user()->id)
                                <li><a href="{{ route('adminPage') }}" class="">Admin page</a></li>
                            @endif
                        @endforeach

                        {{--isNotGuest--}}
                        <li><a href="{{ route('goToTraining',['id'=>Auth::user()->id]) }}"
                               class="">Training</a></li>
                        <li><a href="{{ route('showDictionary',['id'=>Auth::user()->id]) }}"
                               class="">Dictionary</a></li>
                        <li><a href="{{ route('editProfile') }}" class="">My profile</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </div>

        <button style="background:url('../../../public/img/message2.png') no-repeat;background-size: 100%;
        border: 0px; outline: none;height: 100%; position: fixed;text-align: center;top: 15%; right:94%;width:5%; z-index: 10;"
                onclick=showMessages()></button>


        @yield('content')
        <p id="selectedText" style="visibility: hidden;"></p>
        <!-- Scripts -->
        <script>


            $(document).ready(getMessage());
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            function getMessage() {

                $.ajax({
                    type: 'GET',
                    url: 'http://whatshappened/public/getMessage',
                    data: {_token: CSRF_TOKEN},
                    dataType: 'json',
                    success: function (data) {

                        $.each(data.messageArray, function (key, value) {
                            $text = value.text;
                            $id = value.id;
                            $("<div/>", {
                                "class": "info",
                                "id": $id,
                                text: $text,
                                click: function () {
                                    $(this).remove();
                                    deleteMessage(this.id);

                                }
                            }).appendTo("#messagesBlock");


                        });


                    }
                });


            }
            function deleteMessage(thisId) {

                $.ajax({
                    type: 'POST',
                    url: 'http://whatshappened/public/deleteMessage',
                    data: {'id': thisId, _token: CSRF_TOKEN},
                    dataType: 'json',
                    success: function (data) {

                    }
                });
            }

        </script>

        <script>
            function showMessages() {
                if ($("#messagesBlock").css("display") == 'none') {
                    $("#messagesBlock").show();
                } else {
                    $("#messagesBlock").hide();
                }

            }
        </script>

        <script>
            function getSelectionText() {
                var text = "";
                if (window.getSelection) {
                    text = window.getSelection().toString();
                } else if (document.selection && document.selection.type != "Control") {
                    text = document.selection.createRange().text;
                }

                return text;
            }

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


            function translate(text, time) {
                $.ajax({
                    type: 'POST',
                    url: 'http://whatshappened/public/post/getTranslationBing',
                    data: {text: text, _token: CSRF_TOKEN},
                    dataType: 'json',
                    success: function (data) {
                        document.getElementById("translatedContent").innerHTML = "<h4>" + data.translation;
                        $("#robinzon").show();
                        setTimeout('$("#robinzon").fadeOut("slow")', time);
                    }
                });
            }

            function createDiv() {
                $('body').append("" +
                    "<div id='robinzon'>" +

                    "<div style='display:block;height:100%;'>" +
                    "<button id='addWordButton' class='btn-primary' style='border-radius: 60%; opacity: 50%;' onclick='addWord()'><h5>+</h5></button>" +
                    "<div id='translatedContent' style='display:table-cell;vertical-align:middle;width:150px;'></div>" +

                    "</div>" +


                    "</div>");
                $("#robinzon").css({
                    "width": "150px",
                    "height": "150px",
                    "background": "none repeat scroll 0% 0% rgba(0, 0, 0, 0.6)",
                    "position": "fixed",
                    "display": "none",
                    "top": "45%",
                    "left": "45%",
                    "z-index": "999",
                    "text-align": "center",
                    "color": "white",
                    "font-family": "Segoe Ui",
                    "font-size": "22px",
                    "font-weight": "100",
                    "padding": "20px",
                    "border-radius": "85px"
                });
            }


            $(".container").mousedown(function () {
                $("#robinzon").css({"width": "150px", "height": "150px", "border-radius": "85px"});
                $("#translatedContent").css({"width": "150px"});
                $(".container").mouseup(function () {

                    if (document.getElementById("robinzon") == null) {
                        createDiv();
                    }
                    var textToTranslate = getSelectionText();
                    document.getElementById("addWordButton").innerHTML = '+';
                    document.getElementById("selectedText").innerHTML = textToTranslate;


                    if (textToTranslate != "") {
                        if (textToTranslate.length > 25 && textToTranslate.length < 100) {
                            $("#robinzon").css({"width": "250px", "height": "250px", "border-radius": "150px"});
                            $("#translatedContent").css({"width": "250px"});
                            translate(textToTranslate, 3500);
                        }
                        if (textToTranslate.length > 100) {
                            $("#robinzon").css({"width": "350px", "height": "350px", "border-radius": "200px"});
                            $("#translatedContent").css({"width": "300px"});
                            translate(textToTranslate, 10000);
                        }
                        translate(textToTranslate, 2000);
                    }
                });
            });

            $(".container").dblclick(function () {
                $("#robinzon").css({"width": "150px", "height": "150px", "border-radius": "85px"});
                $("#translatedContent").css({"width": "150px"});
                if (document.getElementById("robinzon") == null) {
                    createDiv();
                }
                var textToTranslate = getSelectionText();
                document.getElementById("addWordButton").innerHTML = '+';
                document.getElementById("selectedText").innerHTML = textToTranslate;


                if (textToTranslate != "") {
                    translate(textToTranslate, 2000);
                }
            });


            function addWord() {
                var word = document.getElementById("selectedText").textContent;
                var translation = document.getElementById("translatedContent").textContent
                translation = translation.trim();


                $.ajax({
                    type: 'POST',
                    url: 'http://whatshappened/public/dictionary/storeFromArticle',
                    data: {word: word, translation: translation, _token: CSRF_TOKEN},
                    dataType: 'json',
                    success: function (data) {
                        document.getElementById("addWordButton").innerHTML = '✓';
                    }
                });


            }


            function addToFavorite(post_id) {

                var button = document.getElementById("favoriteButton");
                if (button.textContent == '☆') {
                    button.textContent = '★';


                    $.ajax({
                        type: 'POST',
                        url: 'http://whatshappened/public/post/addToFavorite',
                        data: {post_id: post_id, _token: CSRF_TOKEN},
                        dataType: 'json',
                        success: function (data) {

                        }
                    });

                } else {
                    button.textContent = '☆';

                    $.ajax({
                        type: 'POST',
                        url: 'http://whatshappened/public/post/deleteFromFavorite',
                        data: {post_id: post_id, _token: CSRF_TOKEN},
                        dataType: 'json',
                        success: function (data) {

                        }
                    });
                }
            }


        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
