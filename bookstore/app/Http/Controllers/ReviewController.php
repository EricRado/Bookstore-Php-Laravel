<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Session;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function submitReview(Request $request, $bookId) {
        $this->validate($request, [
            'rating' => 'required',
            'header' => 'required|string',
            'body' => 'required|string',
        ]);

        // check if user already left a review for the book
        if($this->didUserReviewBook($bookId)) {
            return redirect()->back();
        }

        // Create Review object
        $review = new Review;
        $review->user_id = auth()->user()->id;
        $review->book_id = $bookId;
        $review->rating = $request->input('rating');
        $review->header = $request->input('header');
        $review->body = $request->input('body');
        
        if ($request->input('anonymous') === '1'){
            $review->anonymous = true;
        } else {
            $review->anonymous = false;
        }
        
        $review->published_date = Carbon::now();

        $review->save();

        $this->updateBookRating($bookId, $review->rating);

        return redirect()->back();
    }

    private function didUserReviewBook($bookId):bool {
        if (Review::where('user_id', '=', auth()->user()->id)->where('book_id', '=', $bookId)->exists()) {
            return true;
        }
        return false;
    }

    // a user submits a review the book's rating must be updated
    private function updateBookRating($bookId, $userRating) {
        $book = Book::find($bookId);

        $totalSumRatingOfAllReviews = floatval($book->rating) * floatval($book->review_count);
        $totalSumRatingOfAllReviews += intval($userRating);

        $book->review_count += 1;

        // calculate new book rating
        $book->rating = $totalSumRatingOfAllReviews / floatval($book->review_count);

        $book->save();
    }
}
