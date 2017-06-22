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
<h2>Новый заказа от {{ $data->user->email }}</h2>
<p><strong>Товар:</strong> {{ $data->cours->title }} - {{ $data->cours->price }}</p>
<p><strong>Телефон:</strong> {{ $data->phone }}</p>

{!! \Voyager::setting('mail_song_text') !!}

</body>
</html>