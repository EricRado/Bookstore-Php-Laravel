@extends('layouts.app')

@section('title')Display Addresses @endsection

@section('content')

    <h2>Shipping Address</h2>
    <p style="padding:20px"></p>

    @if (count($addresses) > 0 )
        @for ($i = 0; $i < count($addresses); $i++)
        <h3> Address {{$i + 1}} </h3>
        <h4>{{ $addresses[$i]->street_address }} </h4>
        <p style="padding:3px;"></p>

        <div class="row">
            <div class="col-md-3">
                <a href="/addresses/{{$addresses[$i]->id}}/edit" class="btn btn-primary">Edit</a>
            </div>
            <div class="col-md-3 order-sm-1">
                {!! Form::open(['action' => ['AddressController@destroy', $addresses[$i]->id], 
                'method' => 'POST', 'class' => 'float-right']) !!}

                    {{ Form::hidden('_method', 'DELETE')}}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}

                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        @endfor
    
    @else
        <img src="{{ asset('img/nothing2.png')}}" class="img-fluid" style="margin: 0 auto; padding-top:40p;">
        <p style="padding:15px;"></p>

    @endif 

    <a class="btn btn-success btn-md" href="/addresses/create">Add New Shipping Address</a>
    <p style="padding:25px;"></p>

@endsection