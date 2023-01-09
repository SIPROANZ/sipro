@extends('layouts.app')

@section('template_title')
    {{ $modificacione->name ?? 'Show Modificacione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Modificacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('modificaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numero:</strong>
                            {{ $modificacione->numero }}
                        </div>
                        <div class="form-group">
                            <strong>Tipomodificacion Id:</strong>
                            {{ $modificacione->tipomodificacion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $modificacione->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $modificacione->status }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $modificacione->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Montocredita:</strong>
                            {{ $modificacione->montocredita }}
                        </div>
                        <div class="form-group">
                            <strong>Montodebita:</strong>
                            {{ $modificacione->montodebita }}
                        </div>
                        <div class="form-group">
                            <strong>Ncredito:</strong>
                            {{ $modificacione->ncredito }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detallesmodificacione') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesmodificaciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Modificacion Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Montoacredita</th>
										<th>Montodebita</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesmodificacione->modificacion_id }}</td>
											<td>{{ $detallesmodificacione->unidadadministrativa_id }}</td>
											<td>{{ $detallesmodificacione->ejecucion_id }}</td>
											<td>{{ $detallesmodificacione->montoacredita }}</td>
											<td>{{ $detallesmodificacione->montodebita }}</td>

                                            <td>
                                                <form action="{{ route('detallesmodificaciones.destroy',$detallesmodificacione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesmodificaciones.edit',$detallesmodificacione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $detallesmodificaciones->links() !!}
            </div>
        </div>
    </div>

@endsection
