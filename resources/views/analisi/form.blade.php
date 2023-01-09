<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">
  <!-- Select Dinamicos -->
        <select name="" id="_unidadadministrativa">
              <option value="">Seleccione una opcion</option>
            @foreach ($unidades as $item)
            <option value="{{$item->id}}">{{$item->denominacion}}</option>
            @endforeach
        </select>

        <select name="" id="_requisicion"></select>







    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('unidad administrativa') }}
            {{ Form::select('unidadadministrativa_id', $unidadesadministrativas, $analisi->unidadadministrativa_id, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una unidad administrativa']) }}
            {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('requisicion') }}
            {{ Form::select('requisicion_id', $requisiciones, $analisi->requisicion_id, ['class' => 'form-control' . ($errors->has('requisicion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una Requisicion']) }}
            {!! $errors->first('requisicion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('criterio') }}
            {{ Form::select('criterio_id', $criterios, $analisi->criterio_id, ['class' => 'form-control' . ($errors->has('criterio_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un Criterio']) }}
            {!! $errors->first('criterio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>
        
        <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('numero cotizacion') }}
            {{ Form::text('numeracion', $analisi->numeracion, ['class' => 'form-control' . ($errors->has('numeracion') ? ' is-invalid' : ''), 'placeholder' => '0']) }}
            {!! $errors->first('numeracion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('observacion') }}
            {{ Form::text('observacion', $analisi->observacion, ['class' => 'form-control' . ($errors->has('observacion') ? ' is-invalid' : ''), 'placeholder' => 'Observacion']) }}
            {!! $errors->first('observacion', '<div class="invalid-feedback">:message</div>') !!}

            {{ Form::hidden('estatus', 'EP', ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>


<script>
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('_unidadadministrativa').addEventListener('change',(e)=>{
        fetch('requisicion',{
            method : 'POST',
            body: JSON.stringify({texto : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].concepto+'</option>';
            }
            document.getElementById("_requisicion").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })


</script>   







