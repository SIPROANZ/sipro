<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('codigofamilia') }}
            {{ Form::text('codigofamilia', $familia->codigofamilia, ['class' => 'form-control' . ($errors->has('codigofamilia') ? ' is-invalid' : ''), 'placeholder' => 'Codigofamilia']) }}
            {!! $errors->first('codigofamilia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $familia->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('segmento_id') }}
            {{ Form::text('segmento_id', $familia->segmento_id, ['class' => 'form-control' . ($errors->has('segmento_id') ? ' is-invalid' : ''), 'placeholder' => 'Segmento Id']) }}
            {!! $errors->first('segmento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>