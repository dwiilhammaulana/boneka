<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Registrasi Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            animation: bgFade 10s ease-in-out infinite alternate;
        }

        @keyframes bgFade {
            0% {
                background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            }
            100% {
                background: linear-gradient(135deg, #A1C4FD 0%, #C2E9FB 100%);
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
            animation: fadeIn 1s ease-in;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="container px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-10">
            <div class="card shadow-lg p-4">
                <h4 class="text-center mb-4 fw-semibold text-dark">Registrasi Admin</h4>

                {{-- Error Message --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.admin.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" class="form-control rounded-pill" id="username" name="username" placeholder="Masukkan username" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control rounded-pill" id="email" name="email" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" class="form-control rounded-pill" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control rounded-pill" id="full_name" name="full_name" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone_number" class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" class="form-control rounded-pill" id="phone_number" name="phone_number" placeholder="Masukkan nomor telepon" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold fs-5">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
