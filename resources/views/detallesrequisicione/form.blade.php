<div class="box box-info padding-1">
    <div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('requisicion') }}
            {{ Form::select('requisicion_id', $requisiciones, $detallesrequisicione->requisicion_id, ['class' => 'form-control' . ($errors->has('requisicion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una Requisicion']) }}
            {!! $errors->first('requisicion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('bos') }}
            {{ Form::select('bos_id', $bos, $detallesrequisicione->bos_id, ['class' => 'form-control' . ($errors->has('bos_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Bos']) }}
            {!! $errors->first('bos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $detallesrequisicione->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>