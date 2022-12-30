@extends('layouts.app')

@section('template_title')
    {{ $cuentasbancaria->name ?? 'Show Cuentasbancaria' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cuentasbancaria</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cuentasbancarias.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Banco Id:</strong>
                            {{ $cuentasbancaria->banco_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion Id:</strong>
                            {{ $cuentasbancaria->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaapertura:</strong>
                            {{ $cuentasbancaria->fechaapertura }}
                        </div>
                        <div class="form-group">
                            <strong>Montoapertura:</strong>
                            {{ $cuentasbancaria->montoapertura }}
                        </div>
                        <div class="form-group">
                            <strong>Montosaldo:</strong>
                            {{ $cuentasbancaria->montosaldo }}
                        </div>
                        <div class="form-group">
                            <strong>Cuenta:</strong>
                            {{ $cuentasbancaria->cuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $cuentasbancaria->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
