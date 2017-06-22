@extends('layouts.app')

@section('content')
    <div class="b-content-inner b-overlay-top">
        <div class="b-container">
            <h1 class="b-inner-title">Интересно о Курсах</h1>
            <p class="text-center b-text-top">В этом разделе вы сможете познакомиться со всеми нашими курсам, котроый вы моежете пройти ну нас на сайте.</p>
        </div>
    </div>
    <div class="b-container">
        <div class="b-events">
            @foreach ($courses as $course)
                <div class="b-event">
                    <div class="b-wraper">
                        <div class="b-title @if (!empty($course->icon)) icon-true @endif" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">
                            @if (!empty($course->icon))
                                <i class="{{$course->icon}}" aria-hidden="true"></i>
                            @endif
                            <a href="{{ url('/courses') }}/{{$course->slug}}" style="color: @if ($course->text_color == 0) #000 @else #fff @endif;">{{$course->title}}</a></div>
                        <div class="b-img"><a href="{{ url('/courses') }}/{{$course->slug}}"><img src="/img/{{$course->image}}?w=600" alt=""></a></div>

                        <div class="b-text">
                            {!! $course->text !!}
                        </div>
                        <div class="b-type">
                            @if ($course->grouping == 1)
                                <span class="b-curse"><i class="fa fa-check-square-o" aria-hidden="true"></i> Идет набор</span>
                            @else
                                <span class="b-curse gupping__close"><i class="fa fa-ban" aria-hidden="true"></i> Набор Закрыт</span>
                            @endif

                            <span class="start"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{ Carbon\Carbon::parse($course->start)->format('d.m.Y') }}</span>
                                @if ($course->type == 3)
                                    <span class="level"><i class="fa fa-signal" aria-hidden="true"></i> Базовый</span>
                                @elseif($course->type == 4)
                                    <span class="level middle"><i class="fa fa-signal" aria-hidden="true"></i> Средний</span>
                                @elseif($course->type == 5)
                                    <span class="level vip"><i class="fa fa-signal" aria-hidden="true"></i> Продвинутый</span>
                                @endif


                        </div>
                        <div class="b-button-group">
                            <a href="{{ url('/curse') }}/{{$course->slug}}">Подбробнее</a>
                            <a href="#" class="btn button-btn" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;"">Купить</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
