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
                               

                                <a href="{{ route('compras.analisis') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Orden de Compra') }}
                                </a>

                                <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras en Proceso') }}
                                </a>

                                <a href="{{ route('compras.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Procesadas') }}
                                </a>

                                <a href="{{ route('compras.anuladas')  }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Observacion</th>
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
                                            <td>{{ $compra->analisi->observacion }}</td>
											<td>{{ $compra->numordencompra }}</td>
											<td>{{ $compra->status }}</td>
											<td>{{ $compra->fechaanulacion }}</td>
											<td>{{ $compra->montobase }}</td>
											<td>{{ $compra->montoiva }}</td>
											<td>{{ $compra->montototal }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-primary " href="{{ route('compras.pdf',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compra"><i class="fa fa-fw fa-print"></i></a>
                                            
                                            

                                                
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