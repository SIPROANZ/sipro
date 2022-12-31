<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('numero') }}
            {{ Form::text('numero', $modificacione->numero, ['class' => 'form-control' . ($errors->has('numero') ? ' is-invalid' : ''), 'placeholder' => 'Numero']) }}
            {!! $errors->first('numero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipomodificacion_id') }}
            {{ Form::text('tipomodificacion_id', $modificacione->tipomodificacion_id, ['class' => 'form-control' . ($errors->has('tipomodificacion_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipomodificacion Id']) }}
            {!! $errors->first('tipomodificacion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $modificacione->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $modificacione->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaanulacion') }}
            {{ Form::text('fechaanulacion', $modificacione->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montocredita') }}
            {{ Form::text('montocredita', $modificacione->montocredita, ['class' => 'form-control' . ($errors->has('montocredita') ? ' is-invalid' : ''), 'placeholder' => 'Montocredita']) }}
            {!! $errors->first('montocredita', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montodebita') }}
            {{ Form::text('montodebita', $modificacione->montodebita, ['class' => 'form-control' . ($errors->has('montodebita') ? ' is-invalid' : ''), 'placeholder' => 'Montodebita']) }}
            {!! $errors->first('montodebita', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ncredito') }}
            {{ Form::text('ncredito', $modificacione->ncredito, ['class' => 'form-control' . ($errors->has('ncredito') ? ' is-invalid' : ''), 'placeholder' => 'Ncredito']) }}
            {!! $errors->first('ncredito', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>