@extends('layouts.app')

@section('template_title')
    Bo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Bo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('bos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Descripcion</th>
										<th>Producto Id</th>
										<th>Unidadmedida Id</th>
										<th>Tipobos Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bos as $bo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $bo->descripcion }}</td>
											<td>{{ $bo->producto_id }}</td>
											<td>{{ $bo->unidadmedida_id }}</td>
											<td>{{ $bo->tipobos_id }}</td>

                                            <td>
                                                <form action="{{ route('bos.destroy',$bo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('bos.show',$bo->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('bos.edit',$bo->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $bos->links() !!}
            </div>
        </div>
    </div>
@endsection
