{!! Form::open(['action' => 'ShoppingCartController@addBookToShoppingCart']) !!}

    <div class="form-group">
        {{ Form::label('quantity','Quantity')}}
        {{ Form::number('quantity', 1, ['class' => 'form-control'])}}
    </div>
    {{ Form::hidden('bookId', $book->id)}}
    {{ Form::hidden('price', $book->price)}}

    {{ Form::submit('Add to Cart', ['class' =>'btn btn-md btn-primary', 'style' => 'padding:12px'])}}

{!! Form::close() !!}