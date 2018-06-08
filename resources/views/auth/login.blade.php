@extends('layouts.app')

@section('content')
    <form role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="register-form">
            <p class="login-form regist-logo regist-img">
                Sign in
            </p> <p class="login-form inputs {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required
                       autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                <input id="password" type="password" placeholder="Password" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <button class="regist-btn signup-btn" type="submit">Sign in</button>


            <p class="notregistered-create-account">
                <a href="{{ route('register') }}" class='link_create_account'>Create account</a>
            </p>
        </div>
    </form>
@endsection
