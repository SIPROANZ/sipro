@extends('layouts.app')

@section('template_title')
    Cuentasbancaria
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cuentasbancaria') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cuentasbancarias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Banco Id</th>
										<th>Institucion Id</th>
										<th>Fechaapertura</th>
										<th>Montoapertura</th>
										<th>Montosaldo</th>
										<th>Cuenta</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuentasbancarias as $cuentasbancaria)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $cuentasbancaria->banco_id }}</td>
											<td>{{ $cuentasbancaria->institucion_id }}</td>
											<td>{{ $cuentasbancaria->fechaapertura }}</td>
											<td>{{ $cuentasbancaria->montoapertura }}</td>
											<td>{{ $cuentasbancaria->montosaldo }}</td>
											<td>{{ $cuentasbancaria->cuenta }}</td>
											<td>{{ $cuentasbancaria->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('cuentasbancarias.destroy',$cuentasbancaria->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cuentasbancarias.show',$cuentasbancaria->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cuentasbancarias.edit',$cuentasbancaria->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $cuentasbancarias->links() !!}
            </div>
        </div>
    </div>
@endsection
