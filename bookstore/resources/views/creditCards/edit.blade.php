@extends('layouts.app')

@section('title')Update Card Payment @endsection

@section('content')

    <h1>Edit Credit Card</h1>
    {!! Form::open(['action' => ['CreditCardController@update', $creditCard->id], 'method' => 'POST']) !!}

        <div class="form-group">
            {{ Form::label('name_on_card','Name On Card') }}
            {{ Form::text('name_on_card', $creditCard->name_on_card, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
                {{ Form::label('cc_number', 'Card Number') }}
                {{ Form::text('cc_number', $creditCard->cc_number, ['class' => 'form-control']) }}
            </div>
    
            <div class="form-group">
                {{ Form::label('security_code', 'Security Code') }}
                {{ Form::text('security_code', $creditCard->security_code, ['class' => 'form-control']) }}
            </div>
    
            <div class="form-group">
                {{ Form::label('expiration_date', 'Expiration Date') }}
                {{ Form::date('expiration_date', $creditCard->expiration_date, ['class' => 'form-control']) }}
            </div>
    
            <div class="form-group">
                {{ Form::label('provider', 'Provider') }}
                {{ Form::text('provider', $creditCard->provider, ['class' => 'form-control']) }}
            </div>
            
            {{ Form::hidden('_method', 'PUT')}}
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}

    {!! Form::close() !!}

    <p style="padding:25px;"></p>

@endsection