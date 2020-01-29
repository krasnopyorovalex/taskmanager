@extends('layouts.login')

@section('content')
    <!-- Simple login form -->
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
        <div class="panel panel-body login-form">
            <div class="text-center">
                <div class="login-logo">
                    <img src="{{ asset('img/logo.svg') }}" alt="Ticket Group Sales logo">
                    <span>TicketGroup</span>
                </div>
                <h5 class="content-group">Login <small class="display-block">Enter your E-mail and password</small></h5>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="form-control-feedback">
                    <i class="icon-mail5 text-muted"></i>
                </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
            </div>

            <div class="checkbox form-group has-feedback has-feedback-left">
                <label>
                    <input class="styled" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me?
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    Sign In <i class="icon-circle-right2 position-right"></i>
                </button>
            </div>

            <div class="text-left">
                <div>
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
                @if (Route::has('register'))
                    <div>
                        <a href="{{ route('register') }}">
                            Create new account
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </form>
    <!-- /simple login form -->
@endsection
