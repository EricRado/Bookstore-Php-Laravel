<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FutureOrder;
use App\Models\FutureOrderItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Session;

class WishListController extends Controller
{
    public function addFutureOrderItemToWishList(Request $request) {
        $bookId = $request->input('bookId');
        $futureOrderId = Session::get('futureOrderId');

        // check if item already exists in shopping cart


        $this->createFutureOrderItem($futureOrderId, $bookId);

        return redirect()->back();
    }

    public function removeFutureOrderItemFromWishList($id) {
        $this->deleteFutureOrderItem($id);
        return redirect()->back();
    }

    public function addFutureOrderItemToShoppingCart($id) {
        $orderId = Session::get('orderId');
        
        $futureOrderItem = FutureOrderItem::find($id);
        $book = Book::find($futureOrderItem->book->id);
        
        $this->createOrderItem($book->id, $orderId, 1, $book->price);
        $this ->updateCartPrice($orderId, $book->price);

        // remove future order item since it was moved to shopping cart
        $this->deleteFutureOrderItem($id);
        
        return redirect()->back();
    }

    private function createFutureOrderItem($futureOrderId, $bookId) {
        $futureOrderItem = new FutureOrderItem;
        $futureOrderItem->future_order_id = $futureOrderId;
        $futureOrderItem->book_id = $bookId;

        $futureOrderItem->save();
    }

    private function deleteFutureOrderItem($id) {
        $futureOrderItem = FutureOrderItem::find($id);
        $futureOrderItem->delete();
    }

    private function createOrderItem($bookId, $orderId, $quantity, $bookQuantityAddedPrice) {
        $orderItem = new OrderItem;
        $orderItem->book_id = $bookId;
        $orderItem->order_id = $orderId;
        $orderItem->quantity = $quantity;
        $orderItem->book_quantity_price = $bookQuantityAddedPrice;

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
