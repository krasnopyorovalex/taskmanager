<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>List of tasks - PHP task tracker</title>
    <meta name="theme-color" content="#eceff4">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="{{ asset('img/favicons/favicon-16x16.png') }}" type="image/png">
    <link rel="icon" sizes="32x32" href="{{ asset('img/favicons/favicon-32x32.png') }}" type="image/png">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('img/favicons/apple-touch-icon-precomposed.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/favicons/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicons/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicons/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicons/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicons/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicons/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicons/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicons/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('img/favicons/apple-touch-icon-167x167.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/apple-touch-icon-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="1024x1024" href="{{ asset('img/favicons/apple-touch-icon-1024x1024.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="box-login" xmlns:xlink="http://www.w3.org/1999/XSL/Transform">
                    <div class="form-login with-shadow">
                        <div class="title">Форма входа</div>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="box">
                                <label for="f-email">Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" id="f-email" autocomplete="off" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <b>{{ $errors->first('email') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="box">
                                <label for="f-password">Пароль</label>
                                <input type="password" name="password" id="f-password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <b>{{ $errors->first('password') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="box box_remember-forgot_password">
                                <div class="remember">
                                    <input type="checkbox" name="remember" id="f-remember_me" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="f-remember_me">Запомнить меня</label>
                                </div>
                                <div class="forgot-password">
                                    <a href="#">Забыли свой пароль?</a>
                                </div>
                            </div>
                            <div class="box">
                                <button type="submit" class="btn-login with-icon">
                                    <svg>
                                        <use xlink:href="../img/sprites/sprite.svg#icon-door-enter"></use>
                                    </svg>
                                    Войти
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="create_new-account">
                        <p>Нет аккаунта? <a href="#">Создать новый</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
