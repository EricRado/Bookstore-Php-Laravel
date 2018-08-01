@extends('layouts.app')

@section('title')Shopping Cart @endsection

@section('content')

@if (count($orderItems) > 0 )
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
            @foreach ($orderItems as $orderItem)
                <div class="row">
                    <div class="col-4 col-md-4">
                    </div>

                    <div class="col-3 col-md-3">
                        <p class="fieldSizeFont">{{ $orderItem->book->title }}</p>
                        <p class="fieldSizeFont">Item # {{ $orderItem->book_id }}</p>

                        <!-- update quantity of the book in the shopping cart -->
                        {!! Form::open(['action' => ['ShoppingCartController@updateOrderItemInShoppingCart', $orderItem->id]]) !!}

                            <div class="form-group">
                                {{ Form::label('quantity','Quantity', ['class' => 'fieldSizeFont'])}}
                                {{ Form::number('quantity', $orderItem->quantity, ['class' => 'form-control'])}}
                            </div>
                            {{ Form::hidden('bookId', $orderItem->book->id)}}

                            {{ Form::submit('Update Cart', ['class' =>'btn btn-md btn-primary', 'style' => 'padding:12px'])}}

                        {!! Form::close() !!}
                    </div>
                    <div class="col-2 col-md-2 order-sm-2">
                        <p class="fieldSizeFont">${{ $orderItem->book->price }}</p>
                        <p style="padding:10px;"></p>

                        <!-- remove the book from the shopping cart -->
                        {!! Form::open(['action' => ['ShoppingCartController@removeOrderItemFromShoppingCart', $orderItem->id],
                                'method' => 'POST', 'class' => 'float-right']) !!} @csrf
                                    
                            {{ Form::hidden('_method', 'DELETE')}}
                            {{ Form::submit('Remove', ['class' => 'btn btn-danger'])}}

                        {!! Form::close() !!}
                    </div>
                    
                    <hr>
                    <div class="row">
                            <div class="col-4 col-md-4">
                                <p class="fieldSizeFont">ITEM(S) TOTAL</p>
                            </div>
                            <div class="col-3 col-md-3"></div>
                             <div class="col-2 col-md-2 order-sm-2">
                                <p class="fieldSizeFont">${{ $orderItem->book_quantity_price }}</p>
                            </div>
                    </div>
                    <p style="padding:25px"></p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- display the total price of the order -->
    <div class="col-4 col-md-3 order-sm-2">
            <table style="table-layout:fixed; width:390px;">
                <tr>
                    <td class="fieldSizeFont">Order Subtotal</td>
                    <td class="fieldSizeFont">${{ $order->price }}</td>

                </tr>
                <tr>
                    <td class="fieldSizeFont">Taxes</td>
                    <td class="fieldSizeFont">${{ $order->tax_price }}</td>
                </tr>

            </table>
            <hr>
            <table style="table-layout:fixed; width:390px;">
                <tr>
                    <td class="fieldSizeFont">Total Price</td>
                    <td class="fieldSizeFont">${{ $order->total_price }}</td>
                </tr>
            </table>
            <p style="padding:5px"></p>
        <a class="btn btn-lg btn-primary" href="/shoppingCart/orderSubmitted">Purchase Order</a>
    </div>
            
@else
<h2>Shopping Cart is Empty</h2>
<img class="img-fluid" src="{{asset('img/cartIsEmpty.png')}}" style="margin: 0 auto; padding-top:60px;">
@endif

<div class="row">
    <div class="col-8 col-md-8">
        @if (count($futureOrderItems) > 0)
            <h2>Wish List</h2>

            <p style="padding:10px"></p>
            @foreach ($futureOrderItems as $futureOrderItem )
                <div class="row">
                    <div class="col-4 col-md-4">
                        <img src="{% static future_order_item.book.cover_file_name %}" height="170" width="180">
                    </div>
                    <div class="col-3 col-md-3">
                        <p class="fieldSizeFont">{{ $futureOrderItem->book->title }}</p>
                        <p class="fieldSizeFont">Item # {{ $futureOrderItem->book->id }}</p>
                    </div>
                    <div class="col-3 col-md-3 order-sm-2">
                        <p class="fieldSizeFont">${{ $futureOrderItem->book->price }}</p>
                    </div>
                    <div class="col-8 col-md-8">
                        <div class="row">
                            <div class="col-md-3">
                                
                                {!! Form::open(['action' => ['WishListController@addFutureOrderItemToShoppingCart', $futureOrderItem->id],
                                        'method' => 'POST', 'class' => 'float-left']) !!}

                                {{ Form::submit('Move to Shopping Cart', ['class' => 'btn btn-primary'])}}
                                {!! Form::close()!!}
                            </div>
                            <div class="col-md-2 order-md-4 ">
                                {!! Form::open(['action' => ['WishListController@removeFutureOrderItemFromWishList', $futureOrderItem->id],
                                        'method' => 'POST', 'class' => 'float-right']) !!}
                                    @csrf
                                {{ Form::hidden('_method', 'DELETE')}}
                                {{ Form::submit('Remove', ['class' => 'btn btn-danger'])}}

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            <hr>
            @endforeach
        @endif
    </div>
</div>

<p style="padding:20px;"></p>

@endsection