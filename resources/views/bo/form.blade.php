<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $bo->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('producto_id') }}
            {{ Form::text('producto_id', $bo->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => 'Producto Id']) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unidadmedida_id') }}
            {{ Form::text('unidadmedida_id', $bo->unidadmedida_id, ['class' => 'form-control' . ($errors->has('unidadmedida_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadmedida Id']) }}
            {!! $errors->first('unidadmedida_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipobos_id') }}
            {{ Form::text('tipobos_id', $bo->tipobos_id, ['class' => 'form-control' . ($errors->has('tipobos_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipobos Id']) }}
            {!! $errors->first('tipobos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>