@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="col-lg-8" style="margin: 0 auto;">
            <div class="card">
                <div class="card-header" style="text-align: center">{{$otro->nombre}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('img/otros/'.$otro->image) }}" alt="Foto" width="250" height="200">
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">Area: {{$otro->area->nombre}}</h5>
                            <h6><b>Encargado:</b> {{$otro->area->encargado}}</h6>
                        </div>
                        <div class="col-md-12s">
                            <p><b>Descripción:</b> {{$otro->descripcion}}</p>
                        </div>
                    </div>
                </div>
                <br>
                <!-- End Card with header and footer -->
            </div>
            <a href="{{ url('admin/area/'.$otro->area->id.'/show') }}" class="btn btn-secondary">Volver</a>
        </div>
    </section>
@endsection
