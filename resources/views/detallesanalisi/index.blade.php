@extends('layouts.app')

@section('template_title')
    Detallesanalisi
@endsection

@section('content')
    <div class="container-fluid">
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
                                  {{ __('Crear Nuevo Detalle Analisis') }}
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

                                            <td>
                                                <form action="{{ route('detallesanalisis.destroy',$detallesanalisi->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detallesanalisis.show',$detallesanalisi->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
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
