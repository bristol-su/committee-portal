@extends('fileupload::layouts.app')

@section('module-content')
    This is the admin side of the module.

    @dd(request('module_instance_slug')->moduleInstanceSettings->settings)
@endsection