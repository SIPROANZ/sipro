@extends('layouts.app')

@section('template_title')
    {{ $compromiso->name ?? 'Show Compromiso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Compromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('compromisos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Analisi Id:</strong>
                            {{ $compromiso->analisi_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $compromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $compromiso->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $compromiso->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Estatus:</strong>
                            {{ $compromiso->estatus }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
