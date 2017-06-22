<a data-fancybox data-src="#hidden-content" class="btn btn-success" href="javascript:;">
    Купить курс
</a>
<div style="display: none;" id="hidden-content">
    <div class="price-normal">
        <form id="bay" action="{{ url('/order') }}" method="POST">
        <h3 class="headprice">{{ $course->title }}</h3>
        <div class="header__price">
            @if (!empty($course->commet_price)) <span class="label label-danger">{{$course->commet_price}}</span>  @endif
            <h2 class="money-price"><strong class="ss">{{ $course->price }} {{ $course->valute }}</strong></h2>
        </div>
        <div class="body-price text-center">

                <h2 class="price-title"><strong>Отправить заявку на покупку</strong></h2>
                <p>Чтобы приобрести курс, вам необходимо подать завяку, заполнив форму ниже.</p>

                <div class="show-form-msg">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Ваше имя" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Ваш Email" value="{{Auth::user()->email}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Ваш телефон">
                    </div>
                </div>
                <div class="hide-form-msg">
                    <div class="alert alert-success">
                        <p>Спасибо! Ваша заявка отправленна успешно, скоро мы с вами свяжемся. </p>
                    </div>
                </div>

                {{ csrf_field() }}

                <input type="hidden" name="price" value="{{ $course->price }}">
                <input type="hidden" name="title" value="{{ $course->title }}">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
        </div>
        <div class="foote__price">
            <button type="submit" class="btn button c3 ico ico1 w-inline-block show-form-msg" data-ix="popup-open" href="#" target="_blank">
                <div>Отправить заявку</div>
            </button>
        </div>
        </form>
    </div>

    <script>
    var form = $('#bay');

    $(form).submit(function (e) {
        $('.form-group').removeClass('has-error');
        $('.form-group i').remove();
        $(form).find('*[type="submit"]').button('loading');

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success : function (data) {
                if (data != 'error'){
                    $('.show-form-msg').hide();
                    $('.hide-form-msg').show();
                    $('.hide-form-msg').append(data);
                }
            },
            error :function( data ) {
                $(form).find('*[type="submit"]').button('reset');
                var errors = data.responseJSON;

                if (errors){
                    $.each(errors,function (index, value) {
                        $('[name="'+index+'"]').closest('.form-group').addClass('has-error has-feedback').append('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                    });
                }
                console.log(errors);
            }
        });
        e.preventDefault();
    });
    </script>
    {{--<div class="container">--}}
        {{--<div class="row text-center">--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="good price-normal">--}}
                    {{--<h3 class="headprice">Пакет "Vip"</h3>--}}
                    {{--<div class="header__price">--}}
                        {{--<h2 class="price-title"><strong>{{ $course->title }}</strong></h2>--}}
                        {{--<h4 class="price"><span class="color2 timeblock">19 недель</span></h4>--}}
                        {{--<h2 class="money-price"><strong class="ss">370$</strong><span class="sub-price">9 990 грн. / 23 230 руб.</span></h2>--}}
                    {{--</div>--}}
                    {{--<div class="body__price">--}}
                        {{--<p class="chek odd">Все записи уроков, домашних заданий и дополнительных материалов.</p>--}}
                        {{--<p class="chek">Личный кабинет с неограниченным временем доступа.</p>--}}
                        {{--<p class="chek odd">Личный наставник на протяжении всего обучения.</p>--}}
                        {{--<p class="chek">Доступ к ДЗ (с проверкой и обратной связью личного наставника)</p>--}}
                        {{--<p class="chek odd">Доступ в закрытую группу участников для&nbsp;Frontend developer на Facebook.</p>--}}
                        {{--<p class="chek">Возможность защитить свою работу и получить диплом окончания курсов&nbsp;<strong>"Frontend developer"</strong>.</p>--}}
                    {{--</div>--}}
                    {{--<div class="foote__price">--}}
                        {{--<a class="btn bay button c3 ico ico1 w-inline-block" data-ix="popup-open" href="#" target="_blank">--}}
                            {{--<div>Оплатить участие</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="price-normal">--}}
                    {{--<h3 class="headprice premium">Пакет "Premium"</h3>--}}
                    {{--<div class="header__price">--}}
                        {{--<h2 class="price-title"><strong>{{ $course->title }}</strong></h2>--}}
                        {{--<h4 class="price"><span class="color1 timeblock">19 недель</span></h4>--}}
                        {{--<h2 class="money-price"><strong class="ss">370$</strong><span class="sub-price">9 990 грн. / 23 230 руб.</span></h2>--}}
                    {{--</div>--}}
                    {{--<div class="body__price">--}}
                        {{--<p class="chek odd">Все записи уроков, домашних заданий и дополнительных материалов.</p>--}}
                        {{--<p class="chek">Личный кабинет с неограниченным временем доступа.</p>--}}
                        {{--<p class="chek odd">Личный наставник на протяжении всего обучения.</p>--}}
                        {{--<p class="chek">Доступ к ДЗ (с проверкой и обратной связью личного наставника)</p>--}}
                        {{--<p class="chek odd">Доступ в закрытую группу участников для&nbsp;Frontend developer на Facebook.</p>--}}
                        {{--<p class="chek">Возможность защитить свою работу и получить диплом окончания курсов&nbsp;<strong>"Frontend developer"</strong>.</p>--}}
                    {{--</div>--}}
                    {{--<div class="foote__price">--}}
                        {{--<a class="btn bay button c2 ico ico1 w-inline-block" data-ix="popup-open" href="#" target="_blank">--}}
                            {{--<div>Оплатить участие</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--<div class="price-normal">--}}
                    {{--<h3 class="headprice base">Пакет "Base"</h3>--}}
                    {{--<div class="header__price">--}}
                        {{--<h2 class="price-title"><strong>{{ $course->title }}</strong></h2>--}}
                        {{--<h4 class="price"><span class="color3 timeblock">19 недель</span></h4>--}}
                        {{--<h2 class="money-price"><strong class="ss">370$</strong><span class="sub-price">9 990 грн. / 23 230 руб.</span></h2>--}}
                    {{--</div>--}}
                    {{--<div class="body__price">--}}
                        {{--<p class="chek odd">Все записи уроков, домашних заданий и дополнительных материалов.</p>--}}
                        {{--<p class="chek">Личный кабинет с неограниченным временем доступа.</p>--}}
                        {{--<p class="chek odd">Личный наставник на протяжении всего обучения.</p>--}}
                        {{--<p class="chek">Доступ к ДЗ (с проверкой и обратной связью личного наставника)</p>--}}
                        {{--<p class="chek odd">Доступ в закрытую группу участников для&nbsp;Frontend developer на Facebook.</p>--}}
                        {{--<p class="chek">Возможность защитить свою работу и получить диплом окончания курсов&nbsp;<strong>"Frontend developer"</strong>.</p>--}}
                    {{--</div>--}}
                    {{--<div class="foote__price">--}}
                        {{--<a class="btn bay button c1 ico ico1 w-inline-block" data-ix="popup-open" href="#" target="_blank">--}}
                            {{--<div>Оплатить участие</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>