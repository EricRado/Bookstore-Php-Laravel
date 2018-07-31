<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Book;
use Session;
use Carbon\Carbon;

class ShoppingCartController extends Controller
{

    public function viewShoppingCart() {
        
        $orderId = Session::get('orderId');

        // get all book items in current active shopping cart
        $order_items = OrderItem::where('order_id', '=', $orderId)->get();

        // get order/shopping cart details
        $order = Order::find($orderId);
        
        return view('payments.showShoppingCart')->with([
            'order_items' => $order_items,
            'order' => $order
        ]);
    }

    public function viewPurchasedOrdersHistory() {
        $userId = auth()->user()->id;

        // get all orders that were purchased
        $payed_orders = Order::where('user_id', '=', $userId)->where('payed_order', '=', true)->get();

        return view('payments.showOrderHistory')->with('payed_orders', $payed_orders);
    }

    public function viewPurchasedOrderItems($orderId) {
        // get books purchased from selected order
        $purchased_items = OrderItem::where('order_id', '=' , $orderId)->get();

        return view('payments.showPurchasedItems')->with([
            'purchased_items' => $purchased_items,
            'order_id' => $orderId
        ]);
    }

    public function addBookToShoppingCart(Request $request) {
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
        $this->updateCartPrice($orderId, $bookQuantityAddedPrice);

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

        return redirect()->back();
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

    private function updateOrderItem($orderItem, $quantity, $bookQuantityAddedPrice) {
        $orderItem->quantity += $quantity;
        $orderItem->book_quantity_price += $bookQuantityAddedPrice;
        
        $orderItem->save();
    }

    private function updateCartPrice($orderId, $priceToAddToCart) {
        $order = Order::find($orderId);

        $order->price += $priceToAddToCart;

        $taxPriceToAddToCart = $priceToAddToCart * 0.07;
        $order->tax_price += $taxPriceToAddToCart;

        $priceToAddToCartWithTax = $priceToAddToCart + $taxPriceToAddToCart;
        $order->total_price += $priceToAddToCartWithTax;

        $order->save();
    }
}
