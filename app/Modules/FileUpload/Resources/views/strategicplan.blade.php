@extends('fileupload::layouts.app')

@section('title', 'Strategic Plan')

@section('module-content')
    This is the student side of the module.

    @dd(request('module_instance_slug')->moduleInstanceSettings->settings)
@endsection
