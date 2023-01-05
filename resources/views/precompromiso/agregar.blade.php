@extends('layouts.app')

@section('template_title')
    {{ $precompromiso->name ?? 'Show Precompromiso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Precompromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precompromisos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $precompromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Montototal:</strong>
                            {{ $precompromiso->montototal }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $precompromiso->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $precompromiso->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $precompromiso->unidadadministrativa->unidadejecutora }}
                        </div>
                        <div class="form-group">
                            <strong>Tipocompromiso Id:</strong>
                            {{ $precompromiso->tipodecompromiso->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $precompromiso->beneficiario->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detallesprecompromiso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesprecompromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Montocompromiso</th>
										<th>Precompromiso Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesprecompromisos as $detallesprecompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesprecompromiso->montocompromiso }}</td>
											<td>{{ $detallesprecompromiso->precompromiso_id }}</td>
											<td>{{ $detallesprecompromiso->unidadadministrativa_id }}</td>
											<td>{{ $detallesprecompromiso->ejecucion_id }}</td>

                                            <td>
                                                <form action="{{ route('detallesprecompromisos.destroy',$detallesprecompromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesprecompromisos.edit',$detallesprecompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detallesprecompromisos->links() !!}
            </div>
        </div>
    </div>
@endsection