<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Book;
use Session;

class ShoppingCartController extends Controller
{

    public function viewShoppingCart() {
        
        $orderId = Session::get('orderId');

        // get all book items in current active shopping cart
        $order_items = OrderItem::where('order_id', '=', $orderId)->get();
        
        return view('payments.showShoppingCart')->with('order_items', $order_items);
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
        $this->createOrderItem($book->id, $orderId, $quantity, $bookQuantityAddedPrice);

        // update order price, tax price , and total price
        $this->updateCartPrice($orderId, $bookQuantityAddedPrice);

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

    private function updateOrderItem() {

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
