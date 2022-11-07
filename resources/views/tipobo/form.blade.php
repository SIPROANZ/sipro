<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">

    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $tipobo->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>