@extends('layouts.app')

@section('title')Purchase History @endsection

@section('content')

<h1 style="padding-bottom:30px;">Purchase History</h1>

@if (count($payed_order) > 0)
    @foreach($payed_orders as $payed_order)

    <h3>Order Id # {{ $payed_order->id }}</h3>
    <p style="padding:5px;"></p>

    <div class="row">
            <div class="col-6 col-sm-6">
                <p class="fieldSizeFont">Order Subtotal : ${{ $payed_order->price }} </p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="fieldSizeFont">Order Total : ${{ $payed_order->total_price }} </p>
            </div>
    </div>
    <a href="/shoppingCart/orderHistory/{{ $payed_order->id }}"><button class="btn btn-primary">View Items Purchased</button></a>
    <p style="padding:15px;"></p>
    <hr>

    @endforeach
@else
<img src="{{ asset('img/orderHistoryEmpty.png') }}" class="img-fliud" style="margin: 0 auto; padding-top:60px;">
@endif
<p style="padding:25px"></p>
@endsection