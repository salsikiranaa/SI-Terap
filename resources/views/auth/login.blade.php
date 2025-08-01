<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SI-TERAP Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        /* Reset & Global */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            height: 100vh;
            background-image: url("{{ asset('assets/img/galeri/bg_login.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .login-container {
            background-color: #ffffff;
            padding: 2.5rem 2rem;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            max-width: 420px;
            width: 100%;
        }

        .login-container img {
            max-width: 120px;
            display: block;
            margin: 0 auto 1rem;
        }

        .login-container h2 {
            text-align: center;
            font-weight: 600;
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .login-subtext {
            text-align: center;
            font-size: 0.95rem;
            color: #777;
            line-height: 1.5;
            margin-bottom: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            font-size: 0.9rem;
            color: #444;
            margin-bottom: 0.4rem;
            display: block;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #28B96C;
            outline: none;
        }

        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background-color: #28B96C;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #1f8f53;
        }

        .forgot-password {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .forgot-password a {
            color: #28B96C;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                padding: 2rem 1.5rem;
                max-width: 90%;
            }

            .login-container img {
                max-width: 100px;
                margin-bottom: 0.8rem;
            }

            .login-container h2 {
                font-size: 1.5rem;
            }

            .login-subtext {
                font-size: 0.9rem;
            }

            input,
            .btn-login {
                font-size: 0.95rem;
                padding: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem 1.2rem;
            }

            .login-container h2 {
                font-size: 1.3rem;
            }

            .login-subtext {
                font-size: 0.85rem;
            }

            .forgot-password {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('assets/img/logobbpsip.png') }}" alt="Logo BBPSIP" />
        <h2>Login</h2>
        <p class="login-subtext">
            Silakan isi data diri Anda untuk masuk ke<br />
            portal website SI-TERAP
        </p>

        <form action="{{ route('auth.login', ['previous_url' => $previous_url]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Masukkan email Anda"
                    required
                />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password"
                    required
                />
            </div>
            <button type="submit" class="btn-login">Login</button>
            <div class="forgot-password">
                <a href="#">Lupa Password?</a>
            </div>
        </form>
    </div>
</body>
</html>
