@extends('adminlte::page')

@section('template_title')
    Create Analisi
@endsection

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Analisis</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('analisis.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('analisi.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
