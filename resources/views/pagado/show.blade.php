@extends('layouts.app')

@section('template_title')
    {{ $pagado->name ?? 'Show Pagado' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Pagado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagados.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ordenpago Id:</strong>
                            {{ $pagado->ordenpago_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $pagado->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montopagado:</strong>
                            {{ $pagado->montopagado }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $pagado->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $pagado->status }}
                        </div>
                        <div class="form-group">
                            <strong>Tipoordenpago:</strong>
                            {{ $pagado->tipoordenpago }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
