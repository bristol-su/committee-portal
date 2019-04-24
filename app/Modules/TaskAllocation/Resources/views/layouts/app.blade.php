@extends('layouts.app')


@section('content')

    <div id="taskallocation-root">

        @yield('module-content')

@include('templates.back_to_portal_button')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/taskallocation.js') }}"></script>

@endpush