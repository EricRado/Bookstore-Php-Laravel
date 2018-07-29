@extends('layouts.app')

@section('title')Add New Card Payment @endsection

@section('content')

    <h2>Add New Card Payment</h2>
    <p style="padding:20px"></p>

    {!! Form::open(['action' => 'CreditCardController@store']) !!}

        <div class="form-group">
            {{ Form::label('name_on_card', 'Name On Card' )}}
            {{ Form::text('name_on_card', '', ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('cc_number', 'Card Number') }}
            {{ Form::text('cc_number', '', ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('security_code', 'Security Code') }}
            {{ Form::text('security_code', '', ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('expiration_date', 'Expiration Date') }}
            {{ Form::date('expiration_date', '', ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{ Form::label('provider', 'Provider') }}
            {{ Form::text('provider', '', ['class' => 'form-control'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}

    <p style="padding:25px;"></p>

@endsection