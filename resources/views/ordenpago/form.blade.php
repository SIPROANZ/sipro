<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nordenpago') }}
            {{ Form::text('nordenpago', $ordenpago->nordenpago, ['class' => 'form-control' . ($errors->has('nordenpago') ? ' is-invalid' : ''), 'placeholder' => 'Nordenpago']) }}
            {!! $errors->first('nordenpago', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiario_id') }}
            {{ Form::text('beneficiario_id', $ordenpago->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario Id']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montobase') }}
            {{ Form::text('montobase', $ordenpago->montobase, ['class' => 'form-control' . ($errors->has('montobase') ? ' is-invalid' : ''), 'placeholder' => 'Montobase']) }}
            {!! $errors->first('montobase', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoretencion') }}
            {{ Form::text('montoretencion', $ordenpago->montoretencion, ['class' => 'form-control' . ($errors->has('montoretencion') ? ' is-invalid' : ''), 'placeholder' => 'Montoretencion']) }}
            {!! $errors->first('montoretencion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoneto') }}
            {{ Form::text('montoneto', $ordenpago->montoneto, ['class' => 'form-control' . ($errors->has('montoneto') ? ' is-invalid' : ''), 'placeholder' => 'Montoneto']) }}
            {!! $errors->first('montoneto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaanulacion') }}
            {{ Form::text('fechaanulacion', $ordenpago->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $ordenpago->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipoorden') }}
            {{ Form::text('tipoorden', $ordenpago->tipoorden, ['class' => 'form-control' . ($errors->has('tipoorden') ? ' is-invalid' : ''), 'placeholder' => 'Tipoorden']) }}
            {!! $errors->first('tipoorden', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoiva') }}
            {{ Form::text('montoiva', $ordenpago->montoiva, ['class' => 'form-control' . ($errors->has('montoiva') ? ' is-invalid' : ''), 'placeholder' => 'Montoiva']) }}
            {!! $errors->first('montoiva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoexento') }}
            {{ Form::text('montoexento', $ordenpago->montoexento, ['class' => 'form-control' . ($errors->has('montoexento') ? ' is-invalid' : ''), 'placeholder' => 'Montoexento']) }}
            {!! $errors->first('montoexento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('compromiso_id') }}
            {{ Form::text('compromiso_id', $ordenpago->compromiso_id, ['class' => 'form-control' . ($errors->has('compromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Compromiso Id']) }}
            {!! $errors->first('compromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>