<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('banco_id') }}
            {{ Form::text('banco_id', $cuentasbancaria->banco_id, ['class' => 'form-control' . ($errors->has('banco_id') ? ' is-invalid' : ''), 'placeholder' => 'Banco Id']) }}
            {!! $errors->first('banco_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('institucion_id') }}
            {{ Form::text('institucion_id', $cuentasbancaria->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucion Id']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaapertura') }}
            {{ Form::text('fechaapertura', $cuentasbancaria->fechaapertura, ['class' => 'form-control' . ($errors->has('fechaapertura') ? ' is-invalid' : ''), 'placeholder' => 'Fechaapertura']) }}
            {!! $errors->first('fechaapertura', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoapertura') }}
            {{ Form::text('montoapertura', $cuentasbancaria->montoapertura, ['class' => 'form-control' . ($errors->has('montoapertura') ? ' is-invalid' : ''), 'placeholder' => 'Montoapertura']) }}
            {!! $errors->first('montoapertura', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montosaldo') }}
            {{ Form::text('montosaldo', $cuentasbancaria->montosaldo, ['class' => 'form-control' . ($errors->has('montosaldo') ? ' is-invalid' : ''), 'placeholder' => 'Montosaldo']) }}
            {!! $errors->first('montosaldo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cuenta') }}
            {{ Form::text('cuenta', $cuentasbancaria->cuenta, ['class' => 'form-control' . ($errors->has('cuenta') ? ' is-invalid' : ''), 'placeholder' => 'Cuenta']) }}
            {!! $errors->first('cuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $cuentasbancaria->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>