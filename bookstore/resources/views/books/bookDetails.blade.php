@extends('layouts.app')
@section('content')
<div class="container">
        <p style="padding:25px"> </p>
    
        <div class="row">
            <div class="col-6 col-md-3 order-sm-2">
                <a href="#" id="pop">
                    <img id="imageResource" src="" class="img-fluid"
                         style="cursor:zoom-in; height:320px; width:auto;">
                </a>
            </div>
            <div class="col-3 col-md-3 order-sm-2" style="border-right:1px solid black; height:310px;">
                <h3>{{ $book->title}}</h3>
                <h4>by {{ $book->author->first_name }} {{ $book->author->last_name }}</h4>
                <h3>
                @if ($book->rating >= 4)
                    <span class="badge badge-pill badge-success">Rating:  {{ $book->rating }}</span>
                @elseif (2 < $book->rating  and $book->rating < 4)
                    <span class="badge badge-pill badge-warning">Rating:  {{ $book->rating}}</span>
                @else 
                    <span class="badge badge-pill badge-danger">Rating:  {{ $book->rating }}</span>
                @endif 
              </h3>
            </div>
            <div class="col-3 col-md-2 order-sm-2"  >
                <h3>Paperback</h3>
                <h3>${{ $book->price }}</h3>
                <p style="padding:5px;"></p>
                
                <!-- Include book quantity form to add to shopping cart -->
                @include('payments.quantityForm')

                <p style="padding: 5px;"></p>
                <!-- Add book to wish list -->
                {!! Form::open(['action' => 'WishListController@addFutureOrderItemToWishList']) !!}

                {{ Form::hidden('bookId', $book->id)}}

                {{ Form::submit('Add to WishList', ['class' => 'btn btn-md btn-success', 'style' => 'padding:12px']) }}

                {!! Form::close() !!}
            </div>
        </div>
        <hr>
    
        <div class="row">
            <div class="order-sm-2" style="text-align:center" >
                <h2>Description</h2>
            </div>
        </div>
        <div class="row">
            <div class=" col-md-4 order-sm-4 ">
                <p>{{ $book->description }}</p>
            </div>
        </div>
        <hr>
    
        <div class="row">
            <div class="order-sm-2">
                <h2 style="text-align:center">Publishing Info</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-push-4">
                <table style="table-layout:fixed; width:450px;">
                    <tr>
                        <td>Publisher</td>
                        <td>{{ $book->publisher }}</td>
                    </tr>
                    <tr>
                        <td>Release Date</td>
                        <td>{{ $book->release_date }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
    
        <div class="row">
            <div class="col-sm-push-1" style="text-align:center">
                <h2>Author Biography</h2>
            </div>
        </div>
    
        <div class="row">
            <div class=" col-sm-4 col-sm-push-4 ">
                <p>{{ $book->author->bio }}</p>
                <p style="padding:10px"></p>
                
                <!-- If author has more than one book in the store create link to display all books by the author -->
                @if (count($books_by_author) > 1)
            <a href="/books/byAuthor/{{$book->author->id}}" style="color:gray;">More Books by
                        {{ $book->author->first_name }} {{ $book->author->last_name }}</a>
                @endif

            </div>
        </div>
        <hr>
    </div>

    <script>
        $('#pop').on('click',function(){
            $('#imagepreview').attr('src', $('#imageResource').attr('src'));
            $('#imageModal').modal('show');
        });
    </script>

 @endsection