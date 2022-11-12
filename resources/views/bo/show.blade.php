@extends('layouts.app')

@section('template_title')
    {{ $bo->name ?? 'Show Bo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Bo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('bos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $bo->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Producto Id:</strong>
                            {{ $bo->producto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadmedida Id:</strong>
                            {{ $bo->unidadmedida_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipobos Id:</strong>
                            {{ $bo->tipobos_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
