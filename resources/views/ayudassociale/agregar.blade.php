@extends('layouts.app')

@section('template_title')
    {{ $ayudassociale->name ?? 'Show Ayudassociale' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Ayuda social</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ayudassociales.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ayudassociale->beneficiario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $ayudassociale->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Monto total de la ayuda:</strong>
                            {{ $ayudassociale->montototal }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $ayudassociale->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $ayudassociale->unidadadministrativa->denominacion }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de compromiso:</strong>
                            {{ $ayudassociale->tipodecompromiso->nombre }}
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
                                {{ __('Detallesayuda') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesayudas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Montocompromiso</th>
										<th># Ayuda</th>
										<th>Unidadadministrativa</th>
										<th>Ejecucion</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesayudas as $detallesayuda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesayuda->montocompromiso }}</td>
											<td>{{ $detallesayuda->ayuda_id }}</td>
											<td>{{ $detallesayuda->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallesayuda->ejecucione->clasificadorpresupuestario }}</td>

                                            <td>
                                                <form action="{{ route('detallesayudas.destroy',$detallesayuda->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesayudas.edit',$detallesayuda->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $detallesayudas->links() !!}
            </div>
        </div>
    </div>
@endsection
