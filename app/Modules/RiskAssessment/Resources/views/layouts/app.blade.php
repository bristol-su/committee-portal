@extends('layouts.app')


@section('content')

    <div id="riskassessment-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/riskassessment.js') }}"></script>

@endpush