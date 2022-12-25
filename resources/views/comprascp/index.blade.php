@extends('layouts.app')

@section('template_title')
    Comprascp
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Comprascp') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('comprascps.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Compra Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Monto</th>
										<th>Disponible</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprascps as $comprascp)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $comprascp->compra_id }}</td>
											<td>{{ $comprascp->unidadadministrativa_id }}</td>
											<td>{{ $comprascp->ejecucion_id }}</td>
											<td>{{ $comprascp->monto }}</td>
											<td>{{ $comprascp->disponible }}</td>

                                            <td>
                                                <form action="{{ route('comprascps.destroy',$comprascp->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('comprascps.show',$comprascp->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('comprascps.edit',$comprascp->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $comprascps->links() !!}
            </div>
        </div>
    </div>
@endsection
