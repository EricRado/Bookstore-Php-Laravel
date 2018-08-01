<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/books/topRated', 'BooksController@getTopRatedBooks');

Route::get('/books/bestSellers', 'BooksController@getBestSellersBooks');

Route::get('/books/genre/{genre}','BooksController@getBooksByGenre');

Route::get('/books/details/{title}', 'BooksController@getBookDetailsByTitle');

Route::get('/books/byAuthor/{id}', 'BooksController@getBooksByAuthor');

Route::get('/books/titleSearch/', 'BooksController@searchBookByTitle');

Route::get('/books/techValleyTimes', 'BooksController@getTechValleyTimes');

Route::resource('creditCards', 'CreditCardController');

Route::resource('addresses', 'AddressController');

Route::post('/shoppingCart/add', 'ShoppingCartController@addOrderItemToShoppingCart');

Route::get('/shoppingCart/show', 'ShoppingCartController@viewShoppingCartAndWishList');

// NEEDS TO BE POST
Route::get('/shoppingCart/orderSubmitted', 'ShoppingCartController@submitOrder');

Route::get('/shoppingCart/orderHistory', 'ShoppingCartController@viewPurchasedOrdersHistory');

Route::get('/shoppingCart/orderHistory/{orderId}', 'ShoppingCartController@viewPurchasedOrderItems');

Route::post('/wishList/add', 'WishListController@addFutureOrderItemToWishList');

Route::delete('/wishList/delete/{id}', 'WishListController@removeFutureOrderItemFromWishList');

Route::post('/wishList/moveToShoppingCart/{id}', 'WishListController@addFutureOrderItemToShoppingCart');