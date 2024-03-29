@extends('layouts.app')

@section('template_title')
    Actualizar Pagado
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Pagado</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagados.index') }}">  Regresar</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pagados.update', $pagado->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('pagado.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
