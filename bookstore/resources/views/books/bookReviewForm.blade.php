{!! Form::open(['action' => ['ReviewController@submitReview', $book->id], 'method' => 'POST', 'class' => 'form-inline']) !!}
    @csrf
    <div class="modal-header">
        <h3 class="modal-title ">Write A Review!</h3>
        <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>

    <div class="container">
        <div class="modal-body">
            <div class="form-inline">
                <div class="col-md-2 control-label">
                    {{ Form::label('rating', 'Rating') }}
                </div>
                
                {{ Form::label('one', '1')}}
                {{ Form::radio('rating', 1) }}
                
                {{ Form::label('two', '2')}}
                {{ Form::radio('rating', 2) }}
                
                {{ Form::label('three', '3')}}
                {{ Form::radio('rating', 3) }}
                
                {{ Form::label('four', '4')}}
                {{ Form::radio('rating', 4) }}
                
                {{ Form::label('five', '5')}}
                {{ Form::radio('rating', 5) }}
            </div>
            <p style="padding:10px;"></p>
            
            <div class="form-group">
                <div class="col-md-2 control-label">
                    {{ Form::label('header', 'Review Heading')}}
                </div>
                <div class="col-md-2">
                    {{ Form::text('header', '', ['class', 'form-control'])}}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 control-label">
                    {{ Form::label('body', 'Review Body')}}
                </div>
                <div class="col-md-2">
                    {{ Form::textArea('body', '', ['class', 'form-control'])}}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 control-label">
                    {{ Form::label('anonymous', 'Anonymous')}}
                </div>
                <div class="col-md-2">
                    {{ Form::checkbox('anonymous',true, false, ['class', 'form-control'])}}
                </div>
            </div>

            {{ Form::hidden('bookId', $book->id) }}
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            {{ Form::submit('Submit Review', ['class' => 'btn btn-md btn-primary']) }}
        </div>
    </div>

{!! Form::close() !!}
    