@extends('layouts.app')

@section('template_title')
    {{ $familia->name ?? 'Show Familia' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Familia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('familias.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Codigofamilia:</strong>
                            {{ $familia->codigofamilia }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $familia->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Segmento Id:</strong>
                            {{ $familia->segmento_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
