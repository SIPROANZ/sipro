<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::text('unidadadministrativa_id', $compromiso->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipocompromiso_id') }}
            {{ Form::text('tipocompromiso_id', $compromiso->tipocompromiso_id, ['class' => 'form-control' . ($errors->has('tipocompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipocompromiso Id']) }}
            {!! $errors->first('tipocompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ncompromiso') }}
            {{ Form::text('ncompromiso', $compromiso->ncompromiso, ['class' => 'form-control' . ($errors->has('ncompromiso') ? ' is-invalid' : ''), 'placeholder' => 'Ncompromiso']) }}
            {!! $errors->first('ncompromiso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiario_id') }}
            {{ Form::text('beneficiario_id', $compromiso->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario Id']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montocompromiso') }}
            {{ Form::text('montocompromiso', $compromiso->montocompromiso, ['class' => 'form-control' . ($errors->has('montocompromiso') ? ' is-invalid' : ''), 'placeholder' => 'Montocompromiso']) }}
            {!! $errors->first('montocompromiso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $compromiso->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::text('documento', $compromiso->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaanulacion') }}
            {{ Form::text('fechaanulacion', $compromiso->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precompromiso_id') }}
            {{ Form::text('precompromiso_id', $compromiso->precompromiso_id, ['class' => 'form-control' . ($errors->has('precompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Precompromiso Id']) }}
            {!! $errors->first('precompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('compra_id') }}
            {{ Form::text('compra_id', $compromiso->compra_id, ['class' => 'form-control' . ($errors->has('compra_id') ? ' is-invalid' : ''), 'placeholder' => 'Compra Id']) }}
            {!! $errors->first('compra_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ayuda_id') }}
            {{ Form::text('ayuda_id', $compromiso->ayuda_id, ['class' => 'form-control' . ($errors->has('ayuda_id') ? ' is-invalid' : ''), 'placeholder' => 'Ayuda Id']) }}
            {!! $errors->first('ayuda_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>