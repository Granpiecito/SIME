@extends('layouts/contentNavbarLayout')

@section('title', 'Registrar Usuario')

@section('page-script')
    @vite(['resources/assets/js/pages-account-settings-account.js'])
    @vite(['resources/js/person.js'])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                                class="bx bx-sm bx-user me-1_5"></i>Persona</a></li>
                </ul>
            </div>
            <div class="card mb-6">
                <!-- Account -->

                <div class="card-body pt-4">
                    <form id="personform" method="POST" action="{{ route('auth-person-register-post') }}"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="person_photo" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="person_photo" name="person_photo" required>
                            </div>
                        </div>
                        @csrf
                        <div class="row g-6">
                            <div class="col-md-6">
                                <label for="person_name" class="form-label">Nombres y Apellidos</label>
                                <input class="form-control" type="text" id="person_name" name="person_name"
                                    placeholder="nombres" autofocus />
                            </div>
                            <div class="col-md-6">
                                <label for="person_email" class="form-label">Correo</label>
                                <input class="form-control" type="text" id="person_email" name="person_email"
                                    placeholder="example@economifamialiar.gob.ni" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="country">Dirección</label>
                                <select class="form-control" id="directions_id" name="directions_id" required>
                                    <option value="">Seleccione una dirección</option>
                                    @foreach ($directions as $direction)
                                        <option value="{{ $direction->directions_id }}">{{ $direction->directions_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-6">
                                <button type="submit" id="submitBtn" class="btn btn-primary me-3"
                                    disabled>Siguiente</button>
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
    @endsection
