<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FutureOrder;
use App\Models\FutureOrderItem;
use App\Models\Order;
use App\Models\OrderItem;
use Session;

class WishListController extends Controller
{
    public function addFutureOrderItemToWishList(Request $request) {
        $bookId = $request->input('bookId');
        $futureOrderId = Session::get('futureOrderId');

        $this->createFutureOrderItem($futureOrderId, $bookId);

        return redirect()->back();
    }

    public function removeFutureOrderItemFromWishList($id) {
        $this->deleteFutureOrderItem($id);
        return redirect()->back();
    }

    public function addFutureOrderItemToShoppingCart() {
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
}
