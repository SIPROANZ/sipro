<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">
        
        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('poa_id') }}
            {{ Form::text('poa_id', $meta->poa_id, ['class' => 'form-control' . ($errors->has('poa_id') ? ' is-invalid' : ''), 'placeholder' => 'Poa Id']) }}
            {!! $errors->first('poa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cantidad1') }}
            {{ Form::text('cantidad1', $meta->cantidad1, ['class' => 'form-control' . ($errors->has('cantidad1') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad1']) }}
            {!! $errors->first('cantidad1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cantidad2') }}
            {{ Form::text('cantidad2', $meta->cantidad2, ['class' => 'form-control' . ($errors->has('cantidad2') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad2']) }}
            {!! $errors->first('cantidad2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cantidad3') }}
            {{ Form::text('cantidad3', $meta->cantidad3, ['class' => 'form-control' . ($errors->has('cantidad3') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad3']) }}
            {!! $errors->first('cantidad3', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cantidad4') }}
            {{ Form::text('cantidad4', $meta->cantidad4, ['class' => 'form-control' . ($errors->has('cantidad4') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad4']) }}
            {!! $errors->first('cantidad4', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('meta') }}
            {{ Form::text('meta', $meta->meta, ['class' => 'form-control' . ($errors->has('meta') ? ' is-invalid' : ''), 'placeholder' => 'Meta']) }}
            {!! $errors->first('meta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $meta->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('ejercicio_id') }}
            {{ Form::text('ejercicio_id', $meta->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejercicio Id']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('institucion_id') }}
            {{ Form::text('institucion_id', $meta->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucion Id']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::text('unidadadministrativa_id', $meta->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $meta->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('enero') }}
            {{ Form::text('enero', $meta->enero, ['class' => 'form-control' . ($errors->has('enero') ? ' is-invalid' : ''), 'placeholder' => 'Enero']) }}
            {!! $errors->first('enero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('febrero') }}
            {{ Form::text('febrero', $meta->febrero, ['class' => 'form-control' . ($errors->has('febrero') ? ' is-invalid' : ''), 'placeholder' => 'Febrero']) }}
            {!! $errors->first('febrero', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('marzo') }}
            {{ Form::text('marzo', $meta->marzo, ['class' => 'form-control' . ($errors->has('marzo') ? ' is-invalid' : ''), 'placeholder' => 'Marzo']) }}
            {!! $errors->first('marzo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('abril') }}
            {{ Form::text('abril', $meta->abril, ['class' => 'form-control' . ($errors->has('abril') ? ' is-invalid' : ''), 'placeholder' => 'Abril']) }}
            {!! $errors->first('abril', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('mayo') }}
            {{ Form::text('mayo', $meta->mayo, ['class' => 'form-control' . ($errors->has('mayo') ? ' is-invalid' : ''), 'placeholder' => 'Mayo']) }}
            {!! $errors->first('mayo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('junio') }}
            {{ Form::text('junio', $meta->junio, ['class' => 'form-control' . ($errors->has('junio') ? ' is-invalid' : ''), 'placeholder' => 'Junio']) }}
            {!! $errors->first('junio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('julio') }}
            {{ Form::text('julio', $meta->julio, ['class' => 'form-control' . ($errors->has('julio') ? ' is-invalid' : ''), 'placeholder' => 'Julio']) }}
            {!! $errors->first('julio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('agosto') }}
            {{ Form::text('agosto', $meta->agosto, ['class' => 'form-control' . ($errors->has('agosto') ? ' is-invalid' : ''), 'placeholder' => 'Agosto']) }}
            {!! $errors->first('agosto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('septiembre') }}
            {{ Form::text('septiembre', $meta->septiembre, ['class' => 'form-control' . ($errors->has('septiembre') ? ' is-invalid' : ''), 'placeholder' => 'Septiembre']) }}
            {!! $errors->first('septiembre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('octubre') }}
            {{ Form::text('octubre', $meta->octubre, ['class' => 'form-control' . ($errors->has('octubre') ? ' is-invalid' : ''), 'placeholder' => 'Octubre']) }}
            {!! $errors->first('octubre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('noviembre') }}
            {{ Form::text('noviembre', $meta->noviembre, ['class' => 'form-control' . ($errors->has('noviembre') ? ' is-invalid' : ''), 'placeholder' => 'Noviembre']) }}
            {!! $errors->first('noviembre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('diciembre') }}
            {{ Form::text('diciembre', $meta->diciembre, ['class' => 'form-control' . ($errors->has('diciembre') ? ' is-invalid' : ''), 'placeholder' => 'Diciembre']) }}
            {!! $errors->first('diciembre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('unidadmedida') }}
            {{ Form::text('unidadmedida', $meta->unidadmedida, ['class' => 'form-control' . ($errors->has('unidadmedida') ? ' is-invalid' : ''), 'placeholder' => 'Unidadmedida']) }}
            {!! $errors->first('unidadmedida', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('unidadadministrativasolicitante') }}
            {{ Form::text('unidadadministrativasolicitante', $meta->unidadadministrativasolicitante, ['class' => 'form-control' . ($errors->has('unidadadministrativasolicitante') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativasolicitante']) }}
            {!! $errors->first('unidadadministrativasolicitante', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('impacto') }}
            {{ Form::text('impacto', $meta->impacto, ['class' => 'form-control' . ($errors->has('impacto') ? ' is-invalid' : ''), 'placeholder' => 'Impacto']) }}
            {!! $errors->first('impacto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

</div>


</div>

<br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>