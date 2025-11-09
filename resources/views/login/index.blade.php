<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Jual Beli Mobil</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #FFD700 0%, #FFF8DC 100%);
            animation: bgFade 10s ease-in-out infinite alternate;
        }

        @keyframes bgFade {
            0% {
                background: linear-gradient(135deg, #FFD700 0%, #FFF8DC 100%);
            }
            100% {
                background: linear-gradient(135deg, #FFEC8B 0%, #FFFFFF 100%);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #FFC107 0%, #FFA000 100%);
            border: none;
            transition: all 0.3s ease;
            color: #333;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #FFA000 0%, #FF8C00 100%);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border: 2px solid #FFC107;
            color: #FFC107;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: #FFC107;
            color: #333;
            border-color: #FFC107;
        }

        .alert {
            border-radius: 10px;
        }

        .register-links {
            font-size: 0.9rem;
        }

        .register-btn {
            font-size: 0.85rem;
            padding: 0.375rem 0.75rem;
        }

        .form-control:focus {
            border-color: #FFC107;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="container px-4" style="animation: fadeIn 1s ease-in;">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="card shadow-lg p-4">
                <h4 class="text-center mb-4 fw-semibold text-dark">Login ke Akun Anda</h4>

                {{-- Error dari session (misalnya: redirect karena belum login) --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Error dari validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.store') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control rounded-pill" id="username" name="username" placeholder="Masukkan username" required />
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Masukkan password" required />
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fs-5 fw-semibold">Login</button>
                </form>

                <!-- Tautan Registrasi -->
                <div class="text-center mt-4 register-links">
                    <p class="mb-2">Belum punya akun?</p>
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <a href="{{ route('register.customer') }}" class="btn btn-outline-primary rounded-pill px-3 register-btn">Daftar sebagai Customer</a>
                        {{-- <a href="{{ route('register.admin') }}" class="btn btn-outline-primary rounded-pill px-3 register-btn">Daftar sebagai Admin</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>