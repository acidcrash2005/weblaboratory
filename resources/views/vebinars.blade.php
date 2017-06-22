@extends('layouts.user')

@section('content')
<div class="inner-container__main">
   <header><h2 class="inner-container__main-title">Вебинары</h2></header>
    <div class="course-list">
        @foreach ($posts as $course)
            <div class="b-event">
                <div class="b-wraper">
                    <div class="b-title @if (!empty($course->icon)) icon-true @endif" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">
                        @if (!empty($course->icon))
                            <i class="{{$course->icon}}" aria-hidden="true"></i>
                        @endif
                        <a href="{{ url('/user_page/curse') }}/{{$course->slug}}" style="color: @if ($course->text_color == 0) #000 @else #fff @endif;">{{$course->title}}</a></div>
                    <div class="b-img"><a href="{{ url('/vebinars/') }}/{{$course->slug}}"><img src="/img/{{$course->image}}?w=600" alt=""></a></div>

                    <div class="b-text">
                        <? $taglessBody = strip_tags($course->text); ?>
                        {!! $taglessBody !!}
                    </div>
                    <div class="b-type">
                        <span class="start"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{ Carbon\Carbon::parse($course->start)->format('d.m.Y') }}</span>

                        @if ($course->role_id == 3)
                            <span class="level"><i class="fa fa-signal" aria-hidden="true"></i> Базовый</span>
                        @elseif($course->role_id == 4)
                            <span class="level middle"><i class="fa fa-signal" aria-hidden="true"></i> Средний</span>
                        @elseif($course->role_id == 5)
                            <span class="level vip"><i class="fa fa-signal" aria-hidden="true"></i> Продвинутый</span>
                        @endif
                    </div>
                    <div class="b-button-group">
                        <a href="{{ url('/vebinars/') }}/{{$course->slug}}" class="btn button-btn btn-success">Просмотр</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection


