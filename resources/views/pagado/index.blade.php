@extends('layouts.app')

@section('template_title')
    Pagado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pagado') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('pagados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Ordenpago Id</th>
										<th>Beneficiario Id</th>
										<th>Transferencia Id</th>
										<th>Montopagado</th>
										<th>Fechaanulacion</th>
										<th>Status</th>
										<th>Egreso</th>
										<th>Tipoordenpago</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagados as $pagado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $pagado->ordenpago_id }}</td>
											<td>{{ $pagado->beneficiario_id }}</td>
											<td>{{ $pagado->transferencia_id }}</td>
											<td>{{ $pagado->montopagado }}</td>
											<td>{{ $pagado->fechaanulacion }}</td>
											<td>{{ $pagado->status }}</td>
											<td>{{ $pagado->egreso }}</td>
											<td>{{ $pagado->tipoordenpago }}</td>

                                            <td>
                                                <form action="{{ route('pagados.destroy',$pagado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('pagados.show',$pagado->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('pagados.edit',$pagado->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $pagados->links() !!}
            </div>
        </div>
    </div>
@endsection
