@extends('fileupload::layouts.app')

@section('title', 'Strategic Plan')

@section('module-content')
    This is the student side of the module.

    Settings for this module:
    <table>
        <tr>
            <th>Key</th>
            <th>Setting</th>
        </tr>
        @foreach(request('module_instance_slug')->moduleInstanceSettings->settings as $key => $setting)
            <tr>
                <td>{{$key}}</td><td>{{$setting}}</td>
            </tr>
        @endforeach
    </table>

    Permissions for this module:
    <table>
        <tr>
            <th>Key</th>
            <th>Setting</th>
        </tr>
        @foreach(request('module_instance_slug')->moduleInstancePermissions->participant_permissions as $key => $logic)
            <tr>
                <td>{{$key}}</td><td>
                    @can($key)Yes @endcan @cannot($key)No @endcannot
                    {{(\App\Support\Permissions\Facade\PermissionTester::evaluate($key)?'Yes':'No')}}
                </td>
            </tr>
        @endforeach
    </table>

    Fire Events:

    <a href="{{moduleUrl('submitted')}}">
        <button type="button" class="btn btn-secondary">Document Submitted</button>
    </a>
    <a href="{{moduleUrl('approved')}}">
        <button type="button" class="btn btn-secondary">Document Approved</button>
    </a>
@endsection