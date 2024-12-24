@extends('vendor_base')
@section('title')
    Create Bill
@endsection
@section('content')
    <div class="container" style="height: 77vh;">
        <div class="card mx-auto mt-5 mb-5" style="max-width: 600px; ">
            <div class="card-body">
                <h4 class="mb-3">Create Bill - Basic Details</h4>
                <p class="text-danger"><strong>Note:</strong> All fields are mandatory.</p>
                <form method="POST" action="{{ route('vendor.bills.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required>
                        </div>
                    </div>

                    <!-- Personal Details Section -->
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="name">Customer Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                        </div>

                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                required>
                        </div>
                        <div class="col-lg-6">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address"
                                class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city"
                                class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}"
                                required>
                        </div>
                        <div class="col-lg-4">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state"
                                class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}"
                                required>
                        </div>
                        <div class="col-lg-4">
                            <label for="pincode">Pincode</label>
                            <input type="text" id="pincode" name="pincode"
                                class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}"
                                required>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="d-flex justify-content-end gap-3">
                        <button type="submit" class="btn btn-outline-success ">Save</button>
                        <a href="{{ route('vendor.bills.index') }}" class="btn btn-outline-danger ">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
