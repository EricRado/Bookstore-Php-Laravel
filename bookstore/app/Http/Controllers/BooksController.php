<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Author;
use App\Models\Book;

class BooksController extends Controller
{
    public function getBooksByGenre($genre) {
        $books = Book::where('genre', '=', $genre)->paginate(15);
        return view('books.bookResults')->with('books', $books);
    }

    public function getBookDetailsByTitle($title) {
        $book = Book::where('title', $title)->first();
        $books_by_author = Book::where('author_id',$book->author->id)->get();
        return view('books.bookDetails')->with(['book'=>$book, 'books_by_author'=>$books_by_author]);
    }

    public function getTopRatedBooks() {
        $books = Book::orderBy('rating', 'desc')->take(25)->get();
        return view('books.bookResults')->with('books', $books);
    }

    public function getBestSellersBooks() {
        $books = Book::orderBy('amount_sold', 'desc')->take(25)->get();
        return view('books.bookResults')->with('books', $books);
    }
}
