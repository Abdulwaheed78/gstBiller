@extends('base')
@section('title')
    Manage Bills
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Manage Bills </h5>
                <a href="{{ route('admin.bills.add') }}" class="btn btn-primary">Create Bill</a>
            </div>
            <div class="table-responsive mt-4">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Final Amount</th>
                            <th>Creator</th>
                            <th>Add Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $userdata)
                            <tr>
                                <td>{{ $userdata->title }}</td>
                                <td>{{ $userdata->b_name }}</td>
                                <td>{{ $userdata->b_email }}</td>
                                <td>{{ $userdata->b_phone }}</td>
                                <td>{{ $userdata->b_address }}<br>{{ $userdata->b_city }}<br>{{ $userdata->b_state }}<br>{{ $userdata->b_pincode }}
                                </td>
                                <td>{{ $userdata->f_amount }}</td>
                                <td>{{ $userdata->creator->name }}<br>{{ $userdata->creator->user_type }} ,
                                    {{ $userdata->creator->email }}</td>
                                <td>{{ $userdata->created_at }}</td>
                                <td>
                                    <!-- First Row: Edit and Delete Buttons -->
                                    <div class="d-flex">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.bills.edit', $userdata->id) }}"
                                            class="btn btn-primary ml-3" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.bills.destroy', $userdata->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ml-3" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this Bill?')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Second Row: Show, Mail, and Download Buttons -->
                                    <div class="d-flex mt-2">
                                        <a class="btn btn-info ml-3" title="Show"
                                            href="{{ route('admin.bills.show', ['id' => $userdata->id]) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.bills.mail', ['data' => $userdata]) }}"
                                            class="btn btn-secondary ml-3" title="Mail">
                                            <i class="fa fa-envelope"></i>
                                        </a>

                                        <a href="{{ route('admin.bills.download', ['id' => $userdata->id]) }}"
                                            class="btn btn-dark ml-3" title="Download PDF">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
