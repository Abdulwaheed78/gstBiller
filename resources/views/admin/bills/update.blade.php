@extends('base')
@section('title')
    Update Bill
@endsection
@section('content')
    <div class="card">
        <div class="card-body ">
            <h4 class="mb-3">Update Bill -Basic Details </h4>
            <p class="text-danger"><strong>Note:</strong> All fields are mandatory.</p>
            <form method="POST" action="{{ route('admin.bills.update', ['id' => $data->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="name">Title</label>
                        <input type="text" id="title" name="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ $data->title }}" required>
                    </div>

                </div>
                <!-- Personal Details Section -->
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="name">Customer Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $data->b_name }}" required>
                    </div>

                    <div class="col-lg-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ $data->b_email }}" required>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ $data->b_phone }}" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address"
                            class="form-control @error('address') is-invalid @enderror" value="{{ $data->b_address }}"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city"
                            class="form-control @error('city') is-invalid @enderror" value="{{ $data->b_city }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state"
                            class="form-control @error('state') is-invalid @enderror" value="{{ $data->b_state }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="pincode">Pincode</label>
                        <input type="text" id="pincode" name="pincode"
                            class="form-control @error('pincode') is-invalid @enderror" value="{{ $data->b_pincode }}"
                            required>
                    </div>
                </div>

                @if (isset($data))
                    <h4 class="mb-3 mt-5">Products </h4>
                    <div class="row mb-3 font-weight-bold">
                        <div class="col-md-2">Product Description</div>
                        <div class="col-md-1 text-center">Quantity</div>
                        <div class="col-md-1 text-center">Rate</div>
                        <div class="col-md-2 text-center">GST Rate (%)</div>
                        <div class="col-md-2 text-center">GST Amount</div>
                        <div class="col-md-1 text-center">Final Amount</div>
                        <div class="col-md-1 text-center">PUC</div>
                        <div class="col-md-2 text-center">Action</div>
                    </div>
                    @php $grand_amount = 0; @endphp
                    @foreach ($data->trans as $index => $trans)
                        <div class="row mb-3">
                            <div class="col-md-2"><b>{{ $index + 1 }} .{{ $trans->description }}</b></div>
                            <div class="col-md-1 text-center">{{ $trans->qty }}</div>
                            <div class="col-md-1 text-center">{{ $trans->actual_amount }} Rs.</div>
                            <div class="col-md-2 text-center">{{ $trans->gst_rate }} %</div>
                            <div class="col-md-2 text-center">{{ $trans->gst_amount }} Rs.</div>
                            <div class="col-md-1 text-center">{{ $trans->final_amount }} Rs.</div>
                            <div class="col-md-1 text-center">{{ $trans->puc }} Rs.</div>
                            <div class="col-md-2 d-flex justify-content-center">
                                <a href="{{ route('admin.bills.editpro', ['id' => $trans->id]) }}"
                                    class="btn btn-warning">Edit</a>

                                <a href="{{ route('admin.bills.destroypro', ['id' => $trans->id]) }}"
                                    class="btn btn-danger ml-3"
                                    onclick="return confirm('Are you sure you want to delete this record?')">Del</a>


                            </div>
                        </div>
                        <?php
                        $grand_amount += $trans->final_amount;
                        ?>
                    @endforeach

                    <div class="d-flex justify-content-end mt-3">
                        <div class="col-3">
                            <input type="text" name="final_Amount" class="form-control" value="{{ $grand_amount }}"
                                readonly>
                            <label for="finalAmount">Final Amount</label>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.bills.index') }}" class="btn btn-danger ml-3">Cancel</a>
                    <a href="{{ route('admin.bills.addpro', ['id' => $data->id]) }}" class="btn btn-info ml-3">Add
                        Products</a>

                    <a class="btn btn-info  ml-3" title="Show"
                        href="{{ route('admin.bills.show', ['id' => $data->id]) }}"><i class="fa fa-eye"></i></a>

                    <a href="{{ route('admin.bills.mail', ['data' => $data]) }}" class="btn btn-secondary  ml-3"
                        title="Mail"><i class="fa fa-envelope"></i></a>

                    <a href="{{ route('admin.bills.download', ['id' => $data->id]) }}" class="btn btn-dark  ml-3"
                        title="Download PDF"><i class="fa fa-download"></i> </a>
                </div>
            </form>
        </div>
    </div>
@endsection
