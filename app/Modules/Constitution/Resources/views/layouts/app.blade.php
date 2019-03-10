@extends('layouts.app')


@section('content')

    <div id="constitution-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/constitution.js') }}"></script>

@endpush