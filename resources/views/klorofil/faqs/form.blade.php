{!! Form::open(['url' => $url,'class'=>'form-horizontal','method'=>$method]) !!}
   
    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
        <label for="question" class="col-md-4 control-label">Pregunta *</label>

        <div class="col-md-6">
            {!! Form::text('question', $faq->question,['class'=>"form-control",'required', 'autofocus']) !!}

            @if ($errors->has('question'))
                <span class="help-block">
                    <strong>{{ $errors->first('question') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
        <label for="answer" class="col-md-4 control-label">Respuesta *</label>

        <div class="col-md-6">
            {!! Form::textarea('answer', $faq->question,['class'=>"form-control",'required', 'autofocus','rows'=>5]) !!}
            @if ($errors->has('answer'))
                <span class="help-block">
                    <strong>{{ $errors->first('answer') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
    {!! link_to_route('faqs.index', $title = "Cancelar",null, ['class' =>'btn btn-danger']) !!}
{!! Form::close() !!}