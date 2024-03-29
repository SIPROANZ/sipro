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
                            <span class="card-title">Mostrar Pagado</span>
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
                            <strong>estatus:</strong>
                            {{ $pagado->estatus }}
                        </div>
                        <div class="form-group">
                            <strong>Tipoordenpago:</strong>
                            {{ $pagado->tipoordenpago }}
                        </div>

                        <div class="form-group">
                            <strong>Tipo de pago:</strong>
                            {{ $pagado->tipomovimiento->descripcion}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
