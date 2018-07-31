@extends('layouts.app')

@section('title')Shopping Cart @endsection

@section('content')

@if (count($order_items) > 0 )
    <div class="row">
        <div class="col-8 col-md-8">
            <h2>Shopping Cart</h2>
        </div>
        <div class="col-4 col-md-4 order-sm-2">
            <h2>Order Summary</h2>
        </div>
    </div>
    <p style="padding:10px"></p>
    <div class="row">
        <div class="col-8 col-md-8">
            @foreach ($order_items as $order_item)
                <div class="row">
                    <div class="col-4 col-md-4">
                    </div>

                    <div class="col-3 col-md-3">
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
                    <div class="col-2 col-md-2 order-sm-2">
                        <p class="fieldSizeFont">${{ $order_item->book->price }}</p>
                        <p style="padding:10px;"></p>

                        <!-- remove book from order -->
                        <form action="{% url 'payments:deleteBook' %}" method="GET">
                            <input type="hidden" value="{{ $order_item->id }}" name="order_item_id">
                            <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                            <input type="hidden" name="next" value="">
                        </form>
                    </div>
                    
                    <hr>
                    <div class="row">
                            <div class="col-4 col-md-4">
                                <p class="fieldSizeFont">ITEM(S) TOTAL</p>
                            </div>
                            <div class="col-3 col-md-3"></div>
                             <div class="col-2 col-md-2 order-sm-2">
                                <p class="fieldSizeFont">${{ $order_item->book_quantity_price }}</p>
                            </div>
                    </div>
                    <p style="padding:25px"></p>
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