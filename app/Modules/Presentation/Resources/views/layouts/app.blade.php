@extends('layouts.app')


@section('content')

    <div id="presentation-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/presentation.js') }}"></script>

@endpush