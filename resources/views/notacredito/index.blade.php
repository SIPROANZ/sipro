@extends('layouts.app')

@section('template_title')
    Nota credito
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Nota credito') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('notacreditos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nota Credito') }}
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
                                        
										<th>Ejercicio</th>
										<th>Cuentas bancaria</th>
										<th>Beneficiario</th>
										<th>Institucion</th>
										<th>Monto</th>
										<th>Fecha</th>
										<th>Referencia</th>
										<th>Descripcion</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notacreditos as $notacredito)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $notacredito->ejercicio->nombreejercicio}}</td>
											<td>{{ $notacredito->cuentasbancaria->cuenta}}</td>
											<td>{{ $notacredito->beneficiario->nombre }}</td>
											<td>{{ $notacredito->institucione->institucion }}</td>
											<td>{{ $notacredito->montonc }}</td>
											<td>{{ $notacredito->fecha }}</td>
											<td>{{ $notacredito->referencianc }}</td>
											<td>{{ $notacredito->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('notacreditos.destroy',$notacredito->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('notacreditos.show',$notacredito->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('notacreditos.edit',$notacredito->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $notacreditos->links() !!}
            </div>
        </div>
    </div>
@endsection
