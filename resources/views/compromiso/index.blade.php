@extends('layouts.app')

@section('template_title')
    Compromiso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compromiso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('compromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Analisi Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Codigo</th>
										<th>Fecha</th>
										<th>Estatus</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromisos as $compromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $compromiso->analisi_id }}</td>
											<td>{{ $compromiso->unidadadministrativa_id }}</td>
											<td>{{ $compromiso->codigo }}</td>
											<td>{{ $compromiso->fecha }}</td>
											<td>{{ $compromiso->estatus }}</td>

                                            <td>
                                                <form action="{{ route('compromisos.destroy',$compromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('compromisos.show',$compromiso->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('compromisos.edit',$compromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $compromisos->links() !!}
            </div>
        </div>
    </div>
@endsection
