<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\FutureOrderItem;
use App\Models\Order;
use App\Models\Book;
use Session;
use Carbon\Carbon;

class ShoppingCartController extends Controller
{

    public function viewShoppingCartAndWishList() {
        
        $orderId = Session::get('orderId');
        $futureOrderId = Session::get('futureOrderId');

        // get all book items in current active shopping cart
        $orderItems = OrderItem::where('order_id', '=', $orderId)->get();

        // get order/shopping cart details
        $order = Order::find($orderId);

        // get all book items in wish list
        $futureOrderItems = FutureOrderItem::where('future_order_id', '=', $futureOrderId)->get();
        
        
        return view('payments.showShoppingCart')->with([
            'orderItems' => $orderItems,
            'order' => $order,
            'futureOrderItems' => $futureOrderItems,
        ]);
    }

    public function viewPurchasedOrdersHistory() {
        $userId = auth()->user()->id;

        // get all orders that were purchased
        $payedOrders = Order::where('user_id', '=', $userId)->where('payed_order', '=', true)->get();

        return view('payments.showOrderHistory')->with('payedOrders', $payedOrders);
    }

    public function viewPurchasedOrderItems($orderId) {
        // get books purchased from selected order
        $purchasedItems = OrderItem::where('order_id', '=' , $orderId)->get();

        return view('payments.showPurchasedItems')->with([
            'purchasedItems' => $purchasedItems,
            'orderId' => $orderId
        ]);
    }

    public function addOrderItemToShoppingCart(Request $request) {
        $bookId = $request->input('bookId');
        $quantity = $request->input('quantity');
        $orderId = Session::get('orderId');
        
        // Get Book information which is going to be added to shopping cart
        $book = Book::find($bookId);

        // check if book is in stock and meets the demand of the user
        if(!$this->bookQuantityMeetsDemand($book, $quantity)) {
            return redirect()->back();
        }

        // find total book price of the specified quantity
        $bookQuantityAddedPrice = floatval($quantity) * floatval($book->price);
        
        // check if book has already been added to shopping cart
        $orderItem = OrderItem::where('order_id', '=', $orderId)
                        ->where('book_id', '=', $bookId)->first();
        if($orderItem === null){
            $this->createOrderItem($book->id, $orderId, $quantity, $bookQuantityAddedPrice);
        } else {
            $this->updateOrderItem($orderItem, $quantity, $bookQuantityAddedPrice);
        }
        
        // update order price, tax price , and total price
        $this->updateCartPrice($orderId, $bookQuantityAddedPrice, true);

        return redirect()->back();
    }

    public function removeOrderItemFromShoppingCart($id) {
        $orderId = Session::get('orderId');

        $orderItem = OrderItem::find($id);

        // update shopping cart price
        $this->updateCartPrice($orderId, $orderItem->book_quantity_price, false);

        $this->deleteOrderItem($id);

        return redirect()->back();

    }

    public function submitOrder() {
        $orderId = Session::get('orderId');
        $datetime = Carbon::now();

        // update payed_order field to true
        $order = Order::find($orderId);
        $order->payed_order = true;
        $order->datetime_ordered = Carbon::now();
        $order->save();

        // update OrderItems as payed
        $orderItems = OrderItem::where('order_id', '=', $orderId)->get();
        $this->orderItemsPurchased($orderItems);

        // create a new shopping cart for user
        $this->createNewOrder(auth()->user()->id);

        return redirect()->back();
    }

    private function createNewOrder($userId) {
        $order = new Order;
        $order->user_id = $userId;
        $order->save();
        Session::put('orderId', $order->id);
    }

    private function bookQuantityMeetsDemand($book, $quantity):bool {
        if($book->quantity < $quantity) {
            return false;
        }
        return true;
    }

    private function createOrderItem($bookId, $orderId, $quantity, $bookQuantityAddedPrice) {
        $orderItem = new OrderItem;
        $orderItem->book_id = $bookId;
        $orderItem->order_id = $orderId;
        $orderItem->quantity = $quantity;
        $orderItem->book_quantity_price = $bookQuantityAddedPrice;

        $orderItem->save();
    }

    private function deleteOrderItem($id) {
        $orderItem = OrderItem::find($id);
        $orderItem->delete();
    }

    private function updateOrderItem($orderItem, $quantity, $bookQuantityAddedPrice) {
        $orderItem->quantity += $quantity;
        $orderItem->book_quantity_price += $bookQuantityAddedPrice;
        
        $orderItem->save();
    }

    private function orderItemsPurchased($orderItems) {
        foreach($orderItems as $orderItem) {
            $orderItem->item_payed = true;
            $orderItem->save();
        }
    }

    private function updateCartPrice($orderId, $priceToAddToCart, $addItem) {
        $order = Order::find($orderId);

        if(!$addItem) {
            $priceToAddToCart = -$priceToAddToCart;
        }
        
        $order->price += $priceToAddToCart;

        $taxPriceToAddToCart = $priceToAddToCart * 0.07;
        $order->tax_price += $taxPriceToAddToCart;

        $priceToAddToCartWithTax = $priceToAddToCart + $taxPriceToAddToCart;
        $order->total_price += $priceToAddToCartWithTax;

        $order->save();
    }
}
