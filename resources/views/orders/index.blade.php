@extends('layouts.user')

@section('content')
    <div class="inner-container__main">
        <header class="inner-container__header"><h2 class="inner-container__main-title">
                <a href="{{ url('/courses') }}/"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
                Мои заказы</h2>
        </header>
        <div class="course-list">
                <table class="table table-striped orders-table">
                    <tr>
                        <th>#</th>
                        <th>Курс</th>
                        <th>Дата заказа</th>
                        <th>Цена</th>
                        <th>Статус</th>
                        <th>Дейстивя</th>
                    </tr>
                    @foreach($orders as $order)
                        @if ($order->category == 'course')
                            <tr>
                                <td>{{$order->id}}</td>
                                <td><a href="{{url('/courses',$order->cours->slug)}}">{{$order->cours->title}}</a></td>
                                <td>{{$order->created_at}}</td>
                                <th>{{$order->cours->price}} {{$order->cours->valute}}</th>
                                <td>
                                    @if ($order->payed != 1)
                                        <span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Не оплачен</span>
                                    @else
                                        <span class="label label-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Оплачен</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->payed != 1)
                                        <a data-fancybox data-src="#hidden-content" class="btn-bay-table btn btn-success" href="javascript:;" data-coursprice="{{$order->cours->price}}" data-courstitle="{{$order->cours->title}}" data-order="{{$order->id}}" data-coursvalute="{{$order->cours->valute}}"><i class="fa fa-credit-card" aria-hidden="true"></i> Оплатить</a>
                                    
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{$order->id}}</td>
                                <td><a href="{{url('/user_products/view',$order->product->id)}}">{{$order->product->title}}</a></td>
                                <td>{{$order->created_at}}</td>
                                <th>{{$order->product->price}} USD</th>
                                <td>
                                    @if ($order->payed != 1)
                                        <span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Не оплачен</span>
                                    @else
                                        <span class="label label-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Оплачен</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->payed != 1)
                                        <a data-fancybox data-src="#hidden-content" class="btn-bay-table btn btn-success" href="javascript:;" data-coursprice="{{$order->product->price}}" data-courstitle="{{$order->product->title}}" data-order="product_{{$order->id}}" data-coursvalute="USD"><i class="fa fa-credit-card" aria-hidden="true"></i> Оплатить</a>
                                    @else
                                        <a href="{{ url('/order_get',$order->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Распечатать</a>
                                    @endif
                                </td>
                            </tr>
                        @endif

                    @endforeach
                </table>

        </div>

    </div>
    <div style="display: none;" id="hidden-content">
    <div class="price-normal">
        <form id="bay" action="{{ url('/payform') }}" method="POST">
            <h3 class="headprice"></h3>
            <div class="header__price">
                <h2 class="money-price"><strong class="ss"></strong></h2>
            </div>
            <div class="body-price text-center">

                <h2 class="price-title"><strong>Оплатить участие</strong></h2>
                <p>Чтобы приобрести курс, вам необходимо оплатить его участие.</p>

                <div class="hide-form-msg">
                    <div class="alert alert-success">
                        <p>Спасибо! Ваша заявка отправленна успешно, скоро мы с вами свяжемся. </p>
                    </div>
                </div>

                {{ csrf_field() }}

                <input type="hidden" name="price" value="">
                <input type="hidden" name="title" value="">
                <input type="hidden" name="order_id" value="">
            </div>
        </form>
    </div>
    </div>


    <script>
        var form = $('#bay');

        $('.btn-bay-table').click(function () {
            var order_id = $(this).data('order');
            var courstitle = $(this).data('courstitle');
            var coursprice = $(this).data('coursprice');
            var coursvalute = $(this).data('coursvalute');

            $('#bay .headprice').html(courstitle);
            $('#bay .ss').html(coursprice + ' ' + coursvalute);

            $('input[name="price"]').val(coursprice);
            $('input[name="order_id"]').val(order_id);
            $('input[name="title"]').val(courstitle);

            form.submit();

        });

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
                        $('.hide-form-msg').show().html('');
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
@endsection



