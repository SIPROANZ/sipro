<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
    <div class="col-md-3">  
        <div class="form-group">
            {{ Form::label('codigoproducto') }}
            {{ Form::text('codigoproducto', $producto->codigoproducto, ['class' => 'form-control' . ($errors->has('codigoproducto') ? ' is-invalid' : ''), 'placeholder' => 'Codigoproducto']) }}
            {!! $errors->first('codigoproducto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('clase_id') }}
            {{ Form::text('clase_id', $producto->clase_id, ['class' => 'form-control' . ($errors->has('clase_id') ? ' is-invalid' : ''), 'placeholder' => 'Clase Id']) }}
            {!! $errors->first('clase_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            </div>
            </div>

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>