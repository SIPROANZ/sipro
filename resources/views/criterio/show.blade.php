@extends('layouts.app')

@section('template_title')
    {{ $criterio->name ?? 'Show Criterio' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Criterio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('criterios.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Criterio de Cotizacion:</strong>
                            {{ $criterio->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
