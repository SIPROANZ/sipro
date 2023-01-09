@extends('layouts.app')

@section('template_title')
    {{ $ajustescompromiso->name ?? 'Show Ajustescompromiso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Ajustescompromiso vere</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ajustescompromisos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $ajustescompromiso->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Compromiso Id:</strong>
                            {{ $ajustescompromiso->compromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $ajustescompromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $ajustescompromiso->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Montoajuste:</strong>
                            {{ $ajustescompromiso->montoajuste }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
