<!-- Committee Role select for logged in users -->
{{--@php dd(Auth::guard('committee-role')); @endphp--}}
<li class="nav-item dropdown">
    <a id="groupSelect" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{Auth::guard('committee-role')->user()->group->name}} - {{Auth::guard('committee-role')->user()->position->name}} <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="groupSelect">
        @foreach($_committeeRoles as $committeeRole)
            @if($committeeRole->id !== Auth::guard('committee-role')->user()->id)
                <a class="dropdown-item" href="{{ url('/login/position') }}" onclick="event.preventDefault();document.getElementById('form-login-{{$committeeRole->id}}').submit();">
                    {{$committeeRole->group->name}} - {{$committeeRole->position->name}}
                </a>
                <form id="form-login-{{$committeeRole->id}}" action="{{ url('/login/position') }}" method="POST" style="display: none;">
                    <input type="hidden" name="committee_role_id" value="{{$committeeRole->id}}"/>
                    @csrf
                </form>


            @endif
        @endforeach
    </div>
</li>