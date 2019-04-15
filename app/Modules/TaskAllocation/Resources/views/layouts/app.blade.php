@extends('layouts.app')


@section('content')

    <div id="taskallocation-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/taskallocation.js') }}"></script>

@endpush