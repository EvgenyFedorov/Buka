<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <script src="{{ url('public/js/jquery_lib.js') }}" rel="script" type="text/javascript"></script>
    <script src="{{ url('public/js/main.js') }}" rel="script" type="text/javascript"></script>
    <link href="{{ url('public/css/bootstrapmin.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/bootstraptheme.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/bootstrapthememin.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/styles.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Laravel
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Right Side Of Navbar -->
                <!-- Authentication Links -->
            @if (Auth::guest())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/login') }}">Войти</a></li>
                    <li><a href="{{ url('/register') }}">Регистрация</a></li>
                </ul>
            @else
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/diller') }}">Диллер</a></li>
                    <li><a href="{{ url('/diller/loadbase') }}">Загрузить данные</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выйти</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    <span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Меню
                </a>
                <a href="/profile" class="list-group-item">
                    <span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;Уведомления <span class="badge">18</span>
                </a>
                <a href="/profile/adverts" class="list-group-item">
                    <span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;Мои объявления <span class="badge">{{$count_adverts}}</span>
                </a>
                <a href="#" class="list-group-item">
                    <span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Мои проекты <span class="badge">40</span>
                </a>
                <a href="/profile/dialogs" class="list-group-item">
                    <span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Сообщения <span class="badge">{{$count_dialogs}}</span>
                </a>
                <a href="#" class="list-group-item">
                    <span class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;Избранное <span class="badge">25</span>
                </a>
                <a href="#" class="list-group-item">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Партнеры
                </a>
                <a href="/profile/settings" class="list-group-item">
                    <span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Настрока учетная запись
                </a>
                <a href="#" class="list-group-item">
                    <span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Выйти
                </a>
            </div>
        </div>
        <div class="col-md-6" style="border: 1px solid #f1f1f1; padding: 20px;">
            @yield('content')
        </div>
        <div class="col-md-3">
            <div class="row left-block-advert-site">
                <div class="col-md-12 block-advert-site">1</div>
                <div class="col-md-12 block-advert-site">2</div>
                <div class="col-md-12 block-advert-site">3</div>
                <div class="col-md-12 block-advert-site">4</div>
            </div>
        </div>
    </div>
</div>

        <!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
