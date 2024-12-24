@extends('base')
@section('title')
    Manage Admins & Vendors
@endsection
@section('content')
    <div class="card">
        <div class="card-body ">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Manage Admin & Vendors</h5>

                <!-- Add Button at the end -->
                <a href="{{ route('admin.add') }}" class="btn btn-primary">
                    Add Admin/Vendor
                </a>
            </div>
            <div class="table-responsive mt-4">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                            <th>Full Address</th>
                            <th>Add Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $userdata)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $userdata->image) }}" alt="No Image" height="50px"
                                        width="50px" class="img-fluid">
                                </td>
                                <td>{{ $userdata->name }}</td>
                                <td>{{ $userdata->email }}</td>
                                <td>{{ $userdata->phone }}</td>
                                <td>{{ $userdata->user_type }}</td>
                                <td><b>Address: </b><br>
                                    {{ $userdata->address }}<br>
                                    {{ $userdata->city }}<br>
                                    {{ $userdata->state }}<br>
                                    {{ $userdata->pincode }}<br>
                                </td>
                                <td>{{ $userdata->created_at }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.edit', $userdata->id) }}" class="btn btn-primary btn-sm"
                                        title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.destroy', $userdata->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
