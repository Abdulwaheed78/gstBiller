<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <h4 class="text-white"> GST Biller Set Password</h4>
                    </div>


                    <form class="form-horizontal m-t-20" id="resetform" action="{{ route('change.verify') }}"
                        method="POST">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                <!-- OTP Field -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white" id="basic-addon3"><i
                                                class="ti-key"></i></span>
                                    </div>
                                    <input type="number" id="otp" class="form-control form-control-lg"
                                        placeholder="Enter OTP" name="otp" required>
                                </div>

                                <!-- Password Field -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon4"><i
                                                class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" id="password" class="form-control form-control-lg"
                                        placeholder="New Password" name="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon5"><i
                                                class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" id="confirm_password" class="form-control form-control-lg"
                                        placeholder="Confirm Password" name="confirm_password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggleConfirmPassword"
                                            style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <a class="btn btn-primary" href="{{ route('index') }}">Back To Login</a>
                                        <button class="btn btn-success float-right" type="submit">Verify and
                                            Change</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('confirm_password');
            const icon = this.querySelector('i');
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $('.preloader').fadeOut();
    </script>

</body>

</html>
