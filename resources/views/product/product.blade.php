@extends('layouts.app')
@section('content')

    <a data-fancybox data-src="#hidden-content" class="btn btn-success" href="javascript:;">
        Купить
    </a>

    @if (!empty($course->date_end_offer))
        <div class="offer">
            <div class="offet-timer-title">Предзаказ закончится:</div>
            <div class="b-timer timer-emd-offer">

                <div class="timer-dig">
                    <div class="b-day"></div>
                    дни
                </div>
                <div class="timer-dig">
                    <div class="b-hour"></div>
                    часы
                </div>
                <div class="timer-dig">
                    <div class="b-minute"></div>
                    мин
                </div>
                <div class="timer-dig">
                    <div class="b-second"></div>
                    сек
                </div>
            </div>
        </div>

        <script>

            {{--$(function () {--}}
                {{--var time = '{{ $course->date_end_offer }}';--}}
                {{--$(".b-timer").countdown(time, function (event) {--}}
                    {{--var totalHours = time;--}}

                    {{--if (event.strftime('%M') <=0 ){--}}
                        {{--$('.button').remove('.button');--}}
                        {{--$(".b-timer").html('<p class="big-p"><span class="strong_blue"><strong>Время вышло!</strong></span>&nbsp;Вы не успели!</p>')--}}
                    {{--}--}}


                    {{--$('.b-day').html(event.strftime('%D'));--}}
                    {{--$('.b-hour').html(event.strftime('%H') );--}}
                    {{--$('.b-minute').html(event.strftime('%M'));--}}
                    {{--$('.b-second').html(event.strftime('%S'));--}}
                {{--});--}}
            {{--});--}}

        </script>
    @endif

    <div style="display: none;" id="hidden-content">
        <div class="price-normal">
            <form id="bay" action="{{ url('/order') }}" method="POST">
                <h3 class="headprice">{{ $product->title }}</h3>
                <div class="header__price">

                    <h2 class="money-price"><strong class="ss">{{ $product->price }}</strong></h2>
                </div>
                <div class="body-price text-center">

                    <h2 class="price-title"><strong>Отправить заявку на покупку</strong></h2>
                    <p>Чтобы приобрести курс, вам необходимо сформировать заказ.</p>

                    <div class="show-form-msg">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Ваше имя" >
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Ваш Email" >
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Ваш телефон" >
                        </div>



                    </div>
                    <div class="hide-form-msg">
                        <div class="alert alert-success">
                            <p>Спасибо! Ваша заказ сформирован,теперь вы може оплатить. </p>
                        </div>
                    </div>

                    {{ csrf_field() }}

                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="title" value="{{ $product->title }}">
                    <input type="hidden" name="course_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_category" value="product">
                </div>
                <div class="foote__price">
                    <button type="submit" class="btn button c3 ico ico1 w-inline-block show-form-msg" data-ix="popup-open" href="#" target="_blank">
                        <div>Сформировать заказ</div>
                    </button>
                </div>
                <br>
                <p>Если у вас нет акканута, вы будете атоматически зарегестрированны на нашем сайте.</p>
            </form>
        </div>

        <script>
            var form = $('#bay');

//            $(form).submit(function (e) {
//                $('.form-group').removeClass('has-error');
//                $('.form-group i').remove();
//                $(form).find('*[type="submit"]').button('loading');
//
//                $.ajax({
//                    url: $(this).attr('action'),
//                    type: $(this).attr('method'),
//                    data: $(this).serialize(),
//                    success : function (data) {
//                        if (data != 'error'){
//                            $('.show-form-msg').hide();
//                            $('.hide-form-msg').show();
//                            $('.hide-form-msg').append(data);
//                        }
//                    },
//                    error :function( data ) {
//                        $(form).find('*[type="submit"]').button('reset');
//                        var errors = data.responseJSON;
//
//                        if (errors){
//                            $.each(errors,function (index, value) {
//                                $('[name="'+index+'"]').closest('.form-group').addClass('has-error has-feedback').append('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
//                            });
//                        }
//                        console.log(errors);
//                    }
//                });
//                e.preventDefault();
//            });
        </script>
    </div>


@endsection
