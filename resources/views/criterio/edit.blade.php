@extends('adminlte::page')


@section('title', 'Criterios de Cotizacion')

@section('content_header')
    <h1>Criterios</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Criterio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('criterios.update', $criterio->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('criterio.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
