<div id="header-vue-root">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">

            <!-- Left side of the navbar -->
            @auth
                <a class="navbar-brand" href="{{url('/')}}">
                    <img style="max-height: 40px" src="{{serveStatic('su-logo.jpg')}}"/>
                    &nbsp;&nbsp;
                    {{ config('app.name', 'Committee Portal') }}
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Committee Portal') }}
                </a>
        @endauth

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


                    <!-- Account Management -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->forename }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!-- Home -->
                                <a class="dropdown-item" href="#">
                                    @if($currentRole !== null)
                                        Acting as {{$currentRole->positionName()}} of {{$currentRole->group()->name()}}
                                    @elseif($currentGroup !== null)
                                        Acting in your membership to {{$currentGroup->name()}}
                                    @elseif($currentUser !== null)
                                        Acting as yourself
                                    @else
                                        Not acting as anything
                                    @endif
                                </a>
                                <a class="dropdown-item" href="{{url('/')}}">Home</a>
                                <!-- Settings -->
                                @can('view-settings')
                                    <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
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


@push('scripts')
    <script src="{{ mix('js/header.js') }}"></script>
@endpush
