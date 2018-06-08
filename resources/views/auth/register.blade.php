@extends('layouts.app')

@section('content')

    <form role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="register-form ">
            <p class="login-form regist-logo regist-img">
                Create your personal account
            </p>
            <p class="login-form inputs {{ $errors->has('name') ? ' has-error' : '' }} {{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required
                       autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif

                <input id="name" type="text" placeholder="User name" name="name" value="{{ old('name') }}" required>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
                <input id="password" type="password" placeholder="Password" class="form-control" name="password"
                       required>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <input id="password-confirm" type="password" placeholder="Repeat password" class="form-control"
                       name="password_confirmation" required>
            </p>


            <button class="regist-btn signup-btn" type="submit">Register</button>
            <p class="notregistered-create-account">
                <a href="{{ route('login') }}" class='link_create_account'>Sign in</a>
            </p>

        </div>
    </form>
@endsection
