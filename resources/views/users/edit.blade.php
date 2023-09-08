@extends('layouts.app')

@section('content')

<section class="section">
    <div class="col-12">
        <div class="card top-selling">
            <div class="card-body pb-0">
                <h5 class="card-title">Editar Usuario <span>| {{ $edit->name }}</span></h5>
                        <!-- Advanced Form Elements -->
                        <form method="post" action="{{ url('admin/users/'.$edit->id.'/edit') }}">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Datos de la cuenta</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Username" value="{{ old('name', $edit->name)}}" name="name">
                                                <label for="floatingInput">Username</label>  
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" value="{{ old('email', $edit->email ) }}" name="email" placeholder="name@example.com">
                                                <label for="floatingInput">Correo Electronico</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="row mb-5">
                            <label class="col-sm-2 col-form-label">Permisos</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{ $permisos->dar_baja_item === 1 ? 'checked' : '' }} name="permisos[]" value="dar_baja_item">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Dar de baja un Elemento</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $permisos->crear_user === 1 ? 'checked' : '' }} name="permisos[]" value="crear_user">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Crear Nuevo Usuario</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $permisos->exportar === 1 ? 'checked' : '' }} name="permisos[]" value="exportar">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Exportar</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $permisos->editar_area === 1 ? 'checked' : '' }} name="permisos[]" value="editar_area">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Editar Area</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $permisos->borrar_area === 1 ? 'checked' : '' }} name="permisos[]" value="borrar_area">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Borrar Area</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ url('admin/users') }}" type="reset" class="btn btn-secondary">Cancelar</a>
                        </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
</section>

@endsection