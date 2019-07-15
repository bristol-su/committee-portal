<b-list-group>
    Group Logic
    @foreach($logics as $logic)
        @if($logic->for === 'group')
        <a href="/admin/settings/logic/{{$logic->id}}">
            <b-list-group-item>
                {{$logic->name}}
            </b-list-group-item>
        </a>
        @endif
    @endforeach

    Student Logic
    @foreach($logics as $logic)
        @if($logic->for === 'student')
            <a href="/admin/settings/logic/{{$logic->id}}">
                <b-list-group-item>
                    {{$logic->name}}
                </b-list-group-item>
            </a>
        @endif
    @endforeach

    <a href="/admin/settings/logic/create">
        <b-list-group-item>
            <i class="fa fa-plus-circle"></i> New Logic
        </b-list-group-item>
    </a>

</b-list-group>