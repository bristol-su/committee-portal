@extends('admin.settings.logic.base')

@section('logic-content')
    <logic-create
    :filters="{{ json_encode($filters) }}">

    </logic-create>
@endsection