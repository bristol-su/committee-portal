@extends('admin.settings.base_settings')

@section('title', 'Roles')

@section('admin-content')


    <div class="py-5">
        <div class="container">
            <h2 style="text-align: center">Roles</h2>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <role-table>

                        </role-table>
                    </div>
                </div>
                <br/>
        </div>
    </div>
@endsection
