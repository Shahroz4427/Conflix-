<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Conflix</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Styles -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />

    <style>
        .login-card {
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 15px;
        }

        @media (max-width: 576px) {
            .login-card {
                width: 100%;
                padding: 15px;
            }

            .header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body style="background: linear-gradient(90deg, rgb(51 164 218), #082e6f);">

<div class="login-container">
    <div class="w-100">
        <div class="card login-card col-12 col-sm-8 col-md-8 col-lg-6 col-xl-5">
            <div class="card-body pt-0">
                <div class="card-header text-center">
                    <img src="{{ asset('assets/img/conflix.png') }}" alt="Logo" style="max-width: 200px;">
                </div>

                @if (session('status'))
                    <div class="alert bg-success text-center text-white py-2 mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert bg-danger text-center text-white py-2 mb-3" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="text-sm text-black">Email:</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="email@example.com">
                    </div>

                    <div class="form-group">
                        <label class="d-flex justify-content-between" for="password">
                            <span class="text-sm text-black">Password:</span>
                            <a href="{{ route('password.request') }}" class="text-sm" style="color: #012a6c;">Forgot password?</a>
                        </label>
                        <input type="password" class="form-control" name="password" required placeholder="*******">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lg text-white" style="background-color: #012a6c;">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Dropdown Toggle Script -->
<script>
    let dropdowns = document.getElementsByClassName('dropdown');

    Array.from(dropdowns).forEach(dropdown => {
        dropdown.addEventListener('click', function () {
            let dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.toggle('d-none');
            }
        });
    });
</script>

<!-- Core JS Files -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Control Center JS -->
<script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>

</body>

</html>
