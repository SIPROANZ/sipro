@extends('layouts.app')

@section('template_title')
    Update Compromiso
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Compromiso</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('compromisos.update', $compromiso->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('compromiso.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
