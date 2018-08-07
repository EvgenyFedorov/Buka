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
<!--script src="{{ url('public/js/jquery_lib.js') }}" rel="script" type="text/javascript"></script-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
        <div class="col-md-9" style="">
            @yield('content')
        </div>
        <div class="col-md-3">
            <div class="row left-block-advert-site">
                <div class="col-md-12 block-advert-site" style="text-align: center;">
                    <div class="row" style="padding: 0 20px 0 20px;">
                        <div class="add-product-cart-page" id="" onclick="yaCounter44302729.reachGoal('addToCartInProductsPage'); return true;" style="font-size: 16px; height: auto; color: #999; padding: 7px; margin-top: 10px;">
                            <i style="margin-left: 5px;" class="glyphicon glyphicon-user"></i>&nbsp;
                            <h3 style="font-weight: normal; font-size: 16px; margin: 0; display: inline-block;">{{$project->user_info_f_name}}&nbsp;{{$project->user_info_name}}</h3>
                        </div>
                    </div>
                    @if(isset($user['id_group']))
                        <div class="row" style="padding: 0 20px 0 20px; margin-top: 20px;">
                            <div class="hover-shadow add-partner" id="{{$project->id_investor_proj}}" style="font-size: 16px; cursor: pointer; height: auto; background: #fff; color: #999; border: 1px solid #cecece; padding: 7px; margin-top: 0px;">
                                Добавить в партнеры&nbsp;<i style="margin-left: 5px;" class="glyphicon glyphicon-star"></i>
                            </div>
                        </div>
                    @endif
                    <div class="row" style="padding: 0 20px 0 20px;">
                        <hr style="margin-bottom: 0;">
                    </div>
                    <div class="row" style="padding: 20px 20px 0 20px;">
                        <div class="hover-shadow show-phone phone-{{$project->id_investor_proj}}" id="{{$project->id_investor_proj}}" style="font-size: 16px; cursor: pointer; height: auto; background: #fff; color: #039ad3; border: 1px solid #039ad3; padding: 7px; margin-top: 0px;">
                            Показать номер телефона&nbsp;<i style="margin-left: 5px;" class="glyphicon glyphicon-phone-alt"></i>
                        </div>
                        <div id="block-phone" style="display: none; font-size: 20px; height: auto; background: #fff; color: #039ad3; padding: 7px; margin-top: 0;"></div>
                    </div>
                    <div class="row" style="padding: 20px 20px 0 20px; margin-bottom: 20px;">
                        <div class="hover-shadow send-message" id="{{$project->id_investor_proj}}" style="font-size: 16px; cursor: pointer; height: auto; background: #5cb85c; color: #fff; border: 1px solid #039ad3; padding: 7px; margin-top: 0px;">
                            Написать инвестору&nbsp;<i style="margin-left: 5px;" class="glyphicon glyphicon-comment"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 block-advert-site">2</div>
                <div class="col-md-12 block-advert-site">3</div>
                <div class="col-md-12 block-advert-site">4</div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScripts -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script-->
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script-->
<!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script-->
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
