@extends('layouts.user')

@section('content')
   <div class="inner-container__main">
      <header class="inner-container__header"><h2 class="inner-container__main-title" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;"><a href="{{ url('/courses') }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a> {{ $course->title }}</h2></header>


      <div class="lesson-description">
         <div class="inner-container__main-container">
             <h2 class="lesson-description__title">{{ $course->title }}</h2>
             <div class="b-top-ciurse">

             @if ($course->nopay == 1)
                 @if (!empty($course->commet_price)) <span class="label label-danger">{{$course->commet_price}}</span>  @endif
                 <div class="price-course"><i class="fa fa-money" aria-hidden="true"></i> Цена курса: {{$course->price}} {{$course->valute}}</div>
                     @if (!empty($course->sale_button))
                         <a class="btn btn-success" target="_blank" href="{{$course->sale_button}}">
                             Купить курс
                         </a>
                     @endif


             @endif
             </div>

            {!! $course->text !!}

             @if(!Auth::user()->isPremium() && !Auth::user()->isVip() && !Auth::user()->isBase())

                     <a href="https://weblaboratory.in.ua/sale2017/" target="_blank"><img src="/img/sale1.png?w=700" alt=""></a>

                 <br><br>
             @endif

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

                @if ($course->nopay == 1)
                    {{--@include('layouts.payments.price_select')--}}
                    @if (!empty($course->sale_button))
                        <a class="btn btn-success" target="_blank" href="{{$course->sale_button}}">
                            Купить курс
                        </a>
                    @endif
                @endif
            </div>
         </div>

      </div>


      <div class="inner-container__main-container">
          @if ($course->grouping != 0)
         <ul class="lesson__list">
            @foreach($lessons as $lesson)
                 @if ($course->nopay != 1)
                     @if($lesson->acess == 0)
                         <li class="lesson__list-item"><a href="#" class="lesson__list-link"><i class="fa fa-lock" aria-hidden="true" style="color: {{ $course->color }};"></i>{{$lesson->title}}
                                 <span class="lesson__duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$lesson->duration}}</span></a></li>
                     @elseif($lesson->acess == 2)
                         <li class="lesson__list-item"><a href="{{ url('/courses') }}/{{ $course->slug }}/{{$lesson->id}}" class="lesson__list-link"><i class="fa fa-video-camera" aria-hidden="true" style="color: {{ $course->color }};"></i>{{$lesson->title}}
                                 <span class="lesson__duration black">Трансляция начнется <i class="fa fa-clock-o" aria-hidden="true"></i> {{ Carbon\Carbon::parse($lesson->date_in_live)->format('d.m.Y H:i') }}</span></a></li>
                     @elseif($lesson->acess == 3)
                         <li class="lesson__list-item"><a href="{{ url('/courses') }}/{{ $course->slug }}/{{$lesson->id}}" class="lesson__list-link"><i class="fa fa-check-circle" aria-hidden="true" style="color: {{ $course->color }};"></i>{{$lesson->title}}
                                 <span class="lesson__duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$lesson->duration}}</span></a></li>
                     @else
                         <li class="lesson__list-item"><a href="{{ url('/courses') }}/{{ $course->slug }}/{{$lesson->id}}" class="lesson__list-link"><i class="fa fa-check-circle" aria-hidden="true" style="color: {{ $course->color }};"></i>{{$lesson->title}}
                                 <span class="lesson__duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$lesson->duration}}</span></a></li>
                     @endif
                 @else
                     @if($lesson->acess == 3)
                         <li class="lesson__list-item"><a href="{{ url('/courses') }}/{{ $course->slug }}/{{$lesson->id}}" class="lesson__list-link"><i class="fa fa-check-circle" aria-hidden="true" style="color: {{ $course->color }};"></i>{{$lesson->title}}
                                 <span class="lesson__duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$lesson->duration}}</span></a></li>
                     @else
                         <li class="lesson__list-item"><a href="#" class="lesson__list-link"><i class="fa fa-lock" aria-hidden="true" style="color: {{ $course->color }};"></i>{{$lesson->title}}
                                 <span class="lesson__duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$lesson->duration}}</span></a></li>
                     @endif

                 @endif


            @endforeach
         </ul>
          @else
              <div class="lesson__list">
                  <p>Куср <span class="label label-info">{{ $course->title }}</span> пока в стадии записи и разработки. Его цена <span class="label label-success">{{ $course->price }} {{ $course->valute }}</span> на предзаказе. Когда курс будет укомплектован и выведен для общей продажи, его цена будет увеличена до <span class="label label-danger">{{ $course->price *2 }} {{ $course->valute }}</span></p>
              </div>
          @endif
      </div>

   </div>
@endsection

