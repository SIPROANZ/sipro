@extends('layouts.app')

@section('template_title')
    Poa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Poa') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('poas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Poa') }}
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
                                        
										<th>Ejercicio Id</th>
										<th>Institucion Id</th>
										<th>Historico Id</th>
										<th>Nacional Id</th>
										<th>Estrategico Id</th>
										<th>General Id</th>
										<th>Municipal Id</th>
										<th>Pei Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Proyecto</th>
										<th>Objetivoproyecto</th>
										<th>Montoproyecto</th>
										<th>Responsable</th>
										<th>Tipo</th>
										<th>Sncfestrategico</th>
										<th>Sncfespecifico</th>
										<th>Psocial</th>
										<th>Codigo</th>
										<th>Tipoproyecto</th>
										<th>Central</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($poas as $poa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $poa->ejercicio_id }}</td>
											<td>{{ $poa->institucion_id }}</td>
											<td>{{ $poa->historico_id }}</td>
											<td>{{ $poa->nacional_id }}</td>
											<td>{{ $poa->estrategico_id }}</td>
											<td>{{ $poa->general_id }}</td>
											<td>{{ $poa->municipal_id }}</td>
											<td>{{ $poa->pei_id }}</td>
											<td>{{ $poa->unidadadministrativa_id }}</td>
											<td>{{ $poa->proyecto }}</td>
											<td>{{ $poa->objetivoproyecto }}</td>
											<td>{{ $poa->montoproyecto }}</td>
											<td>{{ $poa->responsable }}</td>
											<td>{{ $poa->tipo }}</td>
											<td>{{ $poa->sncfestrategico }}</td>
											<td>{{ $poa->sncfespecifico }}</td>
											<td>{{ $poa->psocial }}</td>
											<td>{{ $poa->codigo }}</td>
											<td>{{ $poa->tipoproyecto }}</td>
											<td>{{ $poa->central }}</td>
											<td>{{ $poa->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('poas.destroy',$poa->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('poas.show',$poa->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('poas.edit',$poa->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $poas->links() !!}
            </div>
        </div>
    </div>
@endsection
