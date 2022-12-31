@extends('layouts.app')

@section('template_title')
    Movimientosbancario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Movimientosbancario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('movimientosbancarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
										<th>Cuentasbancaria Id</th>
										<th>Beneficiario Id</th>
										<th>Tipomovimiento Id</th>
										<th>Referencia</th>
										<th>Descripcion</th>
										<th>Fecha</th>
										<th>Monto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimientosbancarios as $movimientosbancario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $movimientosbancario->ejercicio_id }}</td>
											<td>{{ $movimientosbancario->institucion_id }}</td>
											<td>{{ $movimientosbancario->cuentasbancaria_id }}</td>
											<td>{{ $movimientosbancario->beneficiario_id }}</td>
											<td>{{ $movimientosbancario->tipomovimiento_id }}</td>
											<td>{{ $movimientosbancario->referencia }}</td>
											<td>{{ $movimientosbancario->descripcion }}</td>
											<td>{{ $movimientosbancario->fecha }}</td>
											<td>{{ $movimientosbancario->monto }}</td>

                                            <td>
                                                <form action="{{ route('movimientosbancarios.destroy',$movimientosbancario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('movimientosbancarios.show',$movimientosbancario->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('movimientosbancarios.edit',$movimientosbancario->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $movimientosbancarios->links() !!}
            </div>
        </div>
    </div>
@endsection
