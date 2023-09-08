@extends('layouts.app')

@section('content')
    <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h2>ERROR 404.</h2>
        <a class="btn" href="{{ url('/') }}">Regresar</a>
        <img src="{{ asset('assets/img/not-found.svg')}}" class="img-fluid py-5" alt="Page Not Found">
        <div class="credits">
            Diseñado por <a href="#">Isak Veliz</a>
        </div>
    </section>
@endsection