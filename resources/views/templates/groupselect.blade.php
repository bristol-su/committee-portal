<!-- Group select for logged in users -->
<li class="nav-item dropdown">
    <a id="groupSelect" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{Auth::user()->getCurrentPosition()['group_name']}} - {{Auth::user()->getCurrentPosition()['position_name']}} <span class="caret"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="groupSelect">
        @foreach(Auth::user()->getPositions() as $positionID => $positionDetails)
            @if($positionID !== Auth::user()->getCurrentPositionID())
                <a class="dropdown-item" href="{{ url('/login/position') }}" onclick="event.preventDefault();document.getElementById('form-login-{{$positionID}}').submit();">
                    {{$positionDetails['group_name']}} - {{$positionDetails['position_name']}}
                </a>
                <form id="form-login-{{$positionID}}" action="{{ url('/login/position') }}" method="POST" style="display: none;">
                    <input type="hidden" name="position_id" value="{{$positionID}}"/>
                    @csrf
                </form>


            @endif
        @endforeach
    </div>
</li>