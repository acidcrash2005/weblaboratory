@foreach($UserPurchase as $Purchase)
    <div class="b-event">
        <div class="b-wraper">
            <div class="b-title">
                <a href="{{ url('user_products/view', $Purchase->product->id) }}">{{$Purchase->product->title}}</a></div>
            <div class="b-img"><a href="{{ url('user_products/view', $Purchase->product->id) }}"><img src="/img/{{$Purchase->product->image}}?w=600" alt=""></a></div>

            <div class="b-text">
                <? $taglessBody = strip_tags($Purchase->product->text); ?>
                {!! $taglessBody !!}
            </div>

            <div class="b-type">
                <span class="start"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{ Carbon\Carbon::parse($Purchase->product->start)->format('d.m.Y') }}</span>

                @if (!empty($Purchase->product->skill_up))
                    <span class="skills level">
                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{$Purchase->product->skill_up}}
                        </span>
                @endif

                @if ($Purchase->product->role_id == 3)
                    <span class="level"><i class="fa fa-signal" aria-hidden="true"></i> Базовый</span>
                @elseif($Purchase->product->role_id == 4)
                    <span class="level middle"><i class="fa fa-signal" aria-hidden="true"></i> Средний</span>
                @elseif($Purchase->product->role_id == 5)
                    <span class="level vip"><i class="fa fa-signal" aria-hidden="true"></i> Продвинутый</span>
                @endif
            </div>
            <div class="b-button-group">
                <a href="{{ url('user_products/view', $Purchase->product->id) }}" class="btn button-btn btn-success">Читать подробнее</a>
            </div>
        </div>
    </div>
@endforeach