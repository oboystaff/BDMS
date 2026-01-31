@extends('layouts.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Permissions Management</h4>
                        <span>Assign Permission to Role</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm mb-2 me-4">Back</a>
                    </div>


                    <form class="row g-3 needs-validation" method="POST"
                        action="{{ route('permissions.update', $role->id) }}">
                        @csrf

                        <div class="col-md-12">
                            <label for="exampleFormControlInput1">Role Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleFormControlInput1" name="name" value="{{ $role->name }}" readonly>
                        </div>

                        <label for="permissions" class="form-label" style="margin-top:50px">Assign Permissions</label>
                        <hr />

                        <!-- dashboard -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.dashboards')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('dashboards.operational')" @if (in_array('dashboards.operational', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.dashboards.operational')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('dashboards.financial')" @if (in_array('dashboards.financial', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.dashboards.financial')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- users -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.users')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('users.view')" @if (in_array('users.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.users.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('users.create')" @if (in_array('users.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.users.create')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('users.update')" @if (in_array('users.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.users.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- roles-->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.user_roles')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('roles.view')" @if (in_array('roles.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.roles.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('roles.create')" @if (in_array('roles.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.roles.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('roles.update')" @if (in_array('roles.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.roles.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- permissions -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.permissions')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('permissions.view')" @if (in_array('permissions.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.permissions.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('permissions.create')" @if (in_array('permissions.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.permissions.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('permissions.update')" @if (in_array('permissions.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.permissions.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- services -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.new_stocks')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('new_stocks.view')" @if (in_array('new_stocks.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.new_stocks.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('new_stocks.create')" @if (in_array('new_stocks.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.new_stocks.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('new_stocks.update')" @if (in_array('new_stocks.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.new_stocks.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- drivers -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.inventories')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('inventories.view')" @if (in_array('inventories.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.inventories.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('inventories.create')" @if (in_array('inventories.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.inventories.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('inventories.update')" @if (in_array('inventories.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.inventories.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- vehicles -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.schools')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('schools.view')" @if (in_array('schools.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.schools.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('schools.create')" @if (in_array('schools.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.schools.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('schools.update')" @if (in_array('schools.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.schools.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- customers -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.bookshops')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('bookshops.view')" @if (in_array('bookshops.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.bookshops.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('bookshops.create')" @if (in_array('bookshops.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.bookshops.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('bookshops.update')" @if (in_array('bookshops.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.bookshops.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- job orders -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.requisitions')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('requisitions.view')" @if (in_array('requisitions.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.requisitions.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('requisitions.create')" @if (in_array('requisitions.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.requisitions.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('requisitions.update')" @if (in_array('requisitions.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.requisitions.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- proformas -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.returns')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('returns.view')" @if (in_array('returns.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.returns.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('returns.create')" @if (in_array('returns.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.returns.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('returns.update')" @if (in_array('returns.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.returns.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.requests')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('requests.view')" @if (in_array('requests.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.requests.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('requests.create')" @if (in_array('requests.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.requests.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('requests.update')" @if (in_array('requests.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.requests.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.sales')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('sales.view')" @if (in_array('sales.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.sales.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('sales.create')" @if (in_array('sales.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.sales.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('sales.update')" @if (in_array('sales.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.sales.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- invoices -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.invoices')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('invoices.view')" @if (in_array('invoices.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.invoices.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('invoices.create')" @if (in_array('invoices.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.invoices.create')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('invoices.update')" @if (in_array('invoices.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.invoices.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- payments -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.payments')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('payments.view')" @if (in_array('payments.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.payments.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('payments.create')" @if (in_array('payments.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.payments.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('payments.update')" @if (in_array('payments.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.payments.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- reversals -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.zonal_sales_officers')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('zonal_sales_officers.view')" @if (in_array('zonal_sales_officers.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.zonal_sales_officers.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('zonal_sales_officers.create')" @if (in_array('zonal_sales_officers.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.zonal_sales_officers.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('zonal_sales_officers.update')" @if (in_array('zonal_sales_officers.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.zonal_sales_officers.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- clusters -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.zones')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('zones.view')" @if (in_array('zones.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.zones.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('zones.create')" @if (in_array('zones.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.zones.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('zones.update')" @if (in_array('zones.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.zones.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- business centers -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.territories')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('territories.view')" @if (in_array('territories.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.territories.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('territories.create')" @if (in_array('territories.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.territories.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('territories.update')" @if (in_array('territories.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.territories.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- branches -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.subjects')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('subjects.view')" @if (in_array('subjects.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.subjects.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('subjects.create')" @if (in_array('subjects.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.subjects.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('subjects.update')" @if (in_array('subjects.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.subjects.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- districts -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.levels')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('levels.view')" @if (in_array('levels.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.levels.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('levels.create')" @if (in_array('levels.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.levels.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('levels.update')" @if (in_array('levels.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.levels.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- books -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.books')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('books.view')" @if (in_array('books.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.books.view')
                                    </label>
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('books.create')" @if (in_array('books.create', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.books.create')
                                    </label>
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('books.update')" @if (in_array('books.update', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.books.update')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <!-- reports -->
                        <div class="check_group">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h5>@lang('role.reports')</h5>
                                </div>

                                <div class="col-md-2 text-center">
                                    <label class="d-block" for="chk-ani">
                                        <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                        @lang('role.select_all')
                                    </label>

                                </div>
                                <div class="col-md-7 col-md-offset-1">
                                    <label for="chk-ani">
                                        <input class="form-check-input" name="permissions[]" id="chk-ani"
                                            value="@lang('reports.view')" @if (in_array('reports.view', $role_permissions)) checked @endif
                                            type="checkbox">
                                        @lang('role.reports.view')
                                    </label>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-warning" type="submit">Apply Permission</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/permission/role.js') }}"></script>
@endsection
