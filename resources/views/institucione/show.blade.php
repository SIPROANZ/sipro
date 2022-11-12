@extends('layouts.app')

@section('template_title')
    {{ $institucione->name ?? 'Show Institucione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Institucione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('instituciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Rif:</strong>
                            {{ $institucione->rif }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $institucione->institucion }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $institucione->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $institucione->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $institucione->email }}
                        </div>
                        <div class="form-group">
                            <strong>Baselegal:</strong>
                            {{ $institucione->baselegal }}
                        </div>
                        <div class="form-group">
                            <strong>Web:</strong>
                            {{ $institucione->web }}
                        </div>
                        <div class="form-group">
                            <strong>Codigopostal:</strong>
                            {{ $institucione->codigopostal }}
                        </div>
                        <div class="form-group">
                            <strong>Organigrama:</strong>
                            {{ $institucione->organigrama }}
                        </div>
                        <div class="form-group">
                            <strong>Logoinstitucion:</strong>
                            {{ $institucione->logoinstitucion }}
                        </div>
                        <div class="form-group">
                            <strong>Vision:</strong>
                            {{ $institucione->vision }}
                        </div>
                        <div class="form-group">
                            <strong>Mision:</strong>
                            {{ $institucione->mision }}
                        </div>
                        <div class="form-group">
                            <strong>Razonsocial:</strong>
                            {{ $institucione->razonsocial }}
                        </div>
                        <div class="form-group">
                            <strong>Municipio Id:</strong>
                            {{ $institucione->municipio_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
