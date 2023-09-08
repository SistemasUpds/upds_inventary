@extends('layouts.app')

@section('content')

<section class="section">
    <div class="col-lg-8" style="margin: 0 auto;">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Información de la cuenta de <span>| {{ $user->name }} </span></h5>
                <div class="row">
                  <div class="col-xl-4">
                    <div class="card">
                      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{ asset('assets/img/user.jpg')}}" alt="Profile" class="rounded-circle">
                        <h3>{{ $user->name }}</h3>
                        <div class="social-links mt-2">
                            <a href="{{ url('admin/password/'.$user->id.'/reset') }}"><i class="bi bi-key-fill"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-8">
                    <div class="card">
                      <div class="card-body pt-3">
                        <div class="tab-content pt-2">
                          <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Permisos</h5>
                            <!-- Settings Form -->
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-8 col-lg-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="changesMade" {{ $permisos->resetear === 1 ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="changesMade">
                                                Resetear
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="newProducts" {{ $permisos->importar === 1 ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="newProducts">
                                                Importar
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="proOffers" {{ $permisos->exportar === 1 ? 'checked' : '' }} disabled>
                                            <label class="form-check-label" for="proOffers">
                                                Exportar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                  <a href="{{ url('admin/users') }}" type="submit" class="btn btn-primary">Volver</a>
                                  <a href="{{ url('admin/users/'.$user->id.'/edit')}}" type="submit" class="btn btn-primary">Editar</a>
                                </div>
                              </form><!-- End settings Form -->
                          </div>
                        </div><!-- End Bordered Tabs -->
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection