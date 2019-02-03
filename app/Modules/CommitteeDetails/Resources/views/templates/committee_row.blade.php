@inject('unioncloud', 'App\Packages\UnionCloud\UnionCloudInterface')
@inject('controlDB', 'App\Packages\ControlDB\ControlDBInterface')

<tr>
    @if($committee instanceof \App\Modules\CommitteeDetails\Entities\Committee)
        <th scope="row"><span style="font-weight: normal;">{{$unioncloud->getNameByUID($committee->unioncloud_id)}}</span></th>
        <td>{{$unioncloud->getStudentIDByUID($committee->unioncloud_id)}}</td>
        <td>{{$controlDB->getSpecificPosition($committee->position_control_id)->name}}</td>
        <td><a class="btn btn-outline-primary" href="#"><i class="fa fa-edit"></i>Edit<br></a><a class="btn btn-outline-dark" href="#"><i class="fa fa-trash"></i>Delete</a></td>
    @elseif(is_array($committee))
        <th scope="row"><span style="font-weight: normal;"> - </span></th>
        <td> - </td>
        <td>{{ $committee['position_name'] }}</td>
        <td><a class="btn btn-outline-primary" href="#"><i class="fa fa-edit"></i>Edit<br></a><a class="btn btn-outline-dark" href="#"><i class="fa fa-trash"></i>Delete</a></td>
    @endif

</tr>