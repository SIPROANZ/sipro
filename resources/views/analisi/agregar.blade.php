@extends('layouts.app')

@section('template_title')
    {{ $analisi->name ?? 'Show Analisi' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Analisis</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('analisis.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $analisi->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Requisicion:</strong>
                            {{ $analisi->requisicion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Criterio:</strong>
                            {{ $analisi->criterio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Numer0:</strong>
                            {{ $analisi->numeracion }}
                        </div>
                        <div class="form-group">
                            <strong>Observacion:</strong>
                            {{ $analisi->observacion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Detalles de la requisicion -->
<!-- Agregamos la tabla detalles de la requisicion es decir las compras -->
<div class="container-fluid">
    <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles de la requisicion') }}
                            </span>

                             
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
                                        
										<th>Bos</th>
										<th>Cantidad</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesrequisiciones as $detallesrequisicione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesrequisicione->bo->descripcion }}</td>
											<td>{{ $detallesrequisicione->cantidad }}</td>

                                            <td>
                                                <form action="{{ route('detallesrequisiciones.destroy',$detallesrequisicione->id) }}" method="POST">
                                                    
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesrequisiciones.edit',$detallesrequisicione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $detallesrequisiciones->links() !!}
            </div>
        </div>
    </div>


<!-- Detalles Analisis -->
<div class="container-fluid">
<br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles analisis') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesanalisis.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar Detalles al Analisis') }}
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
                                        
										<th>Proveedor</th>
										<th>Analisis</th>
										<th>Bos</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Subtotal</th>
										<th>Iva</th>
										<th>Total</th>
                                        <th>Aprobado</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesanalisis as $detallesanalisi)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesanalisi->proveedore->nombre }}</td>
											<td>{{ $detallesanalisi->analisi->numeracion }}</td>
											<td>{{ $detallesanalisi->bo->descripcion }}</td>
											<td>{{ $detallesanalisi->cantidad }}</td>
											<td>{{ $detallesanalisi->precio }}</td>
											<td>{{ $detallesanalisi->subtotal }}</td>
											<td>{{ $detallesanalisi->iva }}</td>
											<td>{{ $detallesanalisi->total }}</td>
                                            <td>{{ $detallesanalisi->aprobado }}</td>

                                            <td>
                                                <form action="{{ route('detallesanalisis.destroy',$detallesanalisi->id) }}" method="POST">
                                                    
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesanalisis.edit',$detallesanalisi->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $detallesanalisis->links() !!}
            </div>
        </div>
    </div>

@endsection
