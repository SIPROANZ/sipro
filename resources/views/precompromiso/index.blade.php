@extends('layouts.app')

@section('template_title')
    Precompromiso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Precompromiso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('precompromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Documento</th>
										<th>Montototal</th>
										<th>Concepto</th>
										<th>Fechaanulacion</th>
										<th>Unidadadministrativa Id</th>
										<th>Tipocompromiso Id</th>
										<th>Beneficiario Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($precompromisos as $precompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $precompromiso->documento }}</td>
											<td>{{ $precompromiso->montototal }}</td>
											<td>{{ $precompromiso->concepto }}</td>
											<td>{{ $precompromiso->fechaanulacion }}</td>
											<td>{{ $precompromiso->unidadadministrativa_id }}</td>
											<td>{{ $precompromiso->tipocompromiso_id }}</td>
											<td>{{ $precompromiso->beneficiario_id }}</td>

                                            <td>
                                                <form action="{{ route('precompromisos.destroy',$precompromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('precompromisos.show',$precompromiso->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('precompromisos.edit',$precompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $precompromisos->links() !!}
            </div>
        </div>
    </div>
@endsection
