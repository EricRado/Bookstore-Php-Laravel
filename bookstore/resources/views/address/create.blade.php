@extends('layouts.app')

@section('title')Add New Shipping Address @endsection

@section('content')

    <h2>Add New Shipping Address</h2>
    <p style="padding:20px"></p>

    {!! Form::open(['action' => 'AddressController@store']) !!}

        <div class="form-group">
            {{ Form::label('street_address', 'Street Address' )}}
            {{ Form::text('street_address', '', ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('city', 'City') }}
            {{ Form::text('city', '', ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('state', 'State') }}
            {{ Form::text('state', '', ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('zip_code', 'Zip Code') }}
            {{ Form::text('zip_code', '', ['class' => 'form-control'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}


    <p style="padding:25px;"></p>

@endsection