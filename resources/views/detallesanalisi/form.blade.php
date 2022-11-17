<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('proveedor') }}
            {{ Form::select('proveedor_id', $proveedores, $detallesanalisi->proveedor_id, ['class' => 'form-control' . ($errors->has('proveedor_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Proveedor']) }}
            {!! $errors->first('proveedor_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('detalle analisis') }}
            {{ Form::select('analisis_id', $analisis, $detallesanalisi->analisis_id, ['class' => 'form-control' . ($errors->has('analisis_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Analisis de Cotizacion']) }}
            {!! $errors->first('analisis_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('bos (Bienes, Obras y Servicios)') }}
            {{ Form::select('bos_id', $bos, $detallesanalisi->bos_id, ['class' => 'form-control' . ($errors->has('bos_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Bos']) }}
            {!! $errors->first('bos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

        <div class="row">
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $detallesanalisi->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('precio') }}
            {{ Form::text('precio', $detallesanalisi->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('subtotal') }}
            {{ Form::text('subtotal', $detallesanalisi->subtotal, ['class' => 'form-control' . ($errors->has('subtotal') ? ' is-invalid' : ''), 'placeholder' => 'Subtotal']) }}
            {!! $errors->first('subtotal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('iva') }}
            {{ Form::text('iva', $detallesanalisi->iva, ['class' => 'form-control' . ($errors->has('iva') ? ' is-invalid' : ''), 'placeholder' => 'Iva']) }}
            {!! $errors->first('iva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('total') }}
            {{ Form::text('total', $detallesanalisi->total, ['class' => 'form-control' . ($errors->has('total') ? ' is-invalid' : ''), 'placeholder' => 'Total']) }}
            {!! $errors->first('total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>