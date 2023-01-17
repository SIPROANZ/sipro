@extends('layouts.app')

@section('template_title')
   Actualizar Nota credito
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Nota credito</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('notacreditos.update', $notacredito->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('notacredito.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
