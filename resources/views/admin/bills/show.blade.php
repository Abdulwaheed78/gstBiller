@extends('base')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex mt-3 mb-3 justify-content-end gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-danger">Cancel</a>

        </div>

        <div class="card">
            <div class="card-body">
                <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-end">
                        <div class="col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #{{ $data->id }}</strong>
                            </p>
                        </div>
                        <div class="col-xl-3 float-end" style="text-align: end;">
                            <!-- Export to PDF Button -->
                            <a href="{{ route('admin.bills.download', ['id' => $data->id]) }}" data-mdb-ripple-init
                                class="btn btn-light text-capitalize" data-mdb-ripple-color="dark">
                                <i class="far fa-file-pdf text-danger"></i> Export to PDF
                            </a>

                            <!-- Email Button -->
                            <a href="{{ route('admin.bills.mail', ['data' => $data]) }}" data-mdb-ripple-init
                                class="btn btn-light text-capitalize" data-mdb-ripple-color="dark">
                                <i class="fas fa-envelope text-success"></i> Email
                            </a>
                        </div>

                        <hr>
                    </div>

                    <div class="container">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h4 style="color:#5d9fc5 ;">{{ $data->creator->name }}</h4>
                                <p class="pt-0">(admin)</p>
                            </div>
                        </div>

                        <div class="d-flex flex-col">
                            <div class="col-xl-8">
                                <ul class="list-unstyled">
                                    <li class="text-muted">To: <span style="color:#5d9fc5 ;">{{ $data->b_name }}</span></li>
                                    <li class="text-muted">{{ $data->b_address }}, {{ $data->b_city }},</li>
                                    <li class="text-muted">{{ $data->b_state }}-{{ $data->b_pincode }}</li>
                                    <li class="text-muted"><i class="fas fa-phone"></i> {{ $data->b_phone }}</li>
                                    <li class="text-muted"><i class="fas fa-envelope"></i> {{ $data->b_email }}</li>

                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <p class="text-muted">Invoice</p>
                                <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">ID:</span>#{{ $data->id }}</li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">Creation Date:
                                        </span>{{ date('d-M-Y', strtotime($data->created_at)) }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless">
                                <thead style="background-color:#84B0CA ;" class="text-white">
                                    <tr>
                                        <th scope="col">Sr No.</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Gst Rate</th>
                                        <th scope="col">Gst Amount</th>
                                        <th scope="col">PUC</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->trans as $index => $userdata)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $userdata->description }}</td>
                                            <td>{{ $userdata->qty }}</td>
                                            <td>{{ $userdata->gst_rate }} %</td>
                                            <td>{{ $userdata->gst_amount }}</td>
                                            <td>{{ $userdata->puc }}</td>
                                            <td>{{ $userdata->final_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-8">
                                {{-- <p class="ms-3">This Invoice Generated from Gst Biller Software</p> --}}
                            </div>
                            <div class="col-xl-3 text-end" style="text-align: end;">
                                <p class="text-black float-end"><span class="text-black me-3"> Total Amount: </span><span
                                        style="font-size: 25px;">&#8377;
                                        {{ $data->f_amount }}</span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-12 text-end" style="text-align: end;">
                                <p>Thank you for your purchase</p>
                                {{ $data->creator->name }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
