@extends('bristolsu::base')



@section('content')
    <div id="uploadfile-root">
        @yield('module-content')
    </div>
@endsection




@push('styles')
    <link href="{{ asset('modules/uploadfile/css/module.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('modules/uploadfile/js/module.js') }}"></script>
@endpush
