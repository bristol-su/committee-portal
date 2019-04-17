@extends('layouts.app')


@section('content')

    <div id="executivesummary-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/executivesummary.js') }}"></script>

@endpush