@extends('layouts.app')

@section('template_title')
    Ordenpago
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ordenpago') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ordenpagos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nordenpago</th>
										<th>Beneficiario Id</th>
										<th>Montobase</th>
										<th>Montoretencion</th>
										<th>Montoneto</th>
										<th>Fechaanulacion</th>
										<th>Status</th>
										<th>Tipoorden</th>
										<th>Montoiva</th>
										<th>Montoexento</th>
										<th>Compromiso Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenpagos as $ordenpago)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ordenpago->nordenpago }}</td>
											<td>{{ $ordenpago->beneficiario_id }}</td>
											<td>{{ $ordenpago->montobase }}</td>
											<td>{{ $ordenpago->montoretencion }}</td>
											<td>{{ $ordenpago->montoneto }}</td>
											<td>{{ $ordenpago->fechaanulacion }}</td>
											<td>{{ $ordenpago->status }}</td>
											<td>{{ $ordenpago->tipoorden }}</td>
											<td>{{ $ordenpago->montoiva }}</td>
											<td>{{ $ordenpago->montoexento }}</td>
											<td>{{ $ordenpago->compromiso_id }}</td>

                                            <td>
                                                <form action="{{ route('ordenpagos.destroy',$ordenpago->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ordenpagos.show',$ordenpago->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ordenpagos.edit',$ordenpago->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $ordenpagos->links() !!}
            </div>
        </div>
    </div>
@endsection
