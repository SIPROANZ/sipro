@extends('layouts.app')

@section('template_title')
    Meta
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Meta') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('metas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Meta') }}
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
                                        
										<th>Poa Id</th>
										<th>Cantidad1</th>
										<th>Cantidad2</th>
										<th>Cantidad3</th>
										<th>Cantidad4</th>
										<th>Meta</th>
										<th>Monto</th>
										<th>Ejercicio Id</th>
										<th>Institucion Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Tipo</th>
										<th>Enero</th>
										<th>Febrero</th>
										<th>Marzo</th>
										<th>Abril</th>
										<th>Mayo</th>
										<th>Junio</th>
										<th>Julio</th>
										<th>Agosto</th>
										<th>Septiembre</th>
										<th>Octubre</th>
										<th>Noviembre</th>
										<th>Diciembre</th>
										<th>Unidadmedida</th>
										<th>Unidadadministrativasolicitante</th>
										<th>Impacto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($metas as $meta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $meta->poa_id }}</td>
											<td>{{ $meta->cantidad1 }}</td>
											<td>{{ $meta->cantidad2 }}</td>
											<td>{{ $meta->cantidad3 }}</td>
											<td>{{ $meta->cantidad4 }}</td>
											<td>{{ $meta->meta }}</td>
											<td>{{ $meta->monto }}</td>
											<td>{{ $meta->ejercicio_id }}</td>
											<td>{{ $meta->institucion_id }}</td>
											<td>{{ $meta->unidadadministrativa_id }}</td>
											<td>{{ $meta->tipo }}</td>
											<td>{{ $meta->enero }}</td>
											<td>{{ $meta->febrero }}</td>
											<td>{{ $meta->marzo }}</td>
											<td>{{ $meta->abril }}</td>
											<td>{{ $meta->mayo }}</td>
											<td>{{ $meta->junio }}</td>
											<td>{{ $meta->julio }}</td>
											<td>{{ $meta->agosto }}</td>
											<td>{{ $meta->septiembre }}</td>
											<td>{{ $meta->octubre }}</td>
											<td>{{ $meta->noviembre }}</td>
											<td>{{ $meta->diciembre }}</td>
											<td>{{ $meta->unidadmedida }}</td>
											<td>{{ $meta->unidadadministrativasolicitante }}</td>
											<td>{{ $meta->impacto }}</td>

                                            <td>
                                                <form action="{{ route('metas.destroy',$meta->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('metas.show',$meta->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('metas.edit',$meta->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $metas->links() !!}
            </div>
        </div>
    </div>
@endsection
