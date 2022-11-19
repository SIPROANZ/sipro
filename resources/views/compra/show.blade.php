@extends('layouts.app')

@section('template_title')
    {{ $compra->name ?? 'Show Compra' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Orden de Compra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('compras.index') }}"> Rregresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Analisis:</strong>
                            {{ $compra->analisis_id }}
                        </div>
                        <div class="form-group">
                            <strong>Numero de orden de compra:</strong>
                            {{ $compra->numordencompra }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $compra->status }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de anulacion:</strong>
                            {{ $compra->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Monto base:</strong>
                            {{ $compra->montobase }}
                        </div>
                        <div class="form-group">
                            <strong>Monto iva:</strong>
                            {{ $compra->montoiva }}
                        </div>
                        <div class="form-group">
                            <strong>Monto total:</strong>
                            {{ $compra->montototal }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
