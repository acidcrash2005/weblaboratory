@foreach ($courses as $course)
    <div class="b-event">
        <div class="b-wraper">
            <div class="b-title @if (!empty($course->icon)) icon-true @endif" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">
                @if (!empty($course->icon))

                    @if (strpos($course->icon, 'fa') !== false)
                     <i class="{{$course->icon}}" aria-hidden="true"></i>
                    @else
                        {{ $course->icon }}
                    @endif

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
                <a href="{{ url('/courses') }}/{{$course->slug}}" class="btn button-btn" style="background-color: {{ $course->color }}; color: @if ($course->text_color == 0) #000 @else #fff @endif;">Перейти к обучению</a>
            </div>
        </div>
    </div>
@endforeach