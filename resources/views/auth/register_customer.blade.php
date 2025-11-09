<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Registrasi Customer</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #FFD700 0%, #FFF8DC 100%);
            animation: bgFade 10s ease-in-out infinite alternate;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .registration-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            animation: fadeIn 1s ease-in;
        }

        .card {
            border-radius: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #FFC107 0%, #FFA000 100%);
            color: white;
            text-align: center;
            padding: 25px 20px;
            border-bottom: none;
        }

        .card-body {
            padding: 30px;
        }

        .form-title {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .form-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 5px;
        }

        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #FFC107;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #FFC107 0%, #FFA000 100%);
            border: none;
            transition: all 0.3s ease;
            color: #333;
            font-weight: 600;
            border-radius: 12px;
            padding: 12px;
            font-size: 1.05rem;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #FFA000 0%, #FF8C00 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 193, 7, 0.4);
        }

        .alert {
            border-radius: 12px;
            padding: 15px;
        }

        .invalid-feedback {
            display: none;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .form-control.is-invalid ~ .invalid-feedback {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 25px 20px;
            }
            
            .form-title {
                font-size: 1.6rem;
            }
            
            body {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="card">
            <div class="card-header">
                <h2 class="form-title">Registrasi Customer</h2>
                <p class="form-subtitle">Buat akun baru untuk mulai berbelanja</p>
            </div>
            <div class="card-body">
                <!-- Error Message -->
                <div class="alert alert-danger mb-4 d-none" id="error-alert">
                    <ul class="mb-0" id="error-list">
                        <!-- Error messages will be inserted here -->
                    </ul>
                </div>

                <form id="registration-form" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                        <div class="invalid-feedback">
                            Harap masukkan username.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                        <div class="invalid-feedback">
                            Harap masukkan email yang valid.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        <div class="invalid-feedback">
                            Harap masukkan password.
                        </div>
                        <div class="password-requirements">
                            Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                        <div class="invalid-feedback">
                            Harap konfirmasi password.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Masukkan nama lengkap" required>
                        <div class="invalid-feedback">
                            Harap masukkan nama lengkap.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Masukkan nomor telepon" maxlength="13" required>
                        <div class="invalid-feedback" id="phone-error">
                            Nomor telepon tidak boleh lebih dari 13 karakter.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat" required>
                        <div class="invalid-feedback">
                            Harap masukkan alamat.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold">Daftar Sekarang</button>
                </form>
                
                <div class="text-center mt-4">
                    <p class="mb-0">Sudah punya akun? <a href="#" class="text-warning fw-semibold">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            // If form is valid, show success message
                            event.preventDefault();
                            alert('Pendaftaran berhasil! Data Anda telah disimpan.');
                            form.reset();
                            form.classList.remove('was-validated');
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Phone number validation
        document.getElementById('phone_number').addEventListener('input', function() {
            const phoneInput = this;
            const phoneError = document.getElementById('phone-error');
            
            if (phoneInput.value.length > 13) {
                phoneInput.classList.add('is-invalid');
                phoneError.textContent = 'Nomor telepon tidak boleh lebih dari 13 karakter.';
            } else {
                phoneInput.classList.remove('is-invalid');
            }
        });

        // Password validation
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasMinimumLength = password.length >= 8;
            
            if (!hasUpperCase || !hasLowerCase || !hasNumbers || !hasMinimumLength) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        // Confirm password validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.classList.add('is-invalid');
                this.setCustomValidity('Password tidak cocok');
            } else {
                this.classList.remove('is-invalid');
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>