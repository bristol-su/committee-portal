@extends('layouts.app')


@section('content')

    <div id="libeldefamation-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/libeldefamation.js') }}"></script>

@endpush