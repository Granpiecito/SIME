@extends('layouts/contentNavbarLayout')

@section('title', 'Registrar Usuario')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                                class="bx bx-sm bx-user me-1_5"></i>
                            Usuario</a></li>
                </ul>
            </div>
            <div class="card mb-6">
                <!-- Account -->
                <div class="card-body pt-4">
                    <form method="POST" action="{{ route('auth-user-register') }}">
                        @csrf
                        <div class="row g-6">
                            <div class="col-md-6">
                                <label for="user_name" class="form-label">Nombre usuario</label>
                                <input type="hidden" name="person_id" value="{{ $last_person_id }}">
                                <input class="form-control" type="text" name="user_name" id="user_name" />
                            </div>

                            <div class="col-md-6">
                                <label for="user_details_currentpassword" class="form-label">Contraseña</label>
                                <input class="form-control" type="text" id="user_details_currentpassword"
                                    name="user_details_currentpassword" autofocus />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="rol">Rol</label>
                                <select class="form-control" id="user_rol_id" name="user_rol_id" required>
                                    <option value="">Seleccione Rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->rol_id }}">{{ $role->rol_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="rol">Estado del usario</label>

                                <select class="form-control" id="user_status" name="user_status" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="1">Activo
                                    <option value="0">Inactivo
                                    </option>
                                </select>

                            </div>
                            <div class="mt-6">
                                <button type="button" onclick="window.location.href='{{ url('auth/person-register') }}'"
                                    class="btn btn-secondary me-3">Volver</button>
                                <button type="submit" class="btn btn-primary me-3">Guardar Cambios</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                            </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h4 class="alert-heading">Se encontraron los siguientes errores:</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>
@endsection
