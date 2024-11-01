@extends('layouts/contentNavbarLayout')

@section('title', 'Roles del Sistema')

@section('vendor-script')
    @vite('resources/assets/vendor/libs/masonry/masonry.js')
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Roles del Sistema</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre Rol</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($getrolsys as $roldtbl)
                        <tr>
                            <td></i> <span>{{ $roldtbl->rol_name }}</span></td>
                            <td>
                                <span>{{ $roldtbl->rol_description }}</span>
                            </td>
                            @if ($roldtbl->rol_status == 1)
                                <td><span class="badge bg-label-primary me-1">Activo</span></td>
                            @else
                                <td><span class="badge bg-label-primary me-1">Inactivo</span></td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-edit-alt me-1"></i>
                                        Editar</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            Eliminar</a>
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
