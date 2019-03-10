@extends('layouts.app')


@section('content')

    <div id="executivesummary-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/executivesummary.js') }}"></script>

@endpush