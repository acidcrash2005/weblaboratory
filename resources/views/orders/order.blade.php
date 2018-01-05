@extends('layouts.empty')

@section('content')

    @if ($order->category == 'course')
        <div class="container w-container">
            <div class="header-order"><img src="{{ url('/') }}/img/logo.png" width="189.5">
                <div class="order-num">Номер заказа: {{$order->id}}</div>
                <div class="contact-block">
                    <div class="contact-item">{{Voyager::setting('phone')}}</div>
                    <div class="contact-item">{{Voyager::setting('email_bay')}}</div>
                </div>
            </div>
            <div class="content">
                <div class="w-row">
                    <div class="w-col w-col-6"><img src="/img/{{$order->cours->image}}?w=100%">
                        <h4 class="price">Цена:
                            @if ($order->cours->sale_price < 0)
                                <span class="sale">{{$order->cours->price}}$</span>
                                <span class="real">{{$order->cours->sale_price}}$</span>
                            @else
                                <span class="real">{{$order->cours->price}}$</span>
                            @endif

                        </h4>
                        @if (!empty($order->cours->sale_text))
                            {!! $order->cours->sale_text !!}
                        @endif
                    </div>
                    <div class="w-col w-col-6">
                        <h2>{{$order->cours->title}}</h2>
                        {!! $order->cours->text !!}
                    </div>
                </div>
                <div style="text-align: center">
                    <h3>Способы оплаты</h3>
                    <div class="payments">
                        <div class="pay-item">
                            <img src="/img/2016101113200-visa-and-mastercard.gif" width="128">
                            @if($order->payed != 1)
                                {!! $pay_form !!}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div>© Web Laboratory</div>
                <div class="text-block">Стоимость в долларах рассчитывается по курсу банка "Приват Банк" в день покупки. Для более детальной информации можете посетить официальный сайт банка - https://privatbank.ua/. Также с плательщика может взиматься комиссия за трансфер средств банка.</div>
                <div class="contact-block">
                    <div class="contact-item">{{Voyager::setting('phone')}}</div>
                    <div class="contact-item">{{Voyager::setting('email_bay')}}</div>
                </div>
            </div>
        </div>
    @else
        <div class="container w-container">
            <div class="header-order"><img src="{{ url('/') }}/img/logo.png" width="189.5">
                <div class="order-num">Номер заказа: {{$order->id}}</div>
                <div class="contact-block">
                    <div class="contact-item">{{Voyager::setting('phone')}}</div>
                    <div class="contact-item">{{Voyager::setting('email_bay')}}</div>
                </div>
            </div>
            <div class="content">
                <div class="w-row">
                    <div class="w-col w-col-6"><img src="/img/{{$order->product->image}}?w=100%">
                        <h4 class="price">Цена:
                            @if ($order->product->sale_price < 0)
                                <span class="sale">{{$order->product->price}}$</span>
                                <span class="real">{{$order->product->sale_price}}$</span>
                            @else
                                <span class="real">{{$order->product->price}}$</span>
                            @endif

                        </h4>
                        @if (!empty($order->product->sale_text))
                            {!! $order->product->sale_text !!}
                        @endif
                    </div>
                    <div class="w-col w-col-6">
                        <h2>{{$order->product->title}}</h2>
                        {!! $order->product->text !!}
                    </div>
                </div>
                <div style="text-align: center">
                    <h3>Способы оплаты</h3>
                    <div class="payments">
                        <div class="pay-item">
                            <img src="/img/2016101113200-visa-and-mastercard.gif" width="128">
                            @if($order->payed != 1)
                                {!! $pay_form !!}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div>© Web Laboratory</div>
                <div class="text-block">Стоимость в долларах рассчитывается по курсу банка "Приват Банк" в день покупки. Для более детальной информации можете посетить официальный сайт банка - https://privatbank.ua/. Также с плательщика может взиматься комиссия за трансфер средств банка.</div>
                <div class="contact-block">
                    <div class="contact-item">{{Voyager::setting('phone')}}</div>
                    <div class="contact-item">{{Voyager::setting('email_bay')}}</div>
                </div>
            </div>
        </div>
    @endif



@endsection



