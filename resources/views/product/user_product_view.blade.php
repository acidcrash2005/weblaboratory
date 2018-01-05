@extends('layouts.user')
@section('content')
    <div class="inner-container__main">
        <header class="inner-container__header">
            <h2 class="inner-container__main-title">
                <a href="{{ url('/user_products') }}"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
                {{ $Product->title }}
            </h2>
        </header>

        <div class="lesson-description">
            <div class="inner-container__main-container">
                <h2 class="lesson-description__title">{{ $Product->title }}</h2>
                <div class="b-type">
                    {{--<span class="start"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{ Carbon\Carbon::parse($Product->start)->format('d.m.Y') }}</span>--}}
                    {{--<span class="skills level">--}}
                        {{--<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> javascript game--}}
                    {{--</span>--}}
                    {{--<span class="level middle"><i class="fa fa-signal" aria-hidden="true"></i> Средний</span>--}}
                </div>
                <div class="product-image">
                    <img src="/img/{{ $Product->image }}?w=100%" alt="">
                </div>
                {!!  $Product->text !!}

                @if(!empty($Product->product_data))
                    <h3>Файлы и данные продукта</h3>
                    {!!  $Product->product_data !!}
                @endif

            </div>

        </div>

    </div>

@endsection
