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

Route::resource('creditCards', 'CreditCardController');

Route::resource('addresses', 'AddressController');

Route::post('/shoppingCart/add/{id}', 'ShoppingCartController@updateBookQuantityInShoppingCart');
