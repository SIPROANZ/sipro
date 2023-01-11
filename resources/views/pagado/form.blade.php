<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('ordenpago_id') }}
            {{ Form::text('ordenpago_id', $ordenpagos->id, ['class' => 'form-control', 'readonly' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('beneficiario_id') }}
            {{ Form::text('beneficiario_id', $ordenpagos->beneficiario_id, ['class' => 'form-control', 'readonly' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario Id']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('tipoordenpago') }}
            {{ Form::text('tipoordenpago', $ordenpagos->tipoorden, ['class' => 'form-control' . ($errors->has('tipoordenpago') ? ' is-invalid' : ''), 'placeholder' => 'Tipoordenpago']) }}
            {!! $errors->first('tipoordenpago', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('montopagado') }}
            {{ Form::text('montopagado', $pagado->montopagado, ['class' => 'form-control' . ($errors->has('montopagado') ? ' is-invalid' : ''), 'placeholder' => $ordenpagos->montoneto]) }}
            {!! $errors->first('montopagado', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('correlativo', 1, ['class' => 'form-control' . ($errors->has('correlativo') ? ' is-invalid' : ''), 'placeholder' => 'Correlativo']) }}
            {!! $errors->first('correlativo', '<div class="invalid-feedback">:message</div>') !!}

        </div>
        </div>

        <div class="form-group">
            {{ Form::hidden('fechaanulacion', $pagado->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
            {{ Form::hidden('status', 'PR', ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}

        </div>

        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>
