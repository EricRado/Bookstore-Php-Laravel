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

                        <!-- update quantity of book order item -->
                        <form action="{% url 'payments:updateShoppingCart' %}" method="POST">
                            <div class="form-group">
                                
                                <label class="fieldSizeFont" for="quantityValue">Quantity </label>
                                <input type="number" name="quantity" id="quantityValue" style="width:50px;" value="{{ $orderItem->quantity }}" min="1">
                                <input type="hidden" name="order_item_id" value="{{ $orderItem->id }}">
                            </div>
                                <button type="submit" class="btn btn-sm btn-primary">Update Cart</button>
                        </form>
                    </div>
                    <div class="col-2 col-md-2 order-sm-2">
                        <p class="fieldSizeFont">${{ $orderItem->book->price }}</p>
                        <p style="padding:10px;"></p>

                        <!-- remove book from order -->
                        <form action="{% url 'payments:deleteBook' %}" method="GET">
                            <input type="hidden" value="{{ $orderItem->id }}" name="order_item_id">
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

<p style="padding:20px;"></p>

@endsection