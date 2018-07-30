<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Session;

class ShoppingCartController extends Controller
{
    public function updateBookQuantityInShoppingCart($id) {
        return view('payments/quantityForm');
    }

    public function viewShoppingCart() {
        
        $orderId = Session::get('orderId');

        // get all book items in current active shopping cart
        $order_items = OrderItem::where('order_id', '=', $orderId)->get();
        return view('payments.showShoppingCart')->with('order_items', $order_items);
    }
}
