@extends('layouts.app')

@section('template_title')
    {{ $movimientosbancario->name ?? 'Show Movimientosbancario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Movimientosbancario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('movimientosbancarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $movimientosbancario->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion Id:</strong>
                            {{ $movimientosbancario->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cuentasbancaria Id:</strong>
                            {{ $movimientosbancario->cuentasbancaria_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $movimientosbancario->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipomovimiento Id:</strong>
                            {{ $movimientosbancario->tipomovimiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $movimientosbancario->referencia }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $movimientosbancario->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $movimientosbancario->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $movimientosbancario->monto }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
