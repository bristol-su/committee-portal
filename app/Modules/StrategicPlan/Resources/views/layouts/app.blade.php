@extends('layouts.app')


@section('content')

    <div id="strategicplan-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/strategicplan.js') }}"></script>

@endpush