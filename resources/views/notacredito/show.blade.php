@extends('layouts.app')

@section('template_title')
    {{ $notacredito->name ?? 'Show Notacredito' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Nota credito</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('notacreditos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $notacredito->ejercicio->nombreejercicio }}
                        </div>
                        <div class="form-group">
                            <strong>Cuentasbancaria Id:</strong>
                            {{ $notacredito->cuentasbancaria->cuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $notacredito->beneficiario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Institucione Id:</strong>
                            {{ $notacredito->institucione->institucion  }}
                        </div>
                        <div class="form-group">
                            <strong>Montonc:</strong>
                            {{ $notacredito->montonc }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $notacredito->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Referencianc:</strong>
                            {{ $notacredito->referencianc }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $notacredito->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
