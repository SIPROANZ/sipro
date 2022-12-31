@extends('layouts.app')

@section('template_title')
    {{ $ordenpago->name ?? 'Show Ordenpago' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Orden de pago</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ordenpagos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>N orden de pago:</strong>
                            {{ $ordenpago->nordenpago }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ordenpago->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto base:</strong>
                            {{ $ordenpago->montobase }}
                        </div>
                        <div class="form-group">
                            <strong>Monto retencion:</strong>
                            {{ $ordenpago->montoretencion }}
                        </div>
                        <div class="form-group">
                            <strong>Monto neto:</strong>
                            {{ $ordenpago->montoneto }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha anulacion:</strong>
                            {{ $ordenpago->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $ordenpago->status }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo orden:</strong>
                            {{ $ordenpago->tipoorden }}
                        </div>
                        <div class="form-group">
                            <strong>Monto IVA:</strong>
                            {{ $ordenpago->montoiva }}
                        </div>
                        <div class="form-group">
                            <strong>Monto exento:</strong>
                            {{ $ordenpago->montoexento }}
                        </div>
                        <div class="form-group">
                            <strong>Compromiso:</strong>
                            {{ $ordenpago->compromiso_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
