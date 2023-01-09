<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::text('documento', $precompromiso->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('montototal') }}
            {{ Form::text('montototal', $precompromiso->montototal, ['class' => 'form-control' . ($errors->has('montototal') ? ' is-invalid' : ''), 'placeholder' => 'Montototal']) }}
            {!! $errors->first('montototal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('concepto') }}
            {{ Form::text('concepto', $precompromiso->concepto, ['class' => 'form-control' . ($errors->has('concepto') ? ' is-invalid' : ''), 'placeholder' => 'Concepto']) }}
            {!! $errors->first('concepto', '<div class="invalid-feedback">:message</div>') !!}
            {{ Form::hidden('status', 'EP', ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            
        </div>
        <div class="form-group">
            {{ Form::label('fechaanulacion') }}
            {{ Form::hidden('fechaanulacion', $precompromiso->fechaanulacion, ['class' => 'form-control' . ($errors->has('fechaanulacion') ? ' is-invalid' : ''), 'placeholder' => 'Fechaanulacion']) }}
            {!! $errors->first('fechaanulacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unidadadministrativa_id') }}
            {{ Form::select('unidadadministrativa_id', $unidades, $precompromiso->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Unidadadministrativa Id']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipocompromiso_id') }}
            {{ Form::select('tipocompromiso_id', $tipocompromisos, $precompromiso->tipocompromiso_id, ['class' => 'form-control' . ($errors->has('tipocompromiso_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipocompromiso Id']) }}
            {!! $errors->first('tipocompromiso_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiario_id') }}
            {{ Form::select('beneficiario_id',$beneficiarios, $precompromiso->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiario Id']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>