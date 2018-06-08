@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="menu" style="width: 40%; margin: auto;">
            <br><br><br><br><br>
                @foreach($adminsArray as $value)
                @if($value == Auth::user()->id)
                        <nav class="navbar navbar-default navbar-static-top">
                            <div class="container">

                                <div class="navbar-header">
                                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                        <!-- Left Side Of Navbar -->
                                        <ul class="nav navbar-nav">

                                            <li><a href="{{ route('infoPage') }}">Info</a></li>
                                            <li><a href="{{ route('postCreate') }}">Create article</a></li>
                                            <li><a href="{{ route('unpublished') }}">Unpublished posts</a></li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </nav>

                @endif
                @endforeach

        </div>

        @yield('contentSecond')

    </div>
@endsection