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
<h2>Привествутем в Web Laboratory</h2>

<p>Вы зарегестрировались как {{ $data['name'] }}</p>
<p>Ваши данные для доступа:
    <br> <strong>Логин:</strong> {{ $data['email'] }}
    <br> <strong>Пароль:</strong> {{ $data['password'] }}</p>
<p><strong>Очень важно!!!</strong><br>
    Никому не говорите логин и пароль от Вашего кабинета.<br>

    Если будет кто-то спрашивать, от нашего имени доступ в Ваш личный кабинет, это мошенники.<br>
    Мы никогда не просим сказать ваш логи и пароль.<br>

    </p>
<p>P.S. Желаем Вам приятного обучения!</p>

<p>Это письмо сформировано автоматически, не отвечайте на него.</p>

{!! \Voyager::setting('mail_song_text') !!}
</body>
</html>