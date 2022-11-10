<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('rif') }}
            {{ Form::text('rif', $institucione->rif, ['class' => 'form-control' . ($errors->has('rif') ? ' is-invalid' : ''), 'placeholder' => 'Rif']) }}
            {!! $errors->first('rif', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('institucion') }}
            {{ Form::text('institucion', $institucione->institucion, ['class' => 'form-control' . ($errors->has('institucion') ? ' is-invalid' : ''), 'placeholder' => 'Institucion']) }}
            {!! $errors->first('institucion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $institucione->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $institucione->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $institucione->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('baselegal') }}
            {{ Form::text('baselegal', $institucione->baselegal, ['class' => 'form-control' . ($errors->has('baselegal') ? ' is-invalid' : ''), 'placeholder' => 'Baselegal']) }}
            {!! $errors->first('baselegal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('web') }}
            {{ Form::text('web', $institucione->web, ['class' => 'form-control' . ($errors->has('web') ? ' is-invalid' : ''), 'placeholder' => 'Web']) }}
            {!! $errors->first('web', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('codigopostal') }}
            {{ Form::text('codigopostal', $institucione->codigopostal, ['class' => 'form-control' . ($errors->has('codigopostal') ? ' is-invalid' : ''), 'placeholder' => 'Codigopostal']) }}
            {!! $errors->first('codigopostal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('organigrama') }}
            {{ Form::text('organigrama', $institucione->organigrama, ['class' => 'form-control' . ($errors->has('organigrama') ? ' is-invalid' : ''), 'placeholder' => 'Organigrama']) }}
            {!! $errors->first('organigrama', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('logoinstitucion') }}
            {{ Form::text('logoinstitucion', $institucione->logoinstitucion, ['class' => 'form-control' . ($errors->has('logoinstitucion') ? ' is-invalid' : ''), 'placeholder' => 'Logoinstitucion']) }}
            {!! $errors->first('logoinstitucion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vision') }}
            {{ Form::text('vision', $institucione->vision, ['class' => 'form-control' . ($errors->has('vision') ? ' is-invalid' : ''), 'placeholder' => 'Vision']) }}
            {!! $errors->first('vision', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('mision') }}
            {{ Form::text('mision', $institucione->mision, ['class' => 'form-control' . ($errors->has('mision') ? ' is-invalid' : ''), 'placeholder' => 'Mision']) }}
            {!! $errors->first('mision', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('razonsocial') }}
            {{ Form::text('razonsocial', $institucione->razonsocial, ['class' => 'form-control' . ($errors->has('razonsocial') ? ' is-invalid' : ''), 'placeholder' => 'Razonsocial']) }}
            {!! $errors->first('razonsocial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('municipio_id') }}
            {{ Form::text('municipio_id', $institucione->municipio_id, ['class' => 'form-control' . ($errors->has('municipio_id') ? ' is-invalid' : ''), 'placeholder' => 'Municipio Id']) }}
            {!! $errors->first('municipio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>