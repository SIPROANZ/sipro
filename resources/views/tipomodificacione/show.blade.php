@extends('layouts.app')

@section('template_title')
    {{ $tipomodificacione->name ?? 'Show Tipomodificacione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Tipomodificacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tipomodificaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $tipomodificacione->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
