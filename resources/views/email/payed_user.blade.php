<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новый оплаченый заказ</title>
</head>
<body>
<h2>Ваш заказ: #{{ $data['order']->id }} - {{ $data['product']->title }}</h2>
{!! $data['product']->email_text  !!}

{!! \Voyager::setting('mail_song_text') !!}

</body>
</html>