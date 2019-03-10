@extends('layouts.app')


@section('content')

    <div id="budget-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/budget.js') }}"></script>

@endpush