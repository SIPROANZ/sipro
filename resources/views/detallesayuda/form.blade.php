<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('montocompromiso') }}
            {{ Form::text('montocompromiso', $detallesayuda->montocompromiso, ['class' => 'form-control' . ($errors->has('montocompromiso') ? ' is-invalid' : ''), 'placeholder' => 'Montocompromiso']) }}
            {!! $errors->first('montocompromiso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ayuda_id') }}
            {{ Form::hidden('ayuda_id', 0, ['class' => 'form-control' . ($errors->has('ayuda_id') ? ' is-invalid' : ''), 'placeholder' => 'Ayuda']) }}
            {!! $errors->first('ayuda_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::select('unidadadministrativa_id',$unidadadministrativas, $detallesayuda->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidad administrativa']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ejecucion_id') }}
            {{ Form::select('ejecucion_id', $ejecuciones, $detallesayuda->ejecucion_id, ['class' => 'form-control' . ($errors->has('ejecucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejecucion']) }}
            {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>