@extends('layouts.app')

@section('title')   @endsection

@section('content')

<h1 style="padding-bottom:30px;">Items Purchased for Order #{{$orderId}}</h1>

@foreach ($purchasedItems as $purchasedItem)

<div class="row">
    <div class="col-4 col-md-4">
        <img src="# " class="img-fluid" style="width:200px; height:200px;">
    </div>
    <div class="col-8 col-md-8">
        <p class="fieldSizeFont">{{ $purchasedItem->book->title }}</p>
        <p class="fieldSizeFont">Price : ${{$purchasedItem->book->price }}</p>
        <p class="fieldSizeFont">Quantity Purchased : {{ $purchasedItem->quantity }}</p>
        <p class="fieldSizeFont">Quantity Price Total : ${{ $purchasedItem->book_quantity_price }}</p>
    </div>
</div>
<p style="padding:25px;"></p>


@endforeach

@endsection