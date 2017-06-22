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
                                    <a href="#" class="btn btn-success"><i class="fa fa-credit-card" aria-hidden="true"></i> Оплатить</a>
                                @else
                                    <a href="#" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Распечатать</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>

        </div>

    </div>
@endsection

