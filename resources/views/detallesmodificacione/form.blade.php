<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('modificacion_id') }}
            {{ Form::hidden('modificacion_id', $modificacion_id, ['class' => 'form-control' . ($errors->has('modificacion_id') ? ' is-invalid' : ''), 'placeholder' => 'Modificacion Id']) }}
            {!! $errors->first('modificacion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::select('unidadadministrativa_id', $unidadadministrativas,  $detallesmodificacione->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ejecucion_id') }}
            {{ Form::select('ejecucion_id', $ejecuciones, $detallesmodificacione->ejecucion_id, ['class' => 'form-control' . ($errors->has('ejecucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Ejecucion Id']) }}
            {!! $errors->first('ejecucion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoacredita') }}
            {{ Form::text('montoacredita', $detallesmodificacione->montoacredita, ['class' => 'form-control' . ($errors->has('montoacredita') ? ' is-invalid' : ''), 'placeholder' => 'Montoacredita']) }}
            {!! $errors->first('montoacredita', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montodebita') }}
            {{ Form::text('montodebita', $detallesmodificacione->montodebita, ['class' => 'form-control' . ($errors->has('montodebita') ? ' is-invalid' : ''), 'placeholder' => 'Montodebita']) }}
            {!! $errors->first('montodebita', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>