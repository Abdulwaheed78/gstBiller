@extends('base')
@section('title')
    Add Admin || Vendor
@endsection
@section('content')
    <div class="card">
        <div class="card-body ">
            <h4 class="mb-3">Add Admin || Vendor</h4>
            <p class="text-danger"><strong>Note:</strong> All fields are mandatory Except Image, Address.</p>
            <form method="POST" action="{{ route('admin.create') }}" enctype="multipart/form-data">
                @csrf
                <!-- Personal Details Section -->
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
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
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
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
                            class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state"
                            class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label for="pincode">Pincode</label>
                        <input type="text" id="pincode" name="pincode"
                            class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}"
                            required>
                    </div>
                </div>

                <!-- Login Credentials Section -->
                <h4 class="mb-3">Login Credentials</h4>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            required>
                    </div>

                    <div class="col-lg-6">
                        <label for="user_type">User Type</label>
                        <select id="user_type" name="user_type"
                            class="form-control @error('user_type') is-invalid @enderror">
                            <option value="vendor" {{ old('user_type', 'vendor') == 'vendor' ? 'selected' : '' }}>Vendor
                            </option>
                            <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.index') }}" class="btn btn-danger ml-3">Cancel</a>
                </div>
            </form>


        </div>
    </div>
@endsection
