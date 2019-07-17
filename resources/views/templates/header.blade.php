<div id="committee-portal-header-root">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">

            <!-- Left side of the navbar -->
            @auth
                <a class="navbar-brand" href="{{ homeURL() }}">
                    <img style="max-height: 40px" src="{{serveStatic('su-logo.jpg')}}"/>
                        &nbsp;&nbsp;
                    {{ config('app.name', 'Committee Portal') }}
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Committee Portal') }}
                </a>
            @endauth

            {{--<a class="navbar-brand" href="{{ url('/') }}"><img alt="Bristol SU Logo"--}}
                                                               {{--src="https://s3-eu-west-1.amazonaws.com/nusdigital/union_logo/images/281/original/open-uri20180703-28672-t8fr30."--}}
                                                                   {{--style="width: 75%; height: auto;"/>--}}
            <!-- Navigation toggle for smaller screens -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Right side of NavBar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                @guest
                    <!-- Login and register links for non logged in users -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else

                        {{--This will give admins access to logging in as groups--}}
                        @if(\Auth::user()->can('view-as-student') && \Auth::user()->hasVerifiedEmail())
                            <group-select
                                    @if(\Auth::guard('group')->check()) :group-id="{{\getGroupID()}}"  @endif >

                            </group-select>

                            {{--This grants access to logging in as another role owned by a student--}}
                        @elseif(\Auth::guard('role')->check())
                            <committee-role-select
                                    :role-id="{{ \Auth::user()->getCurrentRole()->id }}">
                            </committee-role-select>
                        @endif

                    <!-- Account Management -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->forename }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!-- Home -->
                                <a class="dropdown-item" href="{{ homeURL() }}">Home</a>
                                <!-- Settings -->
                                @can('view-site-settings-page')
                                    <a class="dropdown-item" href="{{ url('/admin/settings') }}">Settings</a>
                                @endcan
                                <!-- Logout -->
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">@csrf</form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</div>
