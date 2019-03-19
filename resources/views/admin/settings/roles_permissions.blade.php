@extends('admin.settings.base_settings')

@section('title', 'Roles')

@section('admin-content')


    <div class="py-5">
        <div class="container">
            <h2 style="text-align: center">Roles</h2>
            <p>A role is a quick way of assigning multiple permissions to a user. If you create a 'Student Services'
                role, for example, you can assign all the permissions a Student Services user would require. The role
                may then be applied to multiple users.</p>
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
