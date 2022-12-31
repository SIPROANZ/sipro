<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">
        
        <div class="col-md-4"> 
        <div class="form-group">
            {{ Form::label('N orden de pago') }}
            {{ Form::text('nordenpago', $ordenpago->nordenpago, ['class' => 'form-control' . ($errors->has('nordenpago') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('nordenpago', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Beneficiario') }}
            {{ Form::text('beneficiario_id', $ordenpago->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto base') }}
            {{ Form::text('montobase', $ordenpago->montobase, ['class' => 'form-control' . ($errors->has('montobase') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montobase', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto retencion') }}
            {{ Form::text('montoretencion', $ordenpago->montoretencion, ['class' => 'form-control' . ($errors->has('montoretencion') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montoretencion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto neto') }}
            {{ Form::text('montoneto', $ordenpago->montoneto, ['class' => 'form-control' . ($errors->has('montoneto') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montoneto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
        {{ Form::label('Anulacion') }}
            {{ Form::date('fechaanulacion', $ordenpago->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de anulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
        {{ Form::label('Estado') }}
            {{ Form::select('status', ['EP'=>'EN PROCESO', 'PR'=>'PROCESADO', 'AN'=>'ANULADO'],$ordenpago->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Tipo orden') }}
            {{ Form::text('tipoorden', $ordenpago->tipoorden, ['class' => 'form-control' . ($errors->has('tipoorden') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('tipoorden', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto IVA') }}
            {{ Form::text('montoiva', $ordenpago->montoiva, ['class' => 'form-control' . ($errors->has('montoiva') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montoiva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Monto exento') }}
            {{ Form::text('montoexento', $ordenpago->montoexento, ['class' => 'form-control' . ($errors->has('montoexento') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('montoexento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('Compromiso') }}
            {{ Form::text('compromiso_id', $ordenpago->compromiso_id, ['class' => 'form-control' . ($errors->has('compromiso_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('compromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

</div>


</div>

<br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>