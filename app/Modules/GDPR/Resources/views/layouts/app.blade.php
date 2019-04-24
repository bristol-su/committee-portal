@extends('layouts.app')


@section('content')

    <div id="gdpr-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/gdpr.js') }}"></script>

@endpush