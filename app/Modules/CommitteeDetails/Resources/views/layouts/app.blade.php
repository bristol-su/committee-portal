@extends('layouts.app')


@section('content')

    <div id="committeedetails-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/committeedetails.js') }}"></script>

@endpush