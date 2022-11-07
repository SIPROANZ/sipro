@extends('layouts.app')

@section('template_title')
    {{ $ejecucione->name ?? 'Show Ejecucione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Ejecución</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ejecuciones.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $ejecucione->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion Id:</strong>
                            {{ $ejecucione->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $ejecucione->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Meta Id:</strong>
                            {{ $ejecucione->meta_id }}
                        </div>
                        <div class="form-group">
                            <strong>Clasificadorpresupuestario:</strong>
                            {{ $ejecucione->clasificadorpresupuestario }}
                        </div>
                        <div class="form-group">
                            <strong>Financiamiento Id:</strong>
                            {{ $ejecucione->financiamiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Inicial:</strong>
                            {{ $ejecucione->monto_inicial }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Aumento:</strong>
                            {{ $ejecucione->monto_aumento }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Disminuye:</strong>
                            {{ $ejecucione->monto_disminuye }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Actualizado:</strong>
                            {{ $ejecucione->monto_actualizado }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Precomprometido:</strong>
                            {{ $ejecucione->monto_precomprometido }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Comprometido:</strong>
                            {{ $ejecucione->monto_comprometido }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Causado:</strong>
                            {{ $ejecucione->monto_causado }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Pagado:</strong>
                            {{ $ejecucione->monto_pagado }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Por Comprometer:</strong>
                            {{ $ejecucione->monto_por_comprometer }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Por Causar:</strong>
                            {{ $ejecucione->monto_por_causar }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Por Pagar:</strong>
                            {{ $ejecucione->monto_por_pagar }}
                        </div>
                        <div class="form-group">
                            <strong>Poa Id:</strong>
                            {{ $ejecucione->poa_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
