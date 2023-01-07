@extends('layouts.app')

@section('template_title')
    Requisicione
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Requisiciones en Proceso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('requisiciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Requisicion') }}
                                </a>

                                <a href="{{ route('requisiciones.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('requisiciones.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>

                                <a href="{{ route('requisiciones.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th style="text-align: center">No</th>


										<th style="text-align: center">Ejercicio</th>
										<th style="text-align: center">Institucion</th>
										<th style="text-align: center">Unidad administrativa</th>
										<th style="text-align: center">Correlativo</th>
                                        <th style="text-align: center">Concepto</th>
										<th style="text-align: center">Uso</th>
										<th style="text-align: center">Tipo requisicion</th>
										<th style="text-align: center">Estatus</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisiciones as $requisicione)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										    <td style="text-align: center">{{ $requisicione->ejercicio->nombreejercicio}}</td>
											<td style="text-align: center">{{ $requisicione->institucione->institucion }}</td>
											<td style="text-align: center">{{ $requisicione->unidadadministrativa->denominacion }}</td>
											<td style="text-align: center">{{ $requisicione->correlativo }}</td>
                                            <td style="text-align: center">{{ $requisicione->concepto }}</td>
											<td style="text-align: center">{{ $requisicione->uso }}</td>
											<td style="text-align: center">{{ $requisicione->tipossgp->denominacion }}</td>
											<td style="text-align: center">{{ $requisicione->estatus }}</td>

                                            <td>
                                                <div class="row">

                                                <form action="{{ route('requisiciones.anular',$requisicione->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    <a class="btn btn-sm btn-primary " href="{{ route('requisiciones.agregar',$requisicione->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Producto BOS"><i class="fas fa-outdent"></i></i></a>

                                                    <a class="btn btn-sm btn-primary " href="{{ route('requisiciones.pdf',$requisicione->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Requisicion"><i class="fas fa-print"></i></a>

                                                    <a class="btn btn-sm btn-success" href="{{ route('requisiciones.edit',$requisicione->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Requisicion"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Requisicion"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>

                                                <form action="{{ route('requisiciones.aprobar',$requisicione->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                   @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Requisicion"><i class="fas fa-check-double"></i></button>
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
                {!! $requisiciones->links() !!}
            </div>
        </div>
    </div>
@endsection
