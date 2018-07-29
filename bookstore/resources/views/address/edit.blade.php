@extends('layouts.app')

@section('title')Update Shipping Address @endsection

@section('content')

    <h1>Edit Address</h1>
    {!! Form::open(['action' => ['AddressController@update', $address->id], 'method' => 'POST']) !!}

        <div class="form-group">
            {{ Form::label('street_address', 'Street Address' )}}
            {{ Form::text('street_address', $address->street_address, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('city', 'City') }}
            {{ Form::text('city', $address->city, ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('state', 'State') }}
            {{ Form::text('state', $address->state, ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('zip_code', 'Zip Code') }}
            {{ Form::text('zip_code', $address->zip_code, ['class' => 'form-control'])}}
        </div>

        {{ Form::hidden('_method', 'PUT')}}
        {{ Form::submit('Update Address', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}

    <p style="padding:25px;"></p>

@endsection