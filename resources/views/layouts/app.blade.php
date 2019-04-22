<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Analytics -->
@if(config('app.analytics.enabled'))
    @include('templates.analytics')
@endif
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'Committee Portal')}} | @yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          type="text/css">

    <!-- Styles -->


    <!-- Scripts -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script src="{{ mix('js/vendor.js') }}"></script>
    <link rel="stylesheet" type="text/css"
          href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function () {
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#237afc"
                    },
                    "button": {
                        "background": "#fff",
                        "text": "#237afc"
                    }
                },
                "theme": "edgeless",
                "content": {
                    "message": "We use cookies to ensure that we give you the best experience on our website. If you continue we'll assume that you are happy to receive all cookies on our website.",
                    "href": "https://www.bristolsu.org.uk/get_cookie_policy_details"
                },
                "cookie": {
                    "domain": "{{config('app.cookie_domain')}}"
                }
            })
        });
    </script>
</head>

<body style="width: 100%; min-width: 100%; height: 100%; min-height: 100%;">
@if (session('status'))
    <div class="alert alert-success" role="alert" style="text-align: center">
        {{ session('status') }}
    </div>
@endif

<div class="">
    <noscript>
        @include('templates.noscript')
    </noscript>
    @include('templates.header')

    @if(request()->route()->getName() !== null && \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::exists(request()->route()->getName()))
        {{\DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render()}}
    @endif

    <div class="spinner-target"></div>
    @yield('content')

    @include('templates.footer')
</div>

<script src="{{ mix('js/app.js') }}"></script>
@include('templates.freshdesk')
@stack('scripts')

</body>

</html>
