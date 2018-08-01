@extends('layouts.app')

@section('title')Purchase History @endsection

@section('content')

<h1 style="padding-bottom:30px;">Purchase History</h1>

@if (count($payedOrders) > 0)
    @foreach($payedOrders as $payedOrder)

    <h3>Order Id # {{ $payedOrder->id }}</h3>
    <p style="padding:5px;"></p>

    <div class="row">
            <div class="col-6 col-sm-6">
                <p class="fieldSizeFont">Order Subtotal : ${{ $payedOrder->price }} </p>
            </div>
            <div class="col-6 col-sm-6">
                <p class="fieldSizeFont">Order Total : ${{ $payedOrder->total_price }} </p>
            </div>
    </div>
    <a href="/shoppingCart/orderHistory/{{ $payedOrder->id }}"><button class="btn btn-primary">View Items Purchased</button></a>
    <p style="padding:15px;"></p>
    <hr>

    @endforeach
@else
<img src="{{ asset('img/orderHistoryEmpty.png') }}" class="img-fliud" style="margin: 0 auto; padding-top:60px;">
@endif
<p style="padding:25px"></p>
@endsection