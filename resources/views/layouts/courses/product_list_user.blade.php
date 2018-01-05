        @foreach ($products as $product)

            <div class="b-event">
                <div class="b-wraper">
                    <div class="b-title">
                        <a href="{{ url('user_products/view', $product->id) }}">{{$product->title}}</a>
                    </div>
                    <div class="b-img"><a href="{{ url('user_products/view', $product->product->id) }}"><img
                                    src="/img/{{$product->product->image}}?w=600" alt=""></a></div>

                    <div class="b-text">
                        <? $taglessBody = strip_tags($product->product->text); ?>
                        {!! $taglessBody !!}
                    </div>

                    <div class="b-type">
                        <span class="start"><i class="fa fa-calendar-check-o"
                                               aria-hidden="true"></i> {{ Carbon\Carbon::parse($product->start)->format('d.m.Y') }}</span>

                        @if (!empty($product->skill_up))
                            <span class="skills level">
            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{$product->skill_up}}
            </span>
                        @endif

                        @if ($product->role_id == 3)
                            <span class="level"><i class="fa fa-signal" aria-hidden="true"></i> Базовый</span>
                        @elseif($product->role_id == 4)
                            <span class="level middle"><i class="fa fa-signal" aria-hidden="true"></i> Средний</span>
                        @elseif($product->role_id == 5)
                            <span class="level vip"><i class="fa fa-signal" aria-hidden="true"></i> Продвинутый</span>
                        @endif
                    </div>
                    <div class="b-button-group">
                        <a href="{{ url('user_products/view', $product->id) }}"
                           class="btn button-btn btn-success">Читать подробнее</a>
                    </div>
                </div>
            </div>

        @endforeach