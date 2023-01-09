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
                            <span class="card-title">Compromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('compromisos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $compromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipocompromiso Id:</strong>
                            {{ $compromiso->tipocompromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ncompromiso:</strong>
                            {{ $compromiso->ncompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $compromiso->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montocompromiso:</strong>
                            {{ $compromiso->montocompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $compromiso->status }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $compromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $compromiso->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Precompromiso Id:</strong>
                            {{ $compromiso->precompromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Compra Id:</strong>
                            {{ $compromiso->compra_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ayuda Id:</strong>
                            {{ $compromiso->ayuda_id }}
                        </div>

                        <div class="form-group">
                            <strong>COMPROMISO ID:</strong>
                            {{ $compromiso->id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agregar las imputaciones relacionadas a este compromiso -->
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Imputacion Presupuestaria') }}
                            </span>

                             
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Monto Compromiso</th>
										<th># Compromiso</th>
										<th>Unidad Administrativa</th>
										<th>Ejecucion</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallescompromisos as $detallescompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallescompromiso->montocompromiso }}</td>
											<td>{{ $detallescompromiso->compromiso->ncompromiso }}</td>
											<td>{{ $detallescompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallescompromiso->ejecucione->clasificadorpresupuestario }}</td>

                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallescompromisos->links() !!}
            </div>
        </div>
    </div>
@endsection
