@extends('layouts.app')

@section('template_title')
    Ordenes de Pago Anuladas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Orden de pago Anulada') }}
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

										<th style="text-align: left">N° Orden de pago</th>
										<th style="text-align: left">Beneficiario</th>
										<th style="text-align: left">Monto base</th>
										<th style="text-align: left">Monto retencion</th>
										<th style="text-align: left">Monto neto</th>
										<th style="text-align: left">Fecha anulacion</th>
										<th style="text-align: left">Estado</th>
										<th style="text-align: left">Tipo orden</th>
										<th style="text-align: left">Monto IVA</th>
										<th style="text-align: left">Monto exento</th>
										<th style="text-align: left">Compromiso </th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenpagos as $ordenpago)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td style="text-align: left">{{ $ordenpago->nordenpago }}</td>
											<td style="text-align: left">{{ $ordenpago->beneficiario_id }}</td>
											<td style="text-align: left">{{ $ordenpago->montobase }}</td>
											<td style="text-align: left">{{ $ordenpago->montoretencion }}</td>
											<td style="text-align: left">{{ $ordenpago->montoneto }}</td>
											<td style="text-align: left">{{ $ordenpago->fechaanulacion }}</td>
											<td style="text-align: left">{{ $ordenpago->status }}</td>
											<td style="text-align: left">{{ $ordenpago->tipoorden }}</td>
											<td style="text-align: left">{{ $ordenpago->montoiva }}</td>
											<td style="text-align: left">{{ $ordenpago->montoexento }}</td>
											<td style="text-align: left">{{ $ordenpago->compromiso_id }}</td>

                                            <td>
                                                <form action="{{ route('ordenpagos.aprobar',$compromiso->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ordenpagos.pdf',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Orden de Pago"><i class="fas fa-print"></i></a>


                                                    <a class="btn btn-sm btn-primary " href="{{ route('ordenpagos.show',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Orden de Pago"><i class="fa fa-fw fa-eye"></i></a>

                                                   @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Orden de Pago"><i class="fas fa-check-double"></i></button>
                                                </form>
                                                <form action="{{ route('ordenpagos.destroy',$compromiso->id) }}" method="POST">
                                                      <a class="btn btn-sm btn-success" href="{{ route('ordenpagos.edit',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Orden de Pago"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Orden de Pago"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ordenpagos->links() !!}
            </div>
        </div>
    </div>
@endsection
