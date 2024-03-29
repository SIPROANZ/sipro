@extends('layouts.app')

@section('template_title')
    Notadebito
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Nota debito') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('notadebitos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nota debito') }}
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
										<th>Cuenta bancaria</th>
										<th>Beneficiario</th>
										<th>Institucion</th>
										<th>Monto</th>
										<th>Fecha</th>
										<th>Referencia</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notadebitos as $notadebito)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $notadebito->ejercicio->nombreejercicio}}</td>
											<td>{{ $notadebito->cuentasbancaria->cuenta}}</td>
											<td>{{ $notadebito->beneficiario->nombre }}</td>
											<td>{{ $notadebito->institucione->institucion }}</td>
											<td>{{ $notadebito->montond }}</td>
											<td>{{ $notadebito->fecha }}</td>
											<td>{{ $notadebito->referenciand }}</td>
											<td>{{ $notadebito->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('notadebitos.destroy',$notadebito->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('notadebitos.show',$notadebito->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('notadebitos.edit',$notadebito->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $notadebitos->links() !!}
            </div>
        </div>
    </div>
@endsection
