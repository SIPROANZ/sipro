@extends('layouts.app')

@section('template_title')
    Modificacione
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Modificaciones Presupuestarias') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('modificaciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Modificacion') }}
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
                                        
										<th>Numero</th>
										<th>Tipomodificacion Id</th>
										<th>Descripcion</th>
										<th>Status</th>
										<th>Fechaanulacion</th>
										<th>Montocredita</th>
										<th>Montodebita</th>
										<th>Ncredito</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modificaciones as $modificacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $modificacione->numero }}</td>
											<td>{{ $modificacione->tipomodificacion_id }}</td>
											<td>{{ $modificacione->descripcion }}</td>
											<td>{{ $modificacione->status }}</td>
											<td>{{ $modificacione->fechaanulacion }}</td>
											<td>{{ $modificacione->montocredita }}</td>
											<td>{{ $modificacione->montodebita }}</td>
											<td>{{ $modificacione->ncredito }}</td>

                                            <td>
                                                <form action="{{ route('modificaciones.destroy',$modificacione->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('modificaciones.agregarmodificacion',$modificacione->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Detalle"><i class="fas fa-outdent"></i></i></a>
                                                    <a class="btn btn-sm btn-primary " href="{{ route('modificaciones.show',$modificacione->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Ajuste"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('modificaciones.edit',$modificacione->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Ajuste"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Ajuste"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $modificaciones->links() !!}
            </div>
        </div>
    </div>
@endsection
