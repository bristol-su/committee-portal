@extends('layouts.app')


@section('content')

    <div id="furtherinformation-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/furtherinformation.js') }}"></script>

@endpush