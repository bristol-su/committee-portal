@extends('bristolsu::base')



@section('content')
    <div id="typeform-root">
        @yield('module-content')
    </div>
@endsection




@push('styles')
    <link href="{{ asset('modules/typeform/css/module.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('modules/typeform/js/module.js') }}"></script>
@endpush
