<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My mail</title>
</head>
<body>
<h2>Новый пользователь {{ $data['email'] }}</h2>

<p>Был зарегестрирован как <strong>{{ $data['name'] }}</strong></p>

<p>Это письмо сформировано автоматически, не отвечайте на него.</p>

{!! \Voyager::setting('mail_song_text') !!}
</body>
</html>