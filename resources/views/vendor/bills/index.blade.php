@extends('vendor_base')
@section('title')
    Manage Bills
@endsection
@section('content')
    <div class="container mt-5 mb-5" style="height: 77vh; ">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Manage Bills </h5>
                    <div class="gap-2">
                        <a href="{{ route('vendor.bills.add') }}" class="btn btn-sm btn-outline-success">Add Bill</a>
                        <a href="{{ route('vendor.dashboard') }}" class="btn btn-sm btn-outline-dark">Home</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table id="bills_table" class="table table-striped table-bordered">
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
                                        <!-- First row of buttons -->
                                        <div class="d-flex gap-2 mb-2">

                                            <a class="btn btn-warning btn-sm" title="Edit"
                                                href="{{ route('vendor.bills.edit', ['id' => $userdata->id]) }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>

                                            <form method="POST"
                                                action="{{ route('vendor.bills.destroy', ['id' => $userdata->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Second row of buttons -->
                                        <div class="d-flex gap-2">

                                            <a class="btn btn-info btn-sm" title="Show"
                                                href="{{ route('vendor.bills.show', ['id' => $userdata->id]) }}"><i
                                                    class="fa fa-eye"></i></a>

                                            <a href="{{ route('vendor.bills.mail', ['data' => $userdata]) }}"
                                                class="btn btn-secondary btn-sm" title="Mail"><i
                                                    class="fa fa-envelope"></i></a>

                                            <a href="{{ route('vendor.bills.download', ['id' => $userdata->id]) }}"
                                                class="btn btn-dark btn-sm" title="Download PDF"><i
                                                    class="fa fa-download"></i> </a>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

    <!-- DataTable JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bills_table').DataTable({
                "responsive": true, // Makes the table responsive
                "pageLength": 10, // Default number of rows to show
                "lengthMenu": [10, 25, 50, 100], // Page length options
                "order": [
                    [0, 'desc']
                ], // Order by the "Add Date" column
            });
        });
    </script>
@endsection
