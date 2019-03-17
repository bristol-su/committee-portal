@extends('layouts.app')

@section('title', 'Site Settings')

@section('content')

    <div class="py-5">
        <div class="container">
            <h3 style="text-align: center">Site Settings</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>Users</b></h5>
                            <h6 class="card-subtitle my-2 text-muted">Settings concerning users of the site</h6>
                            <div class="row">
                                @can('settings.see-all-admin-users')
                                    <div class="col-xs-12 col-sm-6 col-md-4" style="padding: 2px;">
                                        <a href="{{ url('/admin/settings/admin-users') }}">
                                            <button
                                                    type="button"
                                                    class="module_button btn btn-outline-info"
                                            >
                                                Admin Users
                                            </button>
                                        </a>
                                    </div>
                                @endcan

                                @can('settings.see-roles-and-permissions')
                                    <div class="col-xs-12 col-sm-6 col-md-4" style="padding: 2px;">
                                        <a href="{{ url('/admin/settings/roles-permissions') }}">
                                            <button
                                                    type="button"
                                                    class="module_button btn btn-outline-info"
                                            >
                                                Roles & Permissions
                                            </button>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>
@endsection
