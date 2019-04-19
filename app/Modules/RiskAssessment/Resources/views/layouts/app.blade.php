@extends('layouts.app')


@section('content')

    <div id="riskassessment-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/riskassessment.js') }}"></script>

@endpush