@extends('layouts.app')

@section('title')Shopping Cart @endsection

@section('content')

@if (count($order_items) > 0 )
    <div class="row">
        <div class="col-xs-8 col-sm-8">
            <h2>Shopping Cart</h2>
        </div>
        <div class="col-xs-4 col-sm-4 col-sm-push-1">
            <h2>Order Summary</h2>
        </div>
    </div>
    <p style="padding:10px"></p>
    <div class="row">
        <div class="col-xs-8 col-sm-8">
            @foreach ($order_items as $order_item)
                <div class="row">
                    <div class="col-xs-4 col-sm-4">
                    </div>

                    <div class="col-xs-3 col-sm-3">
                        <p class="fieldSizeFont">{{ $order_item->book->title }}</p>
                        <p class="fieldSizeFont">Item # {{ $order_item->book_id }}</p>

                        <!-- update quantity of book order item -->
                        <form action="{% url 'payments:updateShoppingCart' %}" method="POST">
                            <div class="form-group">
                                
                                <label class="fieldSizeFont" for="quantityValue">Quantity </label>
                                <input type="number" name="quantity" id="quantityValue" style="width:50px;" value="{{ $order_item->quantity }}" min="1">
                                <input type="hidden" name="order_item_id" value="{{ $order_item->id }}">
                            </div>
                                <button type="submit" class="btn btn-sm btn-primary">Update Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
            
@else
<h2>Shopping Cart is Empty</h2>
<img class="img-fluid" src="{{asset('img/cartIsEmpty.png')}}" style="margin: 0 auto; padding-top:60px;">
    


@endif

<p style="padding:20px;"></p>

@endsection