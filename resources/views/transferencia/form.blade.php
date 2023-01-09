<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('cuentasbancaria_id') }}
            {{ Form::text('cuentasbancaria_id', $transferencia->cuentasbancaria_id, ['class' => 'form-control' . ($errors->has('cuentasbancaria_id') ? ' is-invalid' : ''), 'placeholder' => 'Cuentasbancaria Id']) }}
            {!! $errors->first('cuentasbancaria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiario_id') }}
            {{ Form::text('beneficiario_id', $transferencia->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario Id']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('pagado_id') }}
            {{ Form::text('pagado_id', $transferencia->pagado_id, ['class' => 'form-control' . ($errors->has('pagado_id') ? ' is-invalid' : ''), 'placeholder' => 'Pagado Id']) }}
            {!! $errors->first('pagado_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montotransferencia') }}
            {{ Form::text('montotransferencia', $transferencia->montotransferencia, ['class' => 'form-control' . ($errors->has('montotransferencia') ? ' is-invalid' : ''), 'placeholder' => 'Montotransferencia']) }}
            {!! $errors->first('montotransferencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaanulacion') }}
            {{ Form::text('fechaanulacion', $transferencia->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('concepto') }}
            {{ Form::text('concepto', $transferencia->concepto, ['class' => 'form-control' . ($errors->has('concepto') ? ' is-invalid' : ''), 'placeholder' => 'Concepto']) }}
            {!! $errors->first('concepto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('egreso') }}
            {{ Form::text('egreso', $transferencia->egreso, ['class' => 'form-control' . ($errors->has('egreso') ? ' is-invalid' : ''), 'placeholder' => 'Egreso']) }}
            {!! $errors->first('egreso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoorden') }}
            {{ Form::text('montoorden', $transferencia->montoorden, ['class' => 'form-control' . ($errors->has('montoorden') ? ' is-invalid' : ''), 'placeholder' => 'Montoorden']) }}
            {!! $errors->first('montoorden', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('referenciabancaria') }}
            {{ Form::text('referenciabancaria', $transferencia->referenciabancaria, ['class' => 'form-control' . ($errors->has('referenciabancaria') ? ' is-invalid' : ''), 'placeholder' => 'Referenciabancaria']) }}
            {!! $errors->first('referenciabancaria', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('conceptoanulacion') }}
            {{ Form::text('conceptoanulacion', $transferencia->conceptoanulacion, ['class' => 'form-control' . ($errors->has('conceptoanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Conceptoanulacion']) }}
            {!! $errors->first('conceptoanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>