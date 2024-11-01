@extends('layouts/contentNavbarLayout')

@section('title', 'Usuarios del Sistema')

@section('vendor-script')
    @vite('resources/assets/vendor/libs/masonry/masonry.js')
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Usuarios sistema</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nombre usuario</th>
                        <th>Dirección</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($getusersdetailstbl as $userdtbl)
                        <tr>
                            <td></i> <span>{{ $userdtbl->person_name }}</span></td>
                            <td>
                                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                            class="rounded-circle">
                                    </li>
                                    <span>{{ $userdtbl->user_name }}</span>
                                </ul>
                            </td>
                            <td>{{ $userdtbl->directions_name }}</td>
                            <td><span class="badge bg-label-success me-1">{{ $userdtbl->rol_name }}</span></td>

                            @if ($userdtbl->user_status == 1)
                                <td><span class="badge bg-label-primary me-1">Activo</span></td>
                            @else
                                <td><span class="badge bg-label-primary me-1">Inactivo</span></td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Editar</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
