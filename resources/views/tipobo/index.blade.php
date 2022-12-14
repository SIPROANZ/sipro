@extends('layouts.app')

@section('template_title')
    Tipobo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8npm">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo BOS') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipobos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Craer nuevo tipo BOS') }}
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

										<th>Nombre</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipobos as $tipobo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $tipobo->nombre }}</td>

                                            <td>
                                                <form action="{{ route('tipobos.destroy',$tipobo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tipobos.show',$tipobo->id) }}"><i class="fa fa-fw fa-eye"></i> ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tipobos.edit',$tipobo->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $tipobos->links() !!}
            </div>
        </div>
    </div>
@endsection
