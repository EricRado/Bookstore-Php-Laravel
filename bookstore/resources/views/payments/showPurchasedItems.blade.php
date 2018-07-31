@extends('layouts.app')

@section('title')   @endsection

@section('content')

<h1 style="padding-bottom:30px;">Items Purchased for Order #{{$order_id}}</h1>

@foreach ($purchased_items as $purchased_item)

<div class="row">
    <div class="col-4 col-md-4">
        <img src="# " class="img-fluid" style="width:200px; height:200px;">
    </div>
    <div class="col-8 col-md-8">
        <p class="fieldSizeFont">{{ $purchased_item->book->title }}</p>
        <p class="fieldSizeFont">Price : ${{$purchased_item->book->price }}</p>
        <p class="fieldSizeFont">Quantity Purchased : {{ $purchased_item->quantity }}</p>
        <p class="fieldSizeFont">Quantity Price Total : ${{ $purchased_item->book_quantity_price }}</p>
    </div>
</div>
<p style="padding:25px;"></p>


@endforeach

@endsection