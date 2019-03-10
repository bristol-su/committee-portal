@extends('layouts.app')


@section('content')

    <div id="tierselection-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/tierselection.js') }}"></script>

@endpush