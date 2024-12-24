<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Vendor Dashboard')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Corrected Bootstrap CSS link -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    @yield('css')
</head>

<body>
    <?php
    $user = Auth::user(); //admin assigned to the
    ?>
    <!-- Header -->
    <header class="bg-light shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light bg-light container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('vendor.dashboard') }}">
                <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="rounded-circle me-2"
                    width="40" height="40">
                <span>{{ $user->name }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" style="font-weight: bold;"
                            href="{{ route('vendor.dashboard') }}"> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" style="font-weight: bold;"
                            href="{{ route('vendor.bills.add') }}">Add Bill</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" style="font-weight: bold;"
                            href="{{ route('vendor.bills.index') }}">List Bills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" style="font-weight: bold;"
                            href="{{ route('vendor.profile') }}">Profile</a>
                    </li>

                </ul>
                <form action="{{ route('vendor.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item" class="btn btn-outline-danger">
                        <i class="fa fa-power-off m-r-5 m-l-5 text-outline-danger"></i> Logout
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">Developed and Designed by
            <a href="https://abdulwaheed78.github.io" target="_blank" class="text-decoration-none text-warning">Abdul
                Waheed</a>
        </p>
    </footer>

    <!-- Corrected Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>

</html>
