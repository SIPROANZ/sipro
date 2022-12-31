<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('montocompromiso') }}
            {{ Form::text('montocompromiso', $detallesprecompromiso->montocompromiso, ['class' => 'form-control' . ($errors->has('montocompromiso') ? ' is-invalid' : ''), 'placeholder' => 'Montocompromiso']) }}
            {!! $errors->first('montocompromiso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precompromiso_id') }}
            {{ Form::text('precompromiso_id', $detallesprecompromiso->precompromiso_id, ['class' => 'form-control' . ($errors->has('precompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Precompromiso Id']) }}
            {!! $errors->first('precompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::text('unidadadministrativa_id', $detallesprecompromiso->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ejecucion_id') }}
            {{ Form::text('ejecucion_id', $detallesprecompromiso->ejecucion_id, ['class' => 'form-control' . ($errors->has('ejecucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejecucion Id']) }}
            {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>