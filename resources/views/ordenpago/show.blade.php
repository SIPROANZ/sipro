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
                            <span class="card-title">Show Ordenpago</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ordenpagos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nordenpago:</strong>
                            {{ $ordenpago->nordenpago }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $ordenpago->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montobase:</strong>
                            {{ $ordenpago->montobase }}
                        </div>
                        <div class="form-group">
                            <strong>Montoretencion:</strong>
                            {{ $ordenpago->montoretencion }}
                        </div>
                        <div class="form-group">
                            <strong>Montoneto:</strong>
                            {{ $ordenpago->montoneto }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $ordenpago->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $ordenpago->status }}
                        </div>
                        <div class="form-group">
                            <strong>Tipoorden:</strong>
                            {{ $ordenpago->tipoorden }}
                        </div>
                        <div class="form-group">
                            <strong>Montoiva:</strong>
                            {{ $ordenpago->montoiva }}
                        </div>
                        <div class="form-group">
                            <strong>Montoexento:</strong>
                            {{ $ordenpago->montoexento }}
                        </div>
                        <div class="form-group">
                            <strong>Compromiso Id:</strong>
                            {{ $ordenpago->compromiso_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
