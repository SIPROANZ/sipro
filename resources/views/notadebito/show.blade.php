@extends('layouts.app')

@section('template_title')
    {{ $notadebito->name ?? 'Show Notadebito' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Notadebito</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('notadebitos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $notadebito->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cuentasbancaria Id:</strong>
                            {{ $notadebito->cuentasbancaria_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $notadebito->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucione Id:</strong>
                            {{ $notadebito->institucione_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montond:</strong>
                            {{ $notadebito->montond }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $notadebito->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Referenciand:</strong>
                            {{ $notadebito->referenciand }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $notadebito->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
