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
                                    <div class="b-title1">Пройти тест, чтобы узнать на знание:</div>
                                    <div class="b-button"><a href="#" class="b-button-red">Начать тест</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cols">
                        <div class="b-log">
                            <div class="b-title">{{$course->title}}</div>

                            <div class="bay-button">
                            @if(Auth::guest())
                                @include('product.acess.guest')
                            @else
                                @include('product.acess.auth')
                            @endif
                            </div>

                            @foreach($lessons as $lesson)
                                <div class="b-persone">
                                    <div class="b-name">{{$lesson->title}} <span class="label label-info"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$lesson->duration}}</span></div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="cols">
                        <div class="b-main-prize">
                            <div class="b-title1">После окончания курса вы получите сертификат:</div>
                            <div class="b-img" style="background-image: url('/img/{{$course->image}}')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
