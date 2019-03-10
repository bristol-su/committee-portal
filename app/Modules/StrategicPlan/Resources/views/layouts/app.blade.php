@extends('layouts.app')


@section('content')

    <div id="strategicplan-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/strategicplan.js') }}"></script>

@endpush