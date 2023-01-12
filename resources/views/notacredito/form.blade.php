<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Ejercicio') }}
            {{ Form::select('ejercicio_id', $ejercicios, $notacredito->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciones el ejercicio']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Cuenta Bancaria') }}
            {{ Form::select('cuentasbancaria_id', $cuentasbancarias, $notacredito->cuentasbancaria_id, ['class' => 'form-control' . ($errors->has('cuentasbancaria_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la cuenta bancaria']) }}
            {!! $errors->first('cuentasbancaria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Beneficiario') }}
            {{ Form::select('beneficiario_id', $beneficiarios, $notacredito->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el beneficiario']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::select('institucione_id', $instituciones, $notacredito->institucione_id, ['class' => 'form-control' . ($errors->has('institucione_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucione Id']) }}
            {!! $errors->first('institucione_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::number('montonc', $notacredito->montonc, ['class' => 'form-control' . ($errors->has('montonc') ? ' is-invalid' : ''), 'placeholder' => 'Montonc']) }}
            {!! $errors->first('montonc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::date('fecha', $notacredito->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Referencia') }}
            {{ Form::text('referencianc', $notacredito->referencianc, ['class' => 'form-control' . ($errors->has('referencianc') ? ' is-invalid' : ''), 'placeholder' => 'Referencianc']) }}
            {!! $errors->first('referencianc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('descripcion', $notacredito->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>