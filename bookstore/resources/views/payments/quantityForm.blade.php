{!! Form::open(['action' => ['ShoppingCartController@updateBookQuantityInShoppingCart', $book->id]]) !!}

    <div class="form-group">
        {{ Form::label('quantityValue','Quantity')}}
        {{ Form::number('quantityValue', 1, ['class' => 'form-control'])}}
    </div>
    {{ Form::hidden('bookId', $book->id)}}
    {{ Form::hidden('price', $book->price)}}

    {{ Form::submit('Add to Cart', ['class' =>'btn btn-md btn-primary', 'style' => 'padding:12px'])}}

{!! Form::close() !!}