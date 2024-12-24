@extends('base')
@section('title')
    Admin Dashboard
@endsection
@section('content')
    <?php
    $totalTransCount = 0; // To store total count of Trans
    $totalFAmountSum = 0; // To store total sum of f_amount
    $totalGSTSum = 0; // To store total sum of gst

    foreach ($data as $bill) {
        $totalTransCount += $bill->Trans->count(); // Count the number of Trans for this bill
        $totalFAmountSum += $bill->Trans->sum('final_amount'); // Sum the f_amount field for this bill
        $totalGSTSum += $bill->Trans->sum('gst_amount'); // Sum the gst field for this bill
    }
    ?>

    {{-- cards of data  --}}
    <div class="row text-center">
        <!-- Box 1: Bills Count -->
        <div class="col-md-3 mb-3">
            <div class="p-4 bg-white text-primary rounded shadow-sm">
                <i class="fa fa-file-invoice fs-1 mb-2"></i>
                <h4 class="fw-bold">Bills </h4>
                <p id="billsCount" class="fs-5"><strong>{{ count($data) }}</strong></p>
            </div>
        </div>

        <!-- Box 2: Products Count -->
        <div class="col-md-3 mb-3">
            <div class="p-4 bg-white text-success rounded shadow-sm">
                <i class="fa fa-cogs fs-1 mb-2"></i>
                <h4 class="fw-bold">Products </h4>
                <p id="productsCount" class="fs-5"><strong>{{ $totalTransCount }}</strong></p>
            </div>
        </div>
        <!-- Box 3: GST Amount Total -->
        <div class="col-md-3 mb-3">
            <div class="p-4 bg-white text-warning rounded shadow-sm">
                <i class="fa fa-percent fs-1 mb-2"></i>
                <h4 class="fw-bold">GST Amount</h4>
                <p id="gstTotal" class="fs-5">&#8377; <strong>{{ $totalGSTSum }}</strong></p>
            </div>
        </div>
        <!-- Box 4: Total Amount -->
        <div class="col-md-3 mb-3">
            <div class="p-4 bg-white text-danger rounded shadow-sm">
                <i class="fa fa-wallet fs-1 mb-2"></i>
                <h4 class="fw-bold">Total Amount</h4>
                <p id="totalAmount" class="fs-5">&#8377; <strong>{{ $totalFAmountSum }}</strong></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            {{-- new bills --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Created Bills</h4>
                </div>
                <div class="comment-widgets scrollable">
                    @foreach ($data as $data)
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="comment-text w-100">
                                <h6 class="font-medium">
                                    {{ $data->b_name }}. Created {{ $data->creator->name }}
                                    ({{ $data->creator->user_type }})
                                </h6>
                                <span class="m-b-15 d-block">{{ $data->title }}. </span>
                                <div class="comment-footer">
                                    <span
                                        class="text-muted float-right">{{ date('d-M,Y', strtotime($data->created_at)) }}</span>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.bills.edit', $data->id) }}" class="btn btn-primary ml-3"
                                        title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.bills.destroy', $data->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-3" title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this Bill?')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                    <a class="btn btn-info ml-3" title="Show"
                                        href="{{ route('admin.bills.show', ['id' => $data->id]) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- new users div --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Users</h4>
                </div>
                <div class="comment-widgets scrollable">
                    @foreach ($user as $data)
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="comment-text w-100">
                                <div class="d-flex"  >
                                    <!-- Display User Image -->
                                    <div class="mr-3">
                                        <img src="{{ $data->image ? asset('storage/' . $data->image) : asset('default-avatar.png') }}"
                                            alt="NOT" class="rounded-circle"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                    </div>

                                    <div style="width:100%;">
                                        <h6 class="font-medium d-flex"
                                            style="display: flex; justify-content: space-between; width: 100%;">
                                            {{ $data->name }}.
                                            ({{ $data->user_type }})
                                            <!-- Date aligned to the right -->
                                            <span class="text-muted"
                                                style="margin-left: auto;">{{ date('d-M,Y', strtotime($data->created_at)) }}</span>
                                        </h6>

                                        <span class="m-b-15 d-block">{{ $data->email }}. </span>
                                        <div class="comment-footer d-flex justify-content-between">
                                            <!-- Buttons aligned to the left -->
                                            <div style="display: flex; gap: 10px;">
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.edit', $data->id) }}"
                                                    class="btn btn-primary btn-sm" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.destroy', $data->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- card new -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title m-b-0">Admin Logs</h4>
                </div>
                <ul class="list-style-none">
                    @foreach ($log as $log)
                        <li class="d-flex no-block card-body">
                            @php
                                // Assign a class based on the action_name
                                $iconClass = '';
                                $iconColor = '';

                                // Define your conditions here
                                switch ($log->action_name) {
                                    case 'insert':
                                        $iconClass = 'fa-plus-circle';
                                        $iconColor = 'text-success'; // Green
                                        break;
                                    case 'update':
                                        $iconClass = 'fa-sync-alt';
                                        $iconColor = 'text-warning'; // Yellow
                                        break;
                                    case 'delete':
                                        $iconClass = 'fa-trash-alt';
                                        $iconColor = 'text-danger'; // Red
                                        break;
                                    case 'login':
                                        $iconClass = 'fa-sign-in-alt';
                                        $iconColor = 'text-primary'; // Blue
                                        break;
                                    case 'logout':
                                        $iconClass = 'fa-sign-out-alt';
                                        $iconColor = 'text-secondary'; // Gray
                                        break;
                                    default:
                                        $iconClass = 'fa-info-circle';
                                        $iconColor = 'text-muted'; // Gray
                                }
                            @endphp
                            <i class="fa {{ $iconClass }} w-30px m-t-5 {{ $iconColor }}"></i>
                            <div>
                                <a href="#" class="m-b-0 font-medium p-0">{{ $log->user->name }},
                                    {{ $log->user->user_type }}.<b>Did {{ $log->action_name }}</b></a>
                            </div>
                            <div class="ml-auto">
                                <div class="text-right">
                                    <h6 class="text-muted m-b-0">{{ date('d F Y, H:i', strtotime($log->created_at)) }}
                                    </h6>
                                </div>
                            </div>
                        </li>
                    @endforeach


                </ul>
            </div>
        </div>
    </div>
@endsection
