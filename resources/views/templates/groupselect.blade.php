<!-- Group select for logged in users -->
<li class="nav-item dropdown">
    <a id="groupSelect" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{Auth::user()->getGroups()[Auth::user()->getCurrentGroup()]}} <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="groupSelect">
        @foreach(Auth::user()->getGroups() as $groupID => $groupName)
            @if($groupID !== Auth::user()->getCurrentGroup())
                <a href="#" class="dropdown-item">{{$groupName}}</a>
            @endif
        @endforeach
    </div>
</li>