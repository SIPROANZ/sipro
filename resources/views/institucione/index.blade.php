@extends('layouts.app')

@section('template_title')
    Institucione
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Institucione') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('instituciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Rif</th>
										<th>Institucion</th>
										<th>Direccion</th>
										<th>Telefono</th>
										<th>Email</th>
										<th>Baselegal</th>
										<th>Web</th>
										<th>Codigopostal</th>
										<th>Organigrama</th>
										<th>Logoinstitucion</th>
										<th>Vision</th>
										<th>Mision</th>
										<th>Razonsocial</th>
										<th>Municipio Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instituciones as $institucione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $institucione->rif }}</td>
											<td>{{ $institucione->institucion }}</td>
											<td>{{ $institucione->direccion }}</td>
											<td>{{ $institucione->telefono }}</td>
											<td>{{ $institucione->email }}</td>
											<td>{{ $institucione->baselegal }}</td>
											<td>{{ $institucione->web }}</td>
											<td>{{ $institucione->codigopostal }}</td>
											<td>{{ $institucione->organigrama }}</td>
											<td>{{ $institucione->logoinstitucion }}</td>
											<td>{{ $institucione->vision }}</td>
											<td>{{ $institucione->mision }}</td>
											<td>{{ $institucione->razonsocial }}</td>
											<td>{{ $institucione->municipio_id }}</td>

                                            <td>
                                                <form action="{{ route('instituciones.destroy',$institucione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('instituciones.show',$institucione->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('instituciones.edit',$institucione->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $instituciones->links() !!}
            </div>
        </div>
    </div>
@endsection
