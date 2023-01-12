@extends('layouts.app')

@section('template_title')
    Crear Nota credito
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Nota credito</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('notacreditos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('notacredito.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
