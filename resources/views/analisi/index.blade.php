@extends('layouts.app')

@section('template_title')
    Analisi
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Analisis') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('analisis.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Analisis de Cotizacion') }}
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
                                        
										<th>Unidad administrativa</th>
										<th>Requisicion</th>
										<th>Criterio</th>
										<th>Numero Cotizacion</th>
										<th>Observacion</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($analisis as $analisi)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $analisi->unidadadministrativa->denominacion }}</td>
											<td>{{ $analisi->requisicion_id }}</td>
											<td>{{ $analisi->criterio->nombre }}</td>
											<td>{{ $analisi->numeracion }}</td>
											<td>{{ $analisi->observacion }}</td>

                                            <td>
                                                <form action="{{ route('analisis.destroy',$analisi->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('analisis.show',$analisi->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('analisis.edit',$analisi->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $analisis->links() !!}
            </div>
        </div>
    </div>
@endsection
