@extends('layouts/contentNavbarLayout')

@section('title', 'Roles del Sistema')

@section('vendor-script')
    @vite('resources/assets/vendor/libs/masonry/masonry.js')
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="mb-1">Roles</h4>

        <p class="mb-6">Lista de Roles que se encuentran dentro del sistema.</p>
        <!-- Role cards -->
        <div class="row g-6">
            @foreach ($getrolsys as $roldtbl)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="fw-normal mb-0 text-body">Total de usuarios</h6>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach ($getusersrol as $useroldtl)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="{{ $useroldtl->user_name }}" class="avatar pull-up">
                                            <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    <h5 class="mb-1">{{ $roldtbl->rol_name }}</h5>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                        class="role-edit-modal"><span>Editar Rol</span></a>
                                </div>
                                <a href="javascript:void(0);"><i class="bx bx-copy bx-md text-muted"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-4 ps-6">
                                <img src="../../assets/img/illustrations/lady-with-laptop-light.png" class="img-fluid"
                                    alt="Image" width="120"
                                    data-app-light-img="../../assets/img/illustrations/lady-with-laptop-light.png"
                                    data-app-dark-img="../../assets/img/illustrations/lady-with-laptop-light.png">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">Añadir</button>
                                <p class="mb-0"> Añade un nuevo rol, <br> al sistema.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-6">
                                <h4 class="role-title mb-2">Crear rol</h4>
                                <p>Set role permissions</p>
                            </div>
                            <!-- Add role form -->
                            <form id="addRoleForm" class="row g-6" onsubmit="return false">
                                <div class="col-12">
                                    <label class="form-label" for="rol_name">Role Name</label>
                                    <input type="text" id="rol_name" name="rol_name" class="form-control"
                                        placeholder="Enter a role name" tabindex="-1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="country">Estado del rol</label>
                                    <select class="form-control" id="rol_status" name="rol_status" required>
                                        <option value="">Seleccione una dirección</option>
                                        @foreach ($getrolsys as $roldtbl)
                                            <option value="{{ $roldtbl->rol_name }}">
                                                {{ $roldtbl->rol_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <h5 class="mb-6">Role Permissions</h5>
                                    <!-- Permission table -->
                                    <div class="table-responsive">

                                    </div>
                                    <!-- Permission table -->
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-3">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                </div>
                            </form>
                            <!--/ Add role form -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Add Role Modal -->

            <!-- / Add Role Modal -->
        </div>
    @endsection
