<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.css">

    <!-- Code style -->
    <link href="{{ url('/') }}/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/css/webflow.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/css/orderpage.webflow.css" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>


@yield('content')


<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
    (function (d, s, id, companyId) {
        var js, sjs = d.getElementsByTagName(s)[0];
        js = d.createElement(s);
        js.id = id;
        js.src = "https://widget.sender.mobi/connect/loader.js";
        js.setAttribute('data-company-id', companyId);
        sjs.parentNode.insertBefore(js, sjs);
    })(document, "script", "sender-connect", "i52140507387");
</script>
</body>
</html>
