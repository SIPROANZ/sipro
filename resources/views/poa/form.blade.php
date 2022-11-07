<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">
        
        <div class="col-md-3">   
        <div class="form-group">
            {{ Form::label('ejercicio_id') }}
            {{ Form::text('ejercicio_id', $poa->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejercicio Id']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('institucion_id') }}
            {{ Form::text('institucion_id', $poa->institucion_id, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucion Id']) }}
            {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('historico_id') }}
            {{ Form::text('historico_id', $poa->historico_id, ['class' => 'form-control' . ($errors->has('historico_id') ? ' is-invalid' : ''), 'placeholder' => 'Historico Id']) }}
            {!! $errors->first('historico_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('nacional_id') }}
            {{ Form::text('nacional_id', $poa->nacional_id, ['class' => 'form-control' . ($errors->has('nacional_id') ? ' is-invalid' : ''), 'placeholder' => 'Nacional Id']) }}
            {!! $errors->first('nacional_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('estrategico_id') }}
            {{ Form::text('estrategico_id', $poa->estrategico_id, ['class' => 'form-control' . ($errors->has('estrategico_id') ? ' is-invalid' : ''), 'placeholder' => 'Estrategico Id']) }}
            {!! $errors->first('estrategico_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('general_id') }}
            {{ Form::text('general_id', $poa->general_id, ['class' => 'form-control' . ($errors->has('general_id') ? ' is-invalid' : ''), 'placeholder' => 'General Id']) }}
            {!! $errors->first('general_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('municipal_id') }}
            {{ Form::text('municipal_id', $poa->municipal_id, ['class' => 'form-control' . ($errors->has('municipal_id') ? ' is-invalid' : ''), 'placeholder' => 'Municipal Id']) }}
            {!! $errors->first('municipal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('pei_id') }}
            {{ Form::text('pei_id', $poa->pei_id, ['class' => 'form-control' . ($errors->has('pei_id') ? ' is-invalid' : ''), 'placeholder' => 'Pei Id']) }}
            {!! $errors->first('pei_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::text('unidadadministrativa_id', $poa->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('proyecto') }}
            {{ Form::text('proyecto', $poa->proyecto, ['class' => 'form-control' . ($errors->has('proyecto') ? ' is-invalid' : ''), 'placeholder' => 'Proyecto']) }}
            {!! $errors->first('proyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('objetivoproyecto') }}
            {{ Form::text('objetivoproyecto', $poa->objetivoproyecto, ['class' => 'form-control' . ($errors->has('objetivoproyecto') ? ' is-invalid' : ''), 'placeholder' => 'Objetivoproyecto']) }}
            {!! $errors->first('objetivoproyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('montoproyecto') }}
            {{ Form::text('montoproyecto', $poa->montoproyecto, ['class' => 'form-control' . ($errors->has('montoproyecto') ? ' is-invalid' : ''), 'placeholder' => 'Montoproyecto']) }}
            {!! $errors->first('montoproyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('responsable') }}
            {{ Form::text('responsable', $poa->responsable, ['class' => 'form-control' . ($errors->has('responsable') ? ' is-invalid' : ''), 'placeholder' => 'Responsable']) }}
            {!! $errors->first('responsable', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $poa->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('sncfestrategico') }}
            {{ Form::text('sncfestrategico', $poa->sncfestrategico, ['class' => 'form-control' . ($errors->has('sncfestrategico') ? ' is-invalid' : ''), 'placeholder' => 'Sncfestrategico']) }}
            {!! $errors->first('sncfestrategico', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('sncfespecifico') }}
            {{ Form::text('sncfespecifico', $poa->sncfespecifico, ['class' => 'form-control' . ($errors->has('sncfespecifico') ? ' is-invalid' : ''), 'placeholder' => 'Sncfespecifico']) }}
            {!! $errors->first('sncfespecifico', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('psocial') }}
            {{ Form::text('psocial', $poa->psocial, ['class' => 'form-control' . ($errors->has('psocial') ? ' is-invalid' : ''), 'placeholder' => 'Psocial']) }}
            {!! $errors->first('psocial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('codigo') }}
            {{ Form::text('codigo', $poa->codigo, ['class' => 'form-control' . ($errors->has('codigo') ? ' is-invalid' : ''), 'placeholder' => 'Codigo']) }}
            {!! $errors->first('codigo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('tipoproyecto') }}
            {{ Form::text('tipoproyecto', $poa->tipoproyecto, ['class' => 'form-control' . ($errors->has('tipoproyecto') ? ' is-invalid' : ''), 'placeholder' => 'Tipoproyecto']) }}
            {!! $errors->first('tipoproyecto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('central') }}
            {{ Form::text('central', $poa->central, ['class' => 'form-control' . ($errors->has('central') ? ' is-invalid' : ''), 'placeholder' => 'Central']) }}
            {!! $errors->first('central', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $poa->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            </div>

</div>


</div>

<br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>