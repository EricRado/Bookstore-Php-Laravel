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
}
