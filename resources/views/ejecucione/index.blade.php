@extends('layouts.app')

@section('template_title')
    Ejecucione
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ejecución') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ejecuciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
                            <table class="table table-hover table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Nro</th>
										<th class="text-center">Ejercicio Id</th>
										<th class="text-center">UnidadadministrativaId</th>
										<th class="text-center">MetaId</th>
										<th class="text-center">Clasificadorpresupuestario</th>
										<th class="text-center">FinanciamientoId</th>
										<th class="text-center">MontoInicial</th>
										<th class="text-center">MontoAumento</th>
										<th class="text-center">MontoDisminuye</th>
										<th class="text-center">MontoActualizado</th>
										<th class="text-center">MontoPrecomprometido</th>
										<th class="text-center">MontoComprometido</th>
										<th class="text-center">MontoCausado</th>
										<th class="text-center">MontoPagado</th>
										<th class="text-center">MontoPorComprometer</th>
										<th class="text-center">MontoPorCausar</th>
										<th class="text-center">MontoPorPagar</th>
										<th class="text-center">PoaId</th>

                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ejecuciones as $ejecucione)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $ejecucione->ejercicio->nombreejercicio }}</td>
											<td class="text-center">{{ $ejecucione->unidadadministrativa->sector }}</td>
											<td class="text-center">{{ $ejecucione->meta->meta }}</td>
											<td class="text-center">{{ $ejecucione->clasificadorpresupuestario }}</td>
											<td class="text-center">{{ $ejecucione->financiamiento->financiamiento }}</td>
											<td class="text-center">{{ $ejecucione->monto_inicial }}</td>
											<td class="text-center">{{ $ejecucione->monto_aumento }}</td>
											<td class="text-center">{{ $ejecucione->monto_disminuye }}</td>
											<td class="text-center">{{ $ejecucione->monto_actualizado }}</td>
											<td class="text-center">{{ $ejecucione->monto_precomprometido }}</td>
											<td class="text-center">{{ $ejecucione->monto_comprometido }}</td>
											<td class="text-center">{{ $ejecucione->monto_causado }}</td>
											<td class="text-center">{{ $ejecucione->monto_pagado }}</td>
											<td class="text-center">{{ $ejecucione->monto_por_comprometer }}</td>
											<td class="text-center">{{ $ejecucione->monto_por_causar }}</td>
											<td class="text-center">{{ $ejecucione->monto_por_pagar }}</td>
											<td class="text-center">{{ $ejecucione->poa->proyecto}}</td>

                                            <td class="text-center">
                                                <form action="{{ route('ejecuciones.destroy',$ejecucione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ejecuciones.show',$ejecucione->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ejecuciones.edit',$ejecucione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ejecuciones->links() !!}
            </div>
        </div>
    </div>
@endsection
