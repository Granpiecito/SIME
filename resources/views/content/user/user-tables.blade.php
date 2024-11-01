@extends('layouts/contentNavbarLayout')

@section('title', 'Usuarios del Sistema')

@section('vendor-script')
    @vite('resources/assets/vendor/libs/masonry/masonry.js')
@endsection

@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Sesiones</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $getsessions }}</h4>
                                    <p class="text-{{ $getnewsessions < 0 ? 'danger' : 'success' }} mb-0">
                                        (+{{ round($getnewsessions) }}%)</p>
                                </div>
                                <small class="mb-0">Sesiones Totales</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-group bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Total de Usuarios</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $getusercounts }}</h4>
                                    <p class="text-{{ $userspercent < 0 ? 'danger' : 'success' }} mb-0">
                                        (+{{ round($userspercent) }}%)</p>
                                </div>
                                <small class="mb-0">Analisis Semanal</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-secondary">
                                    <i class="bx bx-user-plus bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Usuarios Activos</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $usersacdt }}</h4>
                                    <p class="text-{{ $percentageChange < 0 ? 'danger' : 'success' }} mb-0">
                                        ({{ round($percentageChange) }}%)</p>
                                </div>
                                <small class="mb-0">Analisis Semanal</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-user-check bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Usuarios Inactivos</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $usersinacdt }}</h4>
                                    <p class="text-{{ $inacuserporcent >= 0 ? 'danger' : 'success' }} mb-0">
                                        ({{ round($inacuserporcent) }}%)</p>

                                </div>
                                <small class="mb-0">Analisis Semanal</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="bx bx-user-minus bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Filtros de busqueda</h5>
                <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0 g-6">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="ms-n2">
                                <div class="dataTables_length" id="DataTables_Table_0_length"><label><select
                                            name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                            class="form-select">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select></label></div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div
                                class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0 gap-md-4">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search"
                                            class="form-control" placeholder="Search User"
                                            aria-controls="DataTables_Table_0"></label></div>
                                <div class="dt-buttons btn-group flex-wrap">
                                    <div class="btn-group"><button
                                            class="btn buttons-collection dropdown-toggle btn-label-secondary me-4"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                            aria-haspopup="dialog" aria-expanded="false"><span><i
                                                    class="bx bx-export me-2 bx-sm"></i>Exportar</span></button></div>
                                    <button class="btn btn-secondary add-new btn-primary" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasAddUser"><span><i
                                                class="bx bx-plus bx-sm me-0 me-sm-2"></i><span
                                                class="d-none d-sm-inline-block">Crear usuario</span></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="datatables-users table border-top dataTable no-footer dtr-column"
                        id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                                <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                    style="width: 49.975px; display: none;" aria-label=""></th>
                                <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" style="width: 111.588px;" aria-sort="descending"
                                    aria-label="User: activate to sort column ascending">Nombre</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 111.588px;"
                                    aria-label="Role: activate to sort column ascending">Usuario</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 114.85px;"
                                    aria-label="Plan: activate to sort column ascending">Direccion</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 114.85px;"
                                    aria-label="Plan: activate to sort column ascending">Rol</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 147.113px;"
                                    aria-label="Billing: activate to sort column ascending">Estado</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 151.438px;"
                                    aria-label="Actions">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            <tr>
                                @foreach ($getusersdetailstbl as $userdtbl)
                                    <td></i> <span>{{ $userdtbl->person_name }}</span></td>
                                    <td>
                                        <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top" class="avatar avatar-xs pull-up"
                                                title="Christina Parker">
                                                <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </li>
                                            <span>{{ $userdtbl->user_name }}</span>
                                        </ul>
                                    </td>
                                    <td>{{ $userdtbl->directions_name }}</td>
                                    <td><span class="badge bg-label-success me-1">{{ $userdtbl->rol_name }}</span>
                                    </td>

                                    @if ($userdtbl->user_status == 1)
                                        <td><span class="badge bg-label-primary me-1">Activo</span></td>
                                    @else
                                        <td><span class="badge bg-label-primary me-1">Inactivo</span></td>
                                    @endif
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Editar</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                Showing 0 to 0 of 0 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled"
                                        id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0"
                                            aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1"
                                            class="page-link"><i class="bx bx-chevron-left bx-18px"></i></a></li>
                                    <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a
                                            aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                            data-dt-idx="next" tabindex="-1" class="page-link"><i
                                                class="bx bx-chevron-right bx-18px"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
