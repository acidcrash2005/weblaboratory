<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('/') }}/css/jQuizler.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/main.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.css">


    <!-- Scripts -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<div class="b-header">
    <div class="b-logo"><a href="/"><img src="{{ url('/') }}/img/logo_light1.png" width="140" alt=""/></a></div>
    <div class="b-user-block">
        <div class="b-search">
            <a href="#" class="b-search-button"></a>
        </div>
        @if (Route::has('login'))
            <!-- Authentication Links -->
            @if (Auth::guest())
                    <div class="b-login-block">
                        {{--
                        data-toggle="modal" data-target="#modalLogin"
                        data-toggle="modal" data-target="#modalReg"
                        --}}
                        <a href="{{ url('/login') }}" >Войти</a>
                        <span>/</span>
                        <a href="{{ url('/register') }}" >Регистрация</a>
                    </div>

            @else
                    <div class="b-avatar">
                        <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="/img/{{Auth::user()->avatar}}?w=42" alt=""/></a>
                        {{--<ul class="b-drop-menu-ava dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">--}}
                        {{--<li><a href="#">Мезенин Дмитрий<small>Личный кабинет</small></a></li>--}}
                        {{--<li><a href="#" data-toggle="modal" data-target="#modalNewPass">Новый пароль</a></li>--}}
                        {{--<li><a href="#">Выход</a></li>--}}

                        {{--
                        <li><a href="#" data-toggle="modal" data-target="#modalNewPass">Админ панель</a></li>
                        </ul>

                        --}}
                    <ul class="b-drop-menu-ava dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                    <li><a href="{{ url('/profile') }}">{{ Auth::user()->email }}<small>Личный кабинет</small></a></li>
                    @if (Auth::user()->role_id == 1)
                            <li><a href="{{ url('/admin') }}">Админ панель</a></li>
                    @endif
                    <li><a href="{{ url('/user_page') }}">Кабинет обучения</a></li>

                    <li>

                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Выход
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
                    </div>
            @endif

        @endif
    </div>

    <div class="b-menu">
        <?= Menu::display('main_menu'); ?>

        {{--<ul>--}}
            {{--<li><a href="#">Курсы</a></li>--}}
            {{--<li><a href="#" class="b-star">IT Stars</a></li>--}}
            {{--<li><a href="#">Блог</a></li>--}}
            {{--<li><a href="#">О проекте</a></li>--}}
        {{--</ul>--}}
    </div>
</div>

@yield('content')



<div class="b-footer">
    <div class="b-container">
        <div class="b-footer-log"><a href="/"><img src="{{ url('/') }}/img/logo_light1.png" width="140" alt=""/></a></div>

        <div class="b-footer-menu">
            <ul>
                <li><a href="#">Курсы</a></li>
                <li><a href="#">IT Starz</a></li>
                <li><a href="#">Блог</a></li>
                <li><a href="#">О проекте</a></li>
            </ul>
        </div>

        <div class="b-social">
            <ul>
                <li><a href="#" class="b-vk">Мы Вконтакте</a></li>
                <li><a href="#" class="b-tw">Мы в Twitter</a></li>
                <li><a href="#" class="b-fb">Мы в Facebook</a></li>
            </ul>
        </div>

        <div class="b-coperate">© «Web Laboratory». 2015. Все права защищены</div>
    </div>
</div>

<div class="modal fade" id="modalNewPass" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p class="b-modal-title">Новый пароль</p>
            </div>
            <div class="modal-body">
                <form class="b-login-form" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control form-control1" placeholder="Пароль">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control1" placeholder="Подтвердите пароль">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg">Изменить пароль</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




    <!-- Scripts -->
    <script src="/vendor/tcg/voyager/assets/lib/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/jquery.fancybox.min.js"></script>
    <script src="{{ url('/') }}/js/jQuizler.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/script.js"></script>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<script>
    window.senderCallback = function() {
        SenderWidget.init({
            companyId: "i52140507387"
        });
    }
</script>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        js = d.createElement(s);
        js.id = id;
        js.src = "https://widget.sender.mobi/build/init.js";
        fjs.parentNode.insertBefore(js, fjs, 'sender-widget');
    })(document, 'script');
</script>
</body>
</html>
