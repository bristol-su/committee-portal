@extends('layouts.app')


@section('content')

    <div id="wabstrategicplan-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/wabstrategicplan.js') }}"></script>

@endpush