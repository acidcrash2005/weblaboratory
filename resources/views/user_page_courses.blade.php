@extends('layouts.user')

@section('content')
<div class="inner-container__main">
   <header><h2 class="inner-container__main-title">Курсы</h2></header>
    @if(!Auth::user()->isPremium() && !Auth::user()->isVip() && !Auth::user()->isBase())
        <br><br>
        <div class="text-center">
            <a href="https://weblaboratory.in.ua/sale2017/" target="_blank"><img src="/img/sale1.png?w=700" alt=""></a>
        </div>
        <br><br>
    @endif
    <div class="course-list">
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
                        <? $taglessBody = strip_tags($course->text); ?>
                        {!! $taglessBody !!}
                    </div>
                    <div class="b-type">
                        <span class="start"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{ Carbon\Carbon::parse($course->start)->format('d.m.Y') }}</span>

                        @if (!empty($course->skill_up))
                            <span class="skills level">
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{$course->skill_up}}
                            </span>
                        @endif

                        @if ($course->role_id == 3)
                            <span class="level"><i class="fa fa-signal" aria-hidden="true"></i> Базовый</span>
                        @elseif($course->role_id == 4)
                            <span class="level middle"><i class="fa fa-signal" aria-hidden="true"></i> Средний</span>
                        @elseif($course->role_id == 5)
                            <span class="level vip"><i class="fa fa-signal" aria-hidden="true"></i> Продвинутый</span>
                        @endif
                    </div>
                    <div class="b-button-group">
                        @if ($course->nopay != 1)
                            <a href="{{ url('/courses') }}/{{$course->slug}}" class="btn button-btn" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">Перейти к обучению</a>
                        @else
                            <a href="{{ url('/courses') }}/{{$course->slug}}" class="btn button-btn" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">Подробнее...</a>
                            <a href="{{ url('/courses') }}/{{$course->slug}}" class="btn button-btn" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">Купить</a>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection


