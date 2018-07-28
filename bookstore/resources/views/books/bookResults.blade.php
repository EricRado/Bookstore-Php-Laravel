@extends('layouts/app')

@section('content')

@if(count($books) > 0 )

    <!-- Contains style and format for a book from a query result -->
    <p style="padding: 10px"></p>

    @foreach($books as $book)
        <div class="row">
            <div class="col-12 col-md-3 offset-sm-3">
                <img src="{% static  book.cover_file_name  %}" class="result" height="200" width="200">
            </div>

            <div class="col-12 col-md-5 order-sm-2">
                <a href="/books/details/{{$book->title}}" style="color:gray;"><h4>{{ $book->title }} </h4></a>
                <p style="color:gray"> by {{ $book->author->first_name }} {{ $book->author->last_name }} </p>
                <p>
                
                @if ($book->rating >= 4)
                    <span class="badge badge-success">Rating:  {{ $book->rating }}</span>
                @elseif (2 < $book->rating and $book->rating < 4)
                    <span class="badge badge-warning">Rating:  {{ $book->rating}}</span>
                @else 
                    <span class="badge badge-danger">Rating:  {{ $book->rating }}</span>
                @endif

                </p>
                <p style="padding:5px"> </p>
                <span class="badge">${{ $book->price }}</span>
            </div>
        </div>
        <hr>
    @endforeach
@endif

@endsection()