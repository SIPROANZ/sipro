<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">

    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Ejercicio') }}
            {{ Form::select('ejercicio_id', $ejercicios, $notadebito->ejercicio_id, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciones el ejercicio']) }}
            {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Cuenta Bancaria') }}
            {{ Form::select('cuentasbancaria_id', $cuentasbancarias, $notadebito->cuentasbancaria_id, ['class' => 'form-control' . ($errors->has('cuentasbancaria_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la cuenta bancaria']) }}
            {!! $errors->first('cuentasbancaria_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Beneficiario') }}
            {{ Form::select('beneficiario_id', $beneficiarios, $notadebito->beneficiario_id, ['class' => 'form-control' . ($errors->has('beneficiario_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el beneficiario']) }}
            {!! $errors->first('beneficiario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Institucion') }}
            {{ Form::select('institucione_id', $instituciones, $notadebito->institucione_id, ['class' => 'form-control' . ($errors->has('institucione_id') ? ' is-invalid' : ''), 'placeholder' => 'Institucione Id']) }}
            {!! $errors->first('institucione_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Monto') }}
            {{ Form::number('montond', $notadebito->montond, ['class' => 'form-control' . ($errors->has('montond') ? ' is-invalid' : ''), 'placeholder' => 'Montond']) }}
            {!! $errors->first('montond', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('fecha', $notadebito->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Referencia') }}
            {{ Form::text('referenciand', $notadebito->referenciand, ['class' => 'form-control' . ($errors->has('referenciand') ? ' is-invalid' : ''), 'placeholder' => 'Referenciand']) }}
            {!! $errors->first('referenciand', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Descripcion') }}
            {{ Form::text('descripcion', $notadebito->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
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