<div class="box box-info padding-1">
    <div class="box-body">

    <div class="row">
        
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('producto_id') }}
            {{ Form::text('producto_id', $productoscp->producto_id, ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => 'producto_id']) }}
            {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('clasificadorpresupuestario') }}
            {{ Form::select('clasificadorp_id', $clasificadorpresupuestarios, $productoscp->clasificadorp_id, ['class' => 'form-control' . ($errors->has('clasificadorp_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el clasificador Presupuestario']) }}
            {!! $errors->first('clasificadorp_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        </div>
        

    </div>

    <br>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>