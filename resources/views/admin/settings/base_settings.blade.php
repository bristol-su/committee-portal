@extends('layouts.app')

@section('content')

   <div id="root-site-settings">
      @yield('admin-content')
   </div>

   <script src="{{ mix('js/sitesettings.js') }}"></script>

@endsection
