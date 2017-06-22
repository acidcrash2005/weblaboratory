@extends('layouts.app')

@section('content')
    <div class="b-links-block">
    <div class="b-main-img" style="background-image: url('/img/{{$course->image}}'); background-color: {{$course->color}}"></div>

    <div class="b-concurs-block">
        <div class="b-container">
            <div class="flex-description">
            <div class="cols">
                <div class="b-tabs">
                    <ul class="b-tab-nav">
                        <li class="b-active"><a href="#tab1">Повышение навыков</a></li>
                    </ul>
                    <div id="tab1" class="b-tab-panel">
                        <div class="b-bar-block">
                            @foreach ($course->skill_up as $skill)
                                <div class="b-bar"><span>{{ $skill }}</span><i style="width: 100%"></i> {{--<span class="b-percent">60%</span>--}} </div>
                            @endforeach
                        </div>
                        <div class="b-pize-block-1" style="background-image: url('images/priz1.png');">
                            <div class="b-title1">Розыгрышь призов среди гуру и профи</div>
                            <div class="b-title2">Каждую неделю</div>
                            <div class="b-button"><a href="#" class="b-button-red">Решить тест</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cols">
                <div class="b-log">
                    <div class="b-title">{{$course->title}}</div>
                    <div class="b-persone">
                        <div class="b-name"><img src="images/ava_min.png" alt=""/>Александр Макаров, <span>Кодер</span></div>
                        <div class="b-data"><span class="b-date">13:46, Сегодня</span><span class="b-sep">/</span><span class="b-text">Закончил первое задание</span></div>
                    </div>
                    <div class="b-persone">
                        <div class="b-name"><img src="images/avaMini1.png" alt=""/>Дмитрий Мезенин, <span>Кодер</span></div>
                        <div class="b-data"><span class="b-date">16:24, Вчера</span><span class="b-sep">/</span><span class="b-text">Начал прохождение теста</span></div>
                    </div>
                    <div class="b-persone">
                        <div class="b-name"><img src="images/avaMini2.png" alt=""/>Константин Константинопольский, <span>Админ</span></div>
                        <div class="b-data"><span class="b-date">22:13, 31 авг</span><span class="b-sep">/</span><span class="b-text">Начал прохождение теста</span></div>
                    </div>
                    <div class="b-persone">
                        <div class="b-name"><img src="images/avaMini3.png" alt=""/>Семён Поапов, <span>Админ</span></div>
                        <div class="b-data"><span class="b-date">22:13, 31 авг</span><span class="b-sep">/</span><span class="b-text">Начал прохождение теста</span></div>
                    </div>
                    <div class="b-persone">
                        <div class="b-name"><img src="images/avaMini3.png" alt=""/>Семён Поапов, <span>Админ</span></div>
                        <div class="b-data"><span class="b-date">22:13, 31 авг </span><span class="b-sep">/</span><span class="b-text">Начал прохождение теста</span></div>
                    </div>
                </div>
            </div>
            <div class="cols">
                <div class="b-main-prize">
                    <div class="b-img" style="background-image: url('images/prize.png')"></div>
                    <div class="b-data">
                        <div class="b-title1">Пройди квест, выиграй</div>
                        <div class="b-title2 b-red">ГЛАВНЫЙ ПРИЗ</div>
                        <div class="b-button"><a href="#" class="b-button-red">Начать квест</a></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection
