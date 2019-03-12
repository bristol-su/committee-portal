@extends('layouts.app')


@section('content')

    <div id="wabbudget-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/wabbudget.js') }}"></script>

@endpush