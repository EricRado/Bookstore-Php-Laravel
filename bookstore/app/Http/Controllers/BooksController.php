<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Author;
use App\Models\Book;
use App\Models\TechValleyTime;

class BooksController extends Controller
{
    public function getBooksByGenre($genre) {
        $books = Book::where('genre', '=', $genre)->paginate(15);
        $title = "$genre Books";
        
        return view('books.bookResults')->with([
            'books' => $books,
            'pageTitle' => $title
        ]);
    }

    public function getBookDetailsByTitle($title) {
        $book = Book::where('title', $title)->first();
        $books_by_author = Book::where('author_id',$book->author->id)->get();
        
        return view('books.bookDetails')->with(['book'=>$book, 'books_by_author'=>$books_by_author]);
    }

    public function getBooksByAuthor($id) {
        $books = Book::where('author_id', '=', $id)->get();
        $author = Author::find($id);
        $title = "Books by " . $author->first_name . " " . $author->last_name;
        
        return view('books.bookResults')->with([
            'books' => $books,
            'pageTitle' => $title
        ]);
    }

    public function getTopRatedBooks() {
        $books = Book::orderBy('rating', 'desc')->take(25)->get();
        $title = "Top 25 Rated Books";
        
        return view('books.bookResults')->with([
            'books' => $books,
            'pageTitle' => $title
        ]);
    }

    public function getBestSellersBooks() {
        $books = Book::orderBy('amount_sold', 'desc')->take(25)->get();
        $title = "Best Sellers";
        
        return view('books.bookResults')->with([
            'books' => $books,
            'pageTitle' => $title
        ]);
    }

    public function searchBookByTitle(Request $request) {
        $bookTitle = $request->input('input');
        $books = Book::where('title', '=', $bookTitle)->
                orWhere('title', 'like', '%' . $bookTitle .'%')->get();
        $title = "Search Result For : " . '"' . $bookTitle . '"';

        return view('books.bookResults')->with([
            'books' => $books,
            'pageTitle' => $title
        ]);
    }

    public function getTechValleyTimes() {
        $tech_valley_times = TechValleyTime::all();
        
        return view('books.techValleyTimesResults')->with('tech_valley_times', $tech_valley_times);
    }

}
