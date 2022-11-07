@extends('layouts.app')

@section('template_title')
    Update Clasificadorpresupuestario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Clasificador Presupuestario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('clasificadorpresupuestarios.update', $clasificadorpresupuestario->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('clasificadorpresupuestario.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
