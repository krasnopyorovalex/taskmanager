<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ mix('css/base.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<section class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand m-0 py-2 brand-title" href="#">
                [ Управление задачами ]
            </a>
            <span></span>
        </nav>

        <nav class="navigation" >
            <ul>
                <li><a href="{{ route('tasks.index') }}"><span class="nav-icon material-icons">all_inclusive</span> Текущие</a></li>
                <li><a href="theme-setting.html"><span class="nav-icon material-icons">close</span> Закрытые</a></li>
                <li><a href="theme-setting.html"><span class="nav-icon material-icons">keyboard_return</span> Возвращенные</a></li>
            </ul>
        </nav>

    </aside>



    <!--RIGHT CONTENT AREA-->
    <div class="content-area">

        <header class="header sticky-top">
            <nav class="navbar navbar-light bg-white px-sm-4 ">
                <a class="navbar-brand py-2 d-md-none  m-0 material-icons toggle-sidebar" href="ecommerce-customers.html#">menu</a>
                <ul class="navbar-nav flex-row ml-auto">
                    <li class="nav-item ml-sm-3 "><a href="#" class="btn btn-primary">Добавить задачу</a></li>
                    <li class="nav-item ml-sm-3 "><a href="#" class="btn btn-info">Доступы</a></li>
                    <li class="nav-item ml-sm-3 user-logedin dropdown">
                        <a href="ecommerce-customers.html#" class="nav-link weight-400">
                            <img src="{{ asset('images/user.png') }}" class="mr-2 rounded" width="28">Наточка
                        </a>
                    </li>
                </ul>
            </nav>
        </header>


        @yield('content')

    </div>

</section>
<script src="{{ mix('js/app.js') }}" async></script>
</body>
</html>
