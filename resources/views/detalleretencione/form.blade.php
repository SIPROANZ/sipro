<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('retencion_id') }}
            {{ Form::text('retencion_id', $detalleretencione->retencion_id, ['class' => 'form-control' . ($errors->has('retencion_id') ? ' is-invalid' : ''), 'placeholder' => 'Retencion Id']) }}
            {!! $errors->first('retencion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ordenpago_id') }}
            {{ Form::text('ordenpago_id', $detalleretencione->ordenpago_id, ['class' => 'form-control' . ($errors->has('ordenpago_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenpago Id']) }}
            {!! $errors->first('ordenpago_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoneto') }}
            {{ Form::text('montoneto', $detalleretencione->montoneto, ['class' => 'form-control' . ($errors->has('montoneto') ? ' is-invalid' : ''), 'placeholder' => 'Montoneto']) }}
            {!! $errors->first('montoneto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montoIVA') }}
            {{ Form::text('montoIVA', $detalleretencione->montoIVA, ['class' => 'form-control' . ($errors->has('montoIVA') ? ' is-invalid' : ''), 'placeholder' => 'Montoiva']) }}
            {!! $errors->first('montoIVA', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>