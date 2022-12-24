@extends('layouts.app')

@section('template_title')
    Compra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compras Procesadas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('compras.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Orden de Compra') }}
                                </a>

                                <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras en Proceso') }}
                                </a>

                                <a href="{{ route('compras.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Procesadas') }}
                                </a>

                                <a href="{{ url('#')  }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Anuladas') }}
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
                                        
										<th>Analisis</th>
										<th>Numero de orden compra</th>
										<th>Estado</th>
										<th>Anulacion</th>
										<th>Monto Base</th>
										<th>Monto IVA</th>
										<th>Monto Total</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $compra->analisis_id }}</td>
											<td>{{ $compra->numordencompra }}</td>
											<td>{{ $compra->status }}</td>
											<td>{{ $compra->fechaanulacion }}</td>
											<td>{{ $compra->montobase }}</td>
											<td>{{ $compra->montoiva }}</td>
											<td>{{ $compra->montototal }}</td>

                                            <td>
                                            <form action="{{ route('compras.aprobar',$compra->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Compra"><i class="fas fa-check-double"></i></button>
                                                </form>

                                                <form action="{{ route('compras.anular',$compra->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('compras.edit',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Compra"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Compra"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>

                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compras->links() !!}
            </div>
        </div>
    </div>
@endsection