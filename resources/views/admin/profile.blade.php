@extends('base')
@section('title')
    Admin Profile || Profile Update
@endsection
@section('content')
    <div class="card">
        <div class="card-body ">
            <h4 class="mb-3">Admin Profile -Profile Update</h4>
            <p class="text-danger"><strong>Note:</strong> All fields are mandatory Except image, Address, Password, Confirm
                Password.</p>
            <div class="d-flex justify-content-end">
                <img src="{{ asset('storage/' . $data->image) }}" alt="No IMage" height="100px" width="100px">
            </div>
            <form method="POST" action="{{ route('admin.update.profile', $data->id) }}" enctype="multipart/form-data">
                @csrf
                <!-- Personal Details Section -->
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}" required>
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
                            class="form-control @error('phone') is-invalid @enderror" value="{{ $data->phone }}" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address"
                            class="form-control @error('address') is-invalid @enderror" value="{{ $data->address }}"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city"
                            class="form-control @error('city') is-invalid @enderror" value="{{ $data->city }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state"
                            class="form-control @error('state') is-invalid @enderror" value="{{ $data->state }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="pincode">Pincode</label>
                        <input type="text" id="pincode" name="pincode"
                            class="form-control @error('pincode') is-invalid @enderror" value="{{ $data->pincode }}"
                            required>
                    </div>
                </div>

                <!-- Login Credentials Section -->
                <h4 class="mb-3">Login Credentials Or Change Password</h4>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ $data->email }}" required>
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
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <div class="col-lg-6">
                        <label for="user_type">User Type</label>
                        <select id="user_type" name="user_type"
                            class="form-control @error('user_type') is-invalid @enderror">
                            <option value="vendor" {{ $data->user_type == 'vendor' ? 'selected' : '' }}>Vendor</option>
                            <option value="admin" {{ $data->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="d-flex justify-content-end ">
                    <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger ml-3">Logout</button>
            </form>
        </div>



    </div>
    </div>
@endsection
