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
    
    <!-- Code style -->
    <link rel="stylesheet" href="{{ url('/') }}/css/prism.css">
    
    
    <!-- Scripts -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="user-page__body">


<div class="inner-container">
    <aside class="side-bar">
        <header><a href="{{ url('/user_page/') }}" class="inner-logo"></a></header>
        <div class="status-bar">
            @if (Auth::user()->role_id != 6)
            <div class="new-msg"><a href="{{ url('/user_page/') }}">{{ Widget::run('NewMassage',['db'=>'HomeworkAnswer']) }} <i class="fa fa-envelope-o" aria-hidden="true"></i></a></div>
            @endif
        </div>
        <nav class="side-bar__menu">
            <ul>


                <li class="side-bar__menu-item {{ Request::segment(1) === 'user_page' ? 'active_menu' : null }}"><a href="{{ url('/user_page') }}"  class="side-bar__menu-item-link"><i class="fa fa-home" aria-hidden="true"></i> Главная</a></li>
                <li class="side-bar__menu-item  {{ Request::segment(1) === 'courses' ? 'active_menu' : null }}"><a href="{{ url('/courses') }}" class="side-bar__menu-item-link"><i class="fa fa-video-camera" aria-hidden="true"></i> Курсы</a></li>
                <li class="side-bar__menu-item {{ Request::segment(1) === 'vebinars' ? 'active_menu' : null }}"><a href="{{ url('/vebinars') }}" class="side-bar__menu-item-link"><i class="fa fa-flask" aria-hidden="true"></i> Вебинары</a></li>

                <li class="side-bar__menu-item {{ Request::segment(1) === 'orders' ? 'active_menu' : null }}"><a href="{{ url('/orders') }}" class="side-bar__menu-item-link"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Заказы</a></li>

                @if (Auth::user()->role_id == 6 || Auth::user()->role_id == 1)
                    <li class="side-bar__menu-item"><a href="{{ url('/moderation') }}" class="side-bar__menu-item-link {{ Request::segment(1) === 'vebinars' ? 'moderation' : null }}"><i class="fa fa-pencil" aria-hidden="true"></i> Модерирование
                            <i class="fa fa-envelope small" aria-hidden="true"></i> {{ Widget::run('NewMassage') }}</a></li>
                @endif
                @if (Auth::user()->role_id == 1)
                    <li class="side-bar__menu-item"><a href="{{ url('/admin') }}" class="side-bar__menu-item-link"><i class="fa fa-android" aria-hidden="true"></i> Админ панель</a></li>
                @endif
                @if (!Auth::guest())
                    <li class="side-bar__menu-item {{ Request::segment(1) === 'profile' ? 'active_menu' : null }}"><a href="{{ url('/profile') }}" class="side-bar__menu-item-link"><i class="fa fa-user" aria-hidden="true"></i> Ваш профиль</a></li>
                @endif




                <li class="side-bar__menu-item">
                    <a href="{{ url('/logout') }}" class="side-bar__menu-item-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" aria-hidden="true"></i> Выход
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

            </ul>
        </nav>
    </aside>
    @yield('content')
</div>

    <!-- Scripts -->
    <script src="{{ url('/') }}/vendor/tcg/voyager/assets/lib/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/jquery.fancybox.min.js"></script>
    <script src="{{ url('/') }}/js/jQuizler.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/prism.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/script.js"></script>


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
