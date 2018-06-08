@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="menu" style="width: 40%; margin: auto;">
            <br><br><br><br><br>
            <div class="profile_PROFILE">PROFILE</div>
            <div class="profile">
                <div class="avatar profile_item">

                </div>
                <div class="profile_name"><p class="user_name">{{ Auth::user()->name }} </p></div>
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container">

                        <div class="navbar-header">
                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="nav navbar-nav">

                                    <li><a href="{{ route('editProfile') }}">Edit profile</a></li>
                                    <li><a href="{{ route('showFavoriteNews') }}">Favorite</a></li>
                                    <li><a href="{{ route('showSuggestedArticles') }}">Suggested articles</a></li>
                                    <li><a href="{{ route('showMyComments') }}">My comments</a></li>
                                    <li><a href="{{ route('showSubscribes') }}">Subscription</a></li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </nav>
            </div>

        </div>

        @yield('contentThird')

    </div>
@endsection