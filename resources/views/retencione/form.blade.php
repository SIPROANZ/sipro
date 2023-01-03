<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('descripcion', $retencione->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Porcentaje') }}
            {{ Form::text('porcentaje', $retencione->porcentaje, ['class' => 'form-control' . ($errors->has('porcentaje') ? ' is-invalid' : ''), 'placeholder' => 'Porcentaje']) }}
            {!! $errors->first('porcentaje', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo de Deducción') }}
            {{ Form::select('tipo', [ 'I' => 'Impuesto', 'R' => 'Retención' ] , $retencione->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese un Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo de Retencion') }}
            {{ Form::select('tiporetencion_id', $tiporetencion, $retencione->tiporetencion_id, ['class' => 'form-control' . ($errors->has('tiporetencion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese un Tipo']) }}
            {!! $errors->first('tiporetencion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>

