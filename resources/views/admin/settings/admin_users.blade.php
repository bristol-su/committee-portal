@extends('admin.settings.base_settings')

@section('title', 'Admin Users')

@section('admin-content')


    <div class="py-5">
        <div class="container">
            <h2 style="text-align: center">All Users</h2>
            <p>This page will allow you to manage the users on the site. Both admin and students are listed here. You may edit and delete users.</p>
            <p>Managing permissions allows you to control what users can do. The main permissions are:
            <ul>
                <li>Base Admin - Allows a user to act as an admin</li>
                <li>View as Student - Allow the user to view other groups.</li>
                <li>Bypass Maintenance - Allow a user to bypass any module maintenance</li>
                <li>Act as Super Admin - Allow a user to do anything on the site</li>
                <li>View Site Settings - View the main settings page</li>
                <li>Various settings permissions</li>
                <li>Module permissions - these are used when an admin is viewing as a student. To allow them to upload a document in #WAB Budget for example, give them the permission '#WABBudget: Upload'</li>
            </ul></p>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <admin-users-table>

                        </admin-users-table>
                    </div>
                </div>
                <br/>
        </div>
    </div>
@endsection
