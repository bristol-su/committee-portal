@extends('layouts.app')


@section('content')

    <div id="ngb-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/ngb.js') }}"></script>

@endpush