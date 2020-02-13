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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col-1">
                <div class="develop-logo">
                    <a href="{{ route('tasks.index') }}">
                        <img src="{{ asset('img/php_elephant.svg') }}" alt="PHP task tracker logo" title="Перейти к списку текущих задач">
                    </a>
                </div>
            </div>
            <div class="col-11">
                <div class="menu_with-btn">
                    <ul class="main-menu">
                        <li{{ is_active_link(route('tasks.index')) }}><a href="{{ route('tasks.index') }}">Текущие</a></li>
                        <li{{ is_active_link(route('tasks.completed')) }}><a href="{{ route('tasks.completed') }}">Выполненные</a></li>
                        <li{{ is_active_link(route('tasks.closed')) }}><a href="{{ route('tasks.closed') }}">Закрытые</a></li>
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <li{{ is_active_link(route('users.index')) }}><a href="{{ route('users.index') }}">Пользователи</a></li>
                            <li{{ is_active_link(route('groups.index')) }}><a href="{{ route('groups.index') }}">Группы</a></li>
                        @endif
                    </ul>

                    <a href="{{ route('tasks.create') }}" class="btn btn-add btn-small with-icon">
                        {{ svg('icon-add-circle') }}
                        Добавить задачу
                    </a>

                    <div id="btn-logout" class="btn btn-exit btn-small with-icon">
                        {{ svg('icon-door-exit') }}
                        <div>
                            Выйти <span class="current-user">({{ auth()->user()->name }})</span>
                        </div>
                        <form class="hidden" action="{{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</main>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/main.min.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
