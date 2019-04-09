@extends('layouts.app')


@section('content')

    <div id="equipmentlist-root">

        @yield('module-content')

    </div>

@endsection

@push('scripts')

    <script src=" {{ mix('js/equipmentlist.js') }}"></script>

@endpush