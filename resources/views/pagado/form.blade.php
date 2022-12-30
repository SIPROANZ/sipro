<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('ordenpago_id') }}
            {{ Form::text('ordenpago_id', $pagado->ordenpago_id, ['class' => 'form-control' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiario_id') }}
            {{ Form::text('beneficiario_id', $pagado->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario Id']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('transferencia_id') }}
            {{ Form::text('transferencia_id', $pagado->transferencia_id, ['class' => 'form-control' . ($errors->has('transferencia_id') ? ' is-invalid' : ''), 'placeholder' => 'Transferencia Id']) }}
            {!! $errors->first('transferencia_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montopagado') }}
            {{ Form::text('montopagado', $pagado->montopagado, ['class' => 'form-control' . ($errors->has('montopagado') ? ' is-invalid' : ''), 'placeholder' => 'Montopagado']) }}
            {!! $errors->first('montopagado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaanulacion') }}
            {{ Form::text('fechaanulacion', $pagado->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $pagado->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('egreso') }}
            {{ Form::text('egreso', $pagado->egreso, ['class' => 'form-control' . ($errors->has('egreso') ? ' is-invalid' : ''), 'placeholder' => 'Egreso']) }}
            {!! $errors->first('egreso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipoordenpago') }}
            {{ Form::text('tipoordenpago', $pagado->tipoordenpago, ['class' => 'form-control' . ($errors->has('tipoordenpago') ? ' is-invalid' : ''), 'placeholder' => 'Tipoordenpago']) }}
            {!! $errors->first('tipoordenpago', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>