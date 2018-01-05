@extends('layouts.user')
@section('content')
    <div class="inner-container__main">
        <header class="inner-container__header"><h2 class="inner-container__main-title">Ваши продкуты в Web Laboratory</h2></header>

        <div class="course-list">
        @include('product.lists.user_products_list', $UserPurchase)
        </div>
    </div>

@endsection
