@extends('layouts.app')

@section('template_title')
    Pagado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pagado') }}
                            </span>

                             <div class="float-right">

                             <a href="{{ route('pagados.agregar') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Pagado') }}
                                </a>

                                <a href="{{ route('pagados.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En proceso') }}
                                </a>

                                <a href="{{ route('pagados.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Pagadas') }}
                                </a>

                                <a href="{{ route('pagados.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Anuladas') }}
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
                                        
										<th>Orden de pago</th>
										<th>Beneficiario</th>
										<th>Monto pagado</th>
                                        <th>Correlativo</th>
										<th>Fechaanulacion</th>									
										<th>Tipo de orden</th>
                                        <th>Tipo de Pago</th>
                                        <th>Estatus</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagados as $pagado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $pagado->ordenpago_id }}</td>
											<td>{{ $pagado->beneficiario_id }}</td>
											<td>{{ $pagado->montopagado }}</td>
                                            <td>{{ $pagado->correlativo }}</td>
											<td>{{ $pagado->fechaanulacion }}</td>											
											<td>{{ $pagado->tipoordenpago }}</td>
                                            <td>{{ $pagado->tipodepago }}</td>
                                            <td>{{ $pagado->status }}</td>

                                            <td>
                                                <div class="row">

                                                 <form action="{{ route('pagados.anular',$pagado->id) }}" method="POST">
                                                    <!-- Agregar detalles de los pagados -->
                                                    <a class="btn btn-sm btn-primary" href="{{ route('pagados.agregar',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Pagado"><i class="fas fa-outdent"></i></i></a>
                                                    
                                                   
                                                    <a class="btn btn-sm btn-primary" href="{{ route('pagados.pdf',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Pagado"><i class="fas fa-print"></i></a>
                                                   
                                                    <a class="btn btn-sm btn-success" href="{{ route('pagados.edit',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Pagado"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Pagado"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>

                                                <form action="{{ route('pagados.aprobar',$pagado->id) }}" method="POST">
                                                    <!-- Agregar orden de pago a Pagado -->
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Pagado"><i class="fas fa-check-double"></i></button>
                                                </form>

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $pagados->links() !!}
            </div>
        </div>
    </div>
@endsection
