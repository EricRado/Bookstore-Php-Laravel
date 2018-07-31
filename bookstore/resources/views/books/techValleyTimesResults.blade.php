@extends('layouts.app')

@section('title')Tech Valley Times @endsection

@section('content')

<h1 style="text-align:center;">Tech Valley Times </h1>
@if(count($tech_valley_times) > 0 )

    <!-- Contains style and format for a book from a query result -->
    <p style="padding: 10px"></p>
    @foreach($tech_valley_times as $tech_valley_time)
        <div class="row">
            <div class="col-12 col-md-3 offset-sm-3">
                <img src="{% static  book.cover_file_name  %}" class="result" height="200" width="200">
            </div>

            <div class="col-12 col-md-5 order-sm-2">
                <a href="/books/details/{{$tech_valley_time->book->title}}" style="color:gray;"><h4>{{ $tech_valley_time->book->title }} </h4></a>
                <p style="color:gray"> by {{ $tech_valley_time->book->author->first_name }} {{ $tech_valley_time->book->author->last_name }} </p>
                <p>
                
                @if ($tech_valley_time->book->rating >= 4)
                    <span class="badge badge-success">Rating:  {{ $tech_valley_time->book->rating }}</span>
                @elseif (2 < $tech_valley_time->book->rating and $tech_valley_time->book->rating < 4)
                    <span class="badge badge-warning">Rating:  {{ $tech_valley_time->book->rating}}</span>
                @else 
                    <span class="badge badge-danger">Rating:  {{ $tech_valley_time->book->rating }}</span>
                @endif

                </p>
                <p style="padding:5px"> </p>
                <span class="badge">${{ $tech_valley_time->book->price }}</span>
            </div>
        </div>
        <hr>
    @endforeach
@endif

@endsection