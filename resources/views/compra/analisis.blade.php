@extends('layouts.app')

@section('template_title')
    Analisi
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Analisis de Cotizaciones') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Analisis Por Procesar') }}
                                </a>

                                <a href="{{ route('analisis.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Procesadas') }}
                                </a>

                                <a href="{{ route('analisis.anuladas')  }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Unidad administrativa</th>
										<th># Requisicion</th>
										<th>Criterio</th>
										<th>Numero Cotizacion</th>
										<th>Observacion</th>
                                        <th>Estatus</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($analisis as $analisi)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $analisi->unidadadministrativa->denominacion }}</td>
											<td>{{ $analisi->requisicion_id }}</td>
											<td>{{ $analisi->criterio->nombre }}</td>
											<td>{{ $analisi->numeracion }}</td>
											<td>{{ $analisi->observacion }}</td>
                                            <td>{{ $analisi->estatus }}</td>

                                            <td class="float-right">
                                            <a class="btn btn-sm btn-primary " href="{{ route('compras.agregarcompra',$analisi->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Compra"><i class="fas fa-outdent"></i></i></a>
                                                
                                            <a class="btn btn-sm btn-success" href="{{ route('compras.reversar',$analisi->id) }}" data-toggle="tooltip" data-placement="top" title="Reversar Analisis"><i class="fas fa-chevron-circle-left"></i></a>
                                                   
                                                <form action="{{ route('analisis.aprobar',$analisi->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Analisis"><i class="fas fa-check-double"></i></button>
                                                </form>
                                                <form action="{{ route('analisis.anular',$analisi->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                
                                                    <a class="btn btn-sm btn-success" href="{{ route('analisis.edit',$analisi->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Analisis"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Analisis"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $analisis->links() !!}
            </div>
        </div>
    </div>
@endsection