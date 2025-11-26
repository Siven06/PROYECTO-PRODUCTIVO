@extends('autenticacion.app')
@section('titulo', 'Sistema - Recuperar Password')
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

    .login-card {
        background: rgba(0, 0, 0, 0.45);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 215, 0, 0.4);
        border-radius: 15px;
        padding: 30px;
        max-width: 420px;
        margin: 100px auto;
        color: white;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
    }

    .login-title {
        font-size: 35px;
        font-weight: 700;
        color: #FFD700;
        letter-spacing: 2px;
        text-align: center;
        margin-bottom: 20px;
    }

    .login-box-msg {
        text-align: center;
        font-size: 16px;
        color: #f1f1f1;
        margin-bottom: 20px;
    }

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

    .input-group-text {
        background: rgba(0, 0, 0, 0.4);
        color: #FFD700;
        border: none;
    }

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

    a {
        color: #FFD700 !important;
    }
</style>
<div class="login-card">

    <h1 class="login-title"><b>JOYEROS</b>NTE</h1>

    <p class="login-box-msg">Ingrese su email para recuperar su password</p>

    {{-- Mensajes --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show mt-2">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('password.send-link') }}" method="POST">
        @csrf

        <div class="input-group mb-3">

            <div class="form-floating flex-grow-1">
                <input
                    id="loginEmail"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email"
                >
                <label for="loginEmail">Email</label>
            </div>

            <span class="input-group-text">
                <i class="bi bi-envelope"></i>
            </span>

        </div>

        @error('email')
            <div class="invalid-feedback d-block mb-3">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-gold w-100 py-2 mt-2">
            Enviar enlace de recuperación
        </button>

    </form>
</div>

@endsection