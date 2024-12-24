@extends('base')
@section('title')
    Manage Logs
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Manage Logs</h5>
            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Table Name</th>
                            <th>Action</th>
                            <th>User Details</th>
                            <th>Item Id</th>
                            <th>Timming</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $userdata)
                            <tr>
                                <td>{{$userdata->id}}</td>
                                <td>{{$userdata->type_name}}</td>
                                <td>{{$userdata->table_name}}</td>
                                <td>{{$userdata->action_name}}</td>
                                <td>{{$userdata->user->name}}<br>{{$userdata->user->user_type}} , {{$userdata->user->email}}</td>
                                <td>{{$userdata->item_id}}</td>
                                <td>{{$userdata->created_at}}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
