@extends('layouts.app')

@section('template_title')
    {{ $poa->name ?? 'Show Poa' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Poa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('poas.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $poa->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion Id:</strong>
                            {{ $poa->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Historico Id:</strong>
                            {{ $poa->historico_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nacional Id:</strong>
                            {{ $poa->nacional_id }}
                        </div>
                        <div class="form-group">
                            <strong>Estrategico Id:</strong>
                            {{ $poa->estrategico_id }}
                        </div>
                        <div class="form-group">
                            <strong>General Id:</strong>
                            {{ $poa->general_id }}
                        </div>
                        <div class="form-group">
                            <strong>Municipal Id:</strong>
                            {{ $poa->municipal_id }}
                        </div>
                        <div class="form-group">
                            <strong>Pei Id:</strong>
                            {{ $poa->pei_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $poa->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Proyecto:</strong>
                            {{ $poa->proyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivoproyecto:</strong>
                            {{ $poa->objetivoproyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Montoproyecto:</strong>
                            {{ $poa->montoproyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Responsable:</strong>
                            {{ $poa->responsable }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $poa->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Sncfestrategico:</strong>
                            {{ $poa->sncfestrategico }}
                        </div>
                        <div class="form-group">
                            <strong>Sncfespecifico:</strong>
                            {{ $poa->sncfespecifico }}
                        </div>
                        <div class="form-group">
                            <strong>Psocial:</strong>
                            {{ $poa->psocial }}
                        </div>
                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $poa->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Tipoproyecto:</strong>
                            {{ $poa->tipoproyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Central:</strong>
                            {{ $poa->central }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $poa->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
