@inject('unioncloud', 'App\Packages\UnionCloud\UnionCloudInterface')
@inject('controlDB', 'App\Packages\ControlDB\ControlDBInterface')

<tr>
    @if($committee instanceof \App\Modules\CommitteeDetails\Entities\Committee)
        <th scope="row"><span style="font-weight: normal;">{{$unioncloud->getNameByUID($committee->unioncloud_id)}}</span></th>
        <td>{{$unioncloud->getStudentIDByUID($committee->unioncloud_id)}}</td>
        <td>{{ \App\Packages\ControlDB\Models\Position::find($committee->position_control_id)->name }}</td>
        <td>
            <a class="btn btn-outline-primary" href="#"><i class="fa fa-edit"></i>Edit<br></a>
            {{--// TODO make functional--}}
            <a class="btn btn-outline-dark" href="#" onclick="event.preventDefault(); document.getElementById('delete_committee_member').submit();"><i class="fa fa-trash"></i>Delete</a>
            <form id="delete_committee_member" action="{{ url('/committeedetails/delete/'.$committee->id) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>

        </td>
    @elseif($committee instanceof \App\Packages\ControlDB\Models\Position)
        <th scope="row"><span style="font-weight: normal;"> - </span></th>
        <td> - </td>
        <td>{{ $committee->name }}</td>
        <td>
            <a class="btn btn-outline-primary" href="#"><i class="fa fa-edit"></i>Edit<br></a>
        </td>
    @endif

</tr>

