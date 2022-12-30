@extends('layouts.app')

@section('template_title')
    {{ $precompromiso->name ?? 'Show Precompromiso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Precompromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precompromisos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $precompromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Montototal:</strong>
                            {{ $precompromiso->montototal }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $precompromiso->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $precompromiso->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $precompromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipocompromiso Id:</strong>
                            {{ $precompromiso->tipocompromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $precompromiso->beneficiario_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
