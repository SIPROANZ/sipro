@extends('layouts.app')

@section('template_title')
    Ordenpago
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Orden de pago') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ordenpagos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nueva orden de pago ') }}
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
                                        
										<th style="text-align: left"> N Orden de pago</th>
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
                                            <form action="{{ route('ordenpagos.aprobar',$ordenpago->id) }}" method="POST">
                                                    <!-- Agregar detalles orden de pago -->
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar orden de pago"><i class="fas fa-check-double"></i></button>
                                                </form>

                                                <form action="{{ route('ordenpagos.anular',$ordenpago->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('ordenpagos.edit',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Compra"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Orden de pago"><i class="fa fa-fw fa-trash"></i></button>
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
