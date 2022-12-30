@extends('layouts.app')

@section('template_title')
    Ajustescompromiso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ajustescompromiso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ajustescompromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Tipo</th>
										<th>Compromiso Id</th>
										<th>Documento</th>
										<th>Concepto</th>
										<th>Montoajuste</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ajustescompromisos as $ajustescompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ajustescompromiso->tipo }}</td>
											<td>{{ $ajustescompromiso->compromiso_id }}</td>
											<td>{{ $ajustescompromiso->documento }}</td>
											<td>{{ $ajustescompromiso->concepto }}</td>
											<td>{{ $ajustescompromiso->montoajuste }}</td>

                                            <td>
                                                <form action="{{ route('ajustescompromisos.destroy',$ajustescompromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ajustescompromisos.show',$ajustescompromiso->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ajustescompromisos.edit',$ajustescompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $ajustescompromisos->links() !!}
            </div>
        </div>
    </div>
@endsection
