@extends('layouts.app')

@section('template_title')
    {{ $tipodecompromiso->name ?? 'Show Tipodecompromiso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Tipo de compromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tipodecompromisos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre del compromiso:</strong>
                            {{ $tipodecompromiso->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
