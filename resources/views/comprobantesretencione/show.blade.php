@extends('layouts.app')

@section('template_title')
    {{ $comprobantesretencione->name ?? 'Show Comprobantesretencione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Comprobantesretencione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('comprobantesretenciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tiporetencion Id:</strong>
                            {{ $comprobantesretencione->tiporetencion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ordenpago Id:</strong>
                            {{ $comprobantesretencione->ordenpago_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montoretencion:</strong>
                            {{ $comprobantesretencione->montoretencion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
