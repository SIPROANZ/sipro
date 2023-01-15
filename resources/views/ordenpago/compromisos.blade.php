@extends('layouts.app')

@section('template_title')
    Compromiso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compromisos') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('ordenpagos.compromisos') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Orden de Pago') }}
                                </a>
                                <a href="{{ route('ordenpagos.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('ordenpagos.procesados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Procesados') }}
                                <a href="{{ route('ordenpagos.aprobados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Aprobados') }}
                                </a>
                                </a>
                                <a href="{{ route('ordenpagos.anulados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Anulados') }}
                                </a>
                              </div>
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
										<th>N° Compromiso</th>
										<th>Tipo Compromiso</th>
										<th>Unidad Administrativa</th>
										<th>Beneficiario</th>
										<th>Monto compromiso</th>
										<th>Documento</th>{{--
										<th>Precompromiso</th>
										<th>Compra</th>
										<th>Ayuda</th> --}}

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromisos as $compromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $compromiso->ncompromiso }}</td>
											<td>{{ $compromiso->tipodecompromiso->nombre }}</td>
											<td>{{ $compromiso->unidadadministrativa->denominacion }}</td>
											<td>{{ $compromiso->beneficiario->nombre }}</td>
											<td>{{ $compromiso->montocompromiso }}</td>
											<td>{{ $compromiso->documento }}</td>{{--
											<td>{{ $compromiso->precompromiso_id }}</td>
											<td>{{ $compromiso->compra_id }}</td>
											<td>{{ $compromiso->ayuda_id }}</td> --}}

                                            <td>
                                                <a class="btn btn-sm btn-primary " href="{{ route('ordenpagos.agregarordenpago',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Orden de Pago"><i class="fas fa-outdent"></i></i></a>

                                                <a class="btn btn-sm btn-success" href="{{ route('ordenpagos.reversar',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Reversar Compromiso"><i class="fas fa-chevron-circle-left"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compromisos->links() !!}
            </div>
        </div>
    </div>
@endsection
