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
                                {{ __('Requisicione') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('requisiciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Requisicion') }}
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
                                        
										<th>Concepto</th>
										<th>Uso</th>
										<th>Ejercicio Id</th>
										<th>Institucion Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Correlativo</th>
										<th>Tiposgp Id</th>
										<th>Estatus</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisiciones as $requisicione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $requisicione->concepto }}</td>
											<td>{{ $requisicione->uso }}</td>
											<td>{{ $requisicione->ejercicio_id }}</td>
											<td>{{ $requisicione->institucion_id }}</td>
											<td>{{ $requisicione->unidadadministrativa_id }}</td>
											<td>{{ $requisicione->correlativo }}</td>
											<td>{{ $requisicione->tiposgp_id }}</td>
											<td>{{ $requisicione->estatus }}</td>

                                            <td>
                                                <form action="{{ route('requisiciones.destroy',$requisicione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('requisiciones.show',$requisicione->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('requisiciones.edit',$requisicione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $requisiciones->links() !!}
            </div>
        </div>
    </div>
@endsection
