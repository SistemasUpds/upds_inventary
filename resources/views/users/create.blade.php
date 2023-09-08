@extends('layouts.app')

@section('content')

<section class="section">
    <div class="col-lg-8" style="margin: 0 auto;">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Vista de <span>| Crear nueva cuenta</span></h5>
            <!-- Vertical Form -->
            <form action="{{ url('admin/users')}}" method="POST" role="form text-left">
                {{ csrf_field() }}
                @if($errors->any())
                    <div class="mt-3  alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text text-black">
                        {{$errors->first()}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                <div class="col-12">
                    <label for="name" class="form-label"> Username</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-12">
                    <label for="encargado" class="form-label"> Correo Electronico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-12">
                    <label for="password" class="form-label"> Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                    <div class="col-12">
                        <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                <br><br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">guardar</button>
                    <a href="{{url('/')}}" type="reset" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>

@endsection