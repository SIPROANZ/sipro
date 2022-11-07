@extends('layouts.app')

@section('template_title')
    {{ $requisicione->name ?? 'Show Requisicione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Requisicione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('requisiciones.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $requisicione->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Uso:</strong>
                            {{ $requisicione->uso }}
                        </div>
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $requisicione->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion Id:</strong>
                            {{ $requisicione->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $requisicione->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Correlativo:</strong>
                            {{ $requisicione->correlativo }}
                        </div>
                        <div class="form-group">
                            <strong>Tiposgp Id:</strong>
                            {{ $requisicione->tiposgp_id }}
                        </div>
                        <div class="form-group">
                            <strong>Estatus:</strong>
                            {{ $requisicione->estatus }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
