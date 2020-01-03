@if(isset($globalScripts))
    @foreach($globalScripts as $script)
        @push('scripts')
            <script src="{{$script}}"></script>
        @endpush
    @endforeach
@endif

@includeFirst(['partials.injections', 'bristolsu::partials.injections'])

@includeFirst(['partials.doctype', 'bristolsu::partials.doctype'])
@componentFirst(['partials.components.html', 'bristolsu::partials.components.html'])

    @componentFirst(['partials.components.head', 'bristolsu::partials.components.head'])
        @stack('meta-tags')
        @includeFirst(['partials.javascript', 'bristolsu::partials.javascript'])
        @includeFirst(['partials.analytics', 'bristolsu::partials.analytics'])
        <title>@yield('title', 'Portal')</title>
        @stack('fonts')
        @stack('styles')
        @includeFirst(['partials.noscript', 'bristolsu::partials.noscript'])
        @includeFirst(['partials.cookies_warning', 'bristolsu::partials.cookies_warning'])
    @endcomponentfirst

    @componentFirst(['partials.components.body', 'bristolsu::partials.components.body'])
        @includeFirst(['partials.header', 'bristolsu::partials.header'])
        @yield('content')
        @includeFirst(['partials.footer', 'bristolsu::partials.footer'])
        @stack('scripts')
    @endcomponentfirst

@endcomponentfirst