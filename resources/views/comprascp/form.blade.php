<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('compra_id') }}
            {{ Form::text('compra_id', $comprascp->compra_id, ['class' => 'form-control' . ($errors->has('compra_id') ? ' is-invalid' : ''), 'placeholder' => 'Compra Id']) }}
            {!! $errors->first('compra_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::text('unidadadministrativa_id', $comprascp->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ejecucion_id') }}
            {{ Form::text('ejecucion_id', $comprascp->ejecucion_id, ['class' => 'form-control' . ($errors->has('ejecucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejecucion Id']) }}
            {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $comprascp->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('disponible') }}
            {{ Form::text('disponible', $comprascp->disponible, ['class' => 'form-control' . ($errors->has('disponible') ? ' is-invalid' : ''), 'placeholder' => 'Disponible']) }}
            {!! $errors->first('disponible', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <br>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>