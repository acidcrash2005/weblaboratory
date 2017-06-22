@extends('layouts.app')

@section('content')
        <div class="b-container">
            <br>
            <div class="b-news-full b-inner-container">
                <div class="b-wraper">
                    <h1>Упс, печалька, ошибка 404!</h1>
                    <img src="/public/storage/1-qdFdhbR00beEaIKDI_WDCw.gif" width="100%"/>
                    <br>
                    <p>Простите, но мы не смогли найти такую страницу на нашем сайте.</p>
                    <p>Возможно, злые программисты удалили ее или в процессе разработки просто поеняла старый адресс на новый.</p>
                    <p>Если вы уверены, что страница должно работать, но по каким-то причинам, вместо нее вы видите уто сообщение, свяжитесь с нашей технической поддержкой по
                        <a href="mailto:{{\Voyager::setting('email')}}">{{\Voyager::setting('email')}}</a>.</p>
                </div>
            </div>

        </div>
@endsection
