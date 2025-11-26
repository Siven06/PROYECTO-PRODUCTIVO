@extends('autenticacion.app')
@section('titulo', 'Sistema - Login')
@section('contenido')
    <style>
        body {
            background-image: url('{{ asset('/assets/img/imagen-header.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: "Poppins", sans-serif;
        }

        /* === CARD con efecto vidrio === */
        .login-card {
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 215, 0, 0.4);
            border-radius: 15px;
            padding: 30px;
            max-width: 400px;
            margin: 100px auto;
            color: white;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
        }

        /* Título */
        .login-title {
            font-size: 35px;
            font-weight: 700;
            color: #FFD700;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Inputs */
        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 215, 0, 0.3);
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #FFD700;
            box-shadow: 0 0 10px #ffd90080;
            color: white;
        }

        .form-floating label {
            color: #f1f1f1;
        }

        /* Iconos */
        .input-group-text {
            background: rgba(0, 0, 0, 0.4);
            color: #FFD700;
            border: none;
        }

        /* Botón */
        .btn-gold {
            background: linear-gradient(90deg, #D4AF37, #FFD700, #D4AF37);
            color: black;
            font-weight: bold;
            border: none;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .btn-gold:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.8);
        }

        .login-box-msg {
            text-align: center;
            font-size: 16px;
            color: #f1f1f1;
            margin-bottom: 20px;
        }

        a {
            color: #FFD700 !important;
        }
    </style>
    <div class="login-card">

        <h1 class="login-title"><b>JOYEROS</b>NTE</h1>

        <p class="login-box-msg">Ingrese sus datos</p>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (Session::has('mensaje'))
            <div class="alert alert-info alert-dismissible fade show mt-2">
                {{ Session::get('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <form action="{{route('login.post')}}" method="post">
            @csrf
        <div class="input-group mb-3 custom-group">

            <div class="form-floating flex-grow-1">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control custom-input"
                    id="loginEmail" placeholder="Email">
                <label for="loginEmail">Email</label>
            </div>

            <span class="input-group-text custom-icon">
                <i class="bi bi-envelope"></i>
            </span>

        </div>


        <div class="input-group mb-3 custom-group">

            <div class="form-floating flex-grow-1">
                <input type="password" name="password" class="form-control custom-input" id="loginPassword"
                    placeholder="Password">
                <label for="loginPassword">Password</label>
            </div>

            <span class="input-group-text custom-icon">
                <i class="bi bi-lock-fill"></i>
            </span>

        </div>

        <p class="text-center mb-3">
            <a href="{{ route('password.request') }}">Recuperar password</a>
        </p>

        <button type="submit" class="btn btn-gold w-100 py-2 btn-submit">Acceder</button>


        </form>
    </div>
@endsection
