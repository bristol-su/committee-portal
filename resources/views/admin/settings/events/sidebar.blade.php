<b-list-group>
    @foreach($events as $event)
        <a href="/admin/settings/events/{{$event->id}}">
            <b-list-group-item>
                {{$event->name}}
            </b-list-group-item>
        </a>
    @endforeach
    <a href="/admin/settings/events/create">
        <b-list-group-item>
            <i class="fa fa-plus-circle"></i> New Event
        </b-list-group-item>
    </a>
</b-list-group>