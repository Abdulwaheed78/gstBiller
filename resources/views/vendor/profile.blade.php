@extends('vendor_base')

@section('title')
    Vendor Profile || Profile Update
@endsection

@section('content')
    <?php
    $vendor = Auth::user();
    ?>
    <div class="container d-flex justify-content-center align-items-center mt-5 mb-5" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 900px;">
            <div class="card-body">
                <h4 class="mb-3">Vendor Profile - Profile Update</h4>
                <p class="text-danger"><strong>Note:</strong> All fields are mandatory Except image, Address, Password,
                    Confirm Password.</p>
                <div class="d-flex justify-content-end">
                    <img src="{{ asset('storage/' . $vendor->image) }}" alt="No Image" height="100px" width="100px">
                </div>
                <form method="POST" action="{{ route('vendor.update.profile', $vendor->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Personal Details Section -->
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ $vendor->name }}"
                                required>
                        </div>
                        <div class="col-lg-6">
                            <label for="image">Profile Image</label>
                            <input type="file" id="image" name="image"
                                class="form-control @error('image') is-invalid @enderror">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ $vendor->phone }}"
                                required>
                        </div>
                        <div class="col-lg-6">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address"
                                class="form-control @error('address') is-invalid @enderror" value="{{ $vendor->address }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city"
                                class="form-control @error('city') is-invalid @enderror" value="{{ $vendor->city }}"
                                required>
                        </div>
                        <div class="col-lg-4">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state"
                                class="form-control @error('state') is-invalid @enderror" value="{{ $vendor->state }}"
                                required>
                        </div>
                        <div class="col-lg-4">
                            <label for="pincode">Pincode</label>
                            <input type="text" id="pincode" name="pincode"
                                class="form-control @error('pincode') is-invalid @enderror" value="{{ $vendor->pincode }}"
                                required>
                        </div>
                    </div>

                    <!-- Login Credentials Section -->
                    <h4 class="mb-3 mt-5">Login Credentials Or Change Password</h4>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ $vendor->email }}"
                                required>
                        </div>
                        <div class="col-lg-6">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control">
                        </div>

                        <div class="col-lg-6">
                            <label for="user_type">User Type</label>
                            <select id="user_type" name="user_type"
                                class="form-control @error('user_type') is-invalid @enderror">
                                <option value="vendor" {{ $vendor->user_type == 'vendor' ? 'selected' : '' }}>Vendor
                                </option>
                                <option value="admin" {{ $vendor->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="d-flex justify-content-end gap-4">
                        <button type="submit" class="btn btn-sm btn-outline-success">Save</button>

                </form>
                <form action="{{ route('vendor.logout') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-end ">
                        <button type="submit" class="btn btn-sm btn-outline-danger ">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
