@extends('layouts.app')

@section('template_title')
    Familia de BOS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Familia de BOS') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('familias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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

										<th>Codigo</th>
										<th>Nombre</th>
										<th>Segmento</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($familias as $familia)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $familia->codigofamilia }}</td>
											<td>{{ $familia->nombre }}</td>
											<td>{{ $familia->segmento->nombre }}</td>

                                            <td>
                                                <form action="{{ route('familias.destroy',$familia->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('familias.show',$familia->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('familias.edit',$familia->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $familias->links() !!}
            </div>
        </div>
    </div>
@endsection
