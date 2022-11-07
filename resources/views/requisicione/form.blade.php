<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
    <div class="col-md-3">  
        <div class="form-group">
            {{ Form::label('concepto') }}
            {{ Form::text('concepto', $requisicione->concepto, ['class' => 'form-control' . ($errors->has('concepto') ? ' is-invalid' : ''), 'placeholder' => 'Concepto']) }}
            {!! $errors->first('concepto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">      
        <div class="form-group">
            {{ Form::label('uso') }}
            {{ Form::text('uso', $requisicione->uso, ['class' => 'form-control' . ($errors->has('uso') ? ' is-invalid' : ''), 'placeholder' => 'Uso']) }}
            {!! $errors->first('uso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>  
        <div class="col-md-3">    
        <div class="form-group">
            {{ Form::label('ejercicio_id') }}
            {{ Form::text('ejercicio_id', $requisicione->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejercicio Id']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('institucion_id') }}
            {{ Form::text('institucion_id', $requisicione->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucion Id']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::text('unidadadministrativa_id', $requisicione->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('correlativo') }}
            {{ Form::text('correlativo', $requisicione->correlativo, ['class' => 'form-control' . ($errors->has('correlativo') ? ' is-invalid' : ''), 'placeholder' => 'Correlativo']) }}
            {!! $errors->first('correlativo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('tiposgp_id') }}
            {{ Form::text('tiposgp_id', $requisicione->tiposgp_id, ['class' => 'form-control' . ($errors->has('tiposgp_id') ? ' is-invalid' : ''), 'placeholder' => 'Tiposgp Id']) }}
            {!! $errors->first('tiposgp_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('estatus') }}
            {{ Form::text('estatus', $requisicione->estatus, ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>