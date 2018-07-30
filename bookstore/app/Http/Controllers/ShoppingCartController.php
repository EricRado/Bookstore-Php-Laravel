<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function updateBookQuantityInShoppingCart($id) {
        return view('payments/quantityForm');
    }

    public function viewShoppingCart() {
        
        return view('payments.showShoppingCart');
    }
}
