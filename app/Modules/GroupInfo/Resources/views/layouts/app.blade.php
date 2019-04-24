@extends('layouts.app')


@section('content')

    <div id="groupinfo-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/groupinfo.js') }}"></script>

@endpush