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
<h2>Вопрос по {{ $dialog->lesson->title }}</h2>
<h3>Курс: {{ $dialog->lesson->cours->title }}</h3>
<p><strong>От</strong>: {{ $dialog->user->name }}</p>
{!! $homework->text !!}

<h2><a href="{{ url('/moderation/dialog/'.$dialog->id) }}">Отвевтить</a></h2>

{!! \Voyager::setting('mail_song_text') !!}
</body>
</html>