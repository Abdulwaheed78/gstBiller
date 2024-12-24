@extends('vendor_base')
@section('content')
    <?php
    $user = Auth::user(); //admin assigned to the
    ?>
    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center pt-5">
                <!-- User Image -->
                <div class="col-md-5 text-center">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="rounded-circle img-fluid"
                        width="150" height="150">
                </div>
                <!-- User Details -->
                <div class="col-md-7">
                    <h2 class="fw-bold">{{ $user->name }}</h2>
                    <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $user->phone }}</p>
                    <p class="mb-1">
                        <strong>Address:</strong>
                        {{ $user->address . ', ' . $user->city . ', ' . $user->state . ' - ' . $user->pincode }}
                    </p>
                    <a href="{{ route('vendor.profile') }}" class="btn btn-sm btn-outline-dark mt-3">Edit Profile</a>
                </div>

            </div>
        </div>
    </section>

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

    <section class="container my-5">
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
    </section>

    <section class="py-5">
        <div class="container">
            <!-- Section Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Recent Bills</h2>
                <div class="gap-2">
                    <a href="{{ route('vendor.bills.add') }}" class="btn btn-sm btn-outline-success">Add Bill</a>
                    <a href="{{ route('vendor.bills.index') }}" class="btn btn-sm btn-outline-dark">See All</a>

                </div>
            </div>

            <!-- Bills Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Srno</th>
                            <th>Title</th>
                            <th>Customer Info</th>
                            <th>Address</th>
                            <th>Final Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $userdata)
                            <tr>
                                <td>#{{ $userdata->id }}</td>
                                <td>{{ $userdata->title }}</td>
                                <td>
                                    <b>Name : </b>{{ $userdata->b_name }}<br>
                                    <b>Email : </b>{{ $userdata->b_email }}<br>
                                    <b>Phone : </b>{{ $userdata->b_phone }}<br>
                                </td>
                                <td>{{ $userdata->b_address }}<br>{{ $userdata->b_city }}<br>{{ $userdata->b_state }}<br>{{ $userdata->b_pincode }}
                                </td>
                                <td>{{ $userdata->f_amount }}</td>
                                <td>{{ $userdata->created_at }}</td>
                                <td class="d-flex gap-2">

                                    <a class="btn btn-warning btn-sm" title="Edit"
                                        href="{{ route('vendor.bills.edit', ['id' => $userdata->id]) }}"><i
                                            class="fa fa-pencil-alt"></i></a>

                                    <form method="POST"
                                        action="{{ route('vendor.bills.destroy', ['id' => $userdata->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    <a class="btn btn-info btn-sm" title="Show"
                                        href="{{ route('vendor.bills.show', ['id' => $userdata->id]) }}"><i
                                            class="fa fa-eye"></i></a>

                                    <a href="{{ route('vendor.bills.mail', ['data' => $userdata]) }}"
                                        class="btn btn-secondary btn-sm" title="Mail"> <i class="fa fa-envelope"></i></a>


                                    <a href="{{ route('vendor.bills.download', ['id' => $userdata->id]) }}"
                                        class="btn btn-dark btn-sm" title="Download PDF"> <i class="fa fa-download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection
