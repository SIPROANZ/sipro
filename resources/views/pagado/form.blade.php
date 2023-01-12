<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Orden de pago') }}
            {{ Form::text('ordenpago_id', $ordenpagos->id, ['class' => 'form-control' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Beneficiario') }}
            {{ Form::text('beneficiario_name', $ordenpagos->beneficiario->nombre,['class' => 'form-control' . ($errors->has('beneficiario_name') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario']) }}
            {!! $errors->first('beneficiario_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('montopagado') }}
            {{ Form::text('montopagado', $ordenpagos->montoneto, ['class' => 'form-control' . ($errors->has('montopagado') ? ' is-invalid' : ''), 'placeholder' => 'Montopagado']) }}
            {!! $errors->first('montopagado', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('correlativo', 1, ['class' => 'form-control' . ($errors->has('correlativo') ? ' is-invalid' : ''), 'placeholder' => 'Correlativo']) }}
            {!! $errors->first('correlativo', '<div class="invalid-feedback">:message</div>') !!}
       
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('fechaanulacion') }}
            {{ Form::date('fechaanulacion', $pagado->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
     
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipoordenpago') }}
            {{ Form::select('tipoordenpago', [ '1' => 'Con Imputacion', '2' => 'Sin Imputacion' ],$pagado->tipoordenpago, ['class' => 'form-control' . ($errors->has('tipoordenpago') ? ' is-invalid' : ''), 'placeholder' => 'Tipo orden depago']) }}
            {!! $errors->first('tipoordenpago', '<div class="invalid-feedback">:message</div>') !!}
           
            {{ Form::hidden('status', 'PR', ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
      
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('tipo de pago') }}
            {{ Form::text('tipomovimiento_id',  $pagado->tipomovimiento_id, ['class' => 'form-control' . ($errors->has('tipomovimiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione tipo de pago']) }}
            {!! $errors->first('tipomovimiento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

       
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>