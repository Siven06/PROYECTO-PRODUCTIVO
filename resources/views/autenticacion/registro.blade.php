@extends('autenticacion.app')
@section('titulo', 'Joyeros del Norte - Registro')
@section('contenido')
<style>
  body {
    background-image: url('{{ asset("/assets/img/imagen-header.jpg") }}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: "Poppins", sans-serif;
  }

  /* ── Card ── */
  .reg-card {
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255,215,0,0.35);
    border-radius: 16px;
    padding: 36px 32px;
    max-width: 480px;
    margin: 60px auto;
    color: white;
    box-shadow: 0 0 40px rgba(0,0,0,0.5);
  }

  /* ── Header ── */
  .reg-brand {
    text-align: center;
    margin-bottom: 6px;
  }
  .reg-brand-gem {
    width: 44px; height: 44px;
    border: 1.5px solid rgba(212,175,55,0.6);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #D4AF37; font-size: 20px;
    margin: 0 auto 10px;
  }
  .reg-title {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 28px; font-weight: 600;
    color: #FFD700; letter-spacing: 2px;
    text-align: center; margin-bottom: 4px;
  }
  .reg-subtitle {
    text-align: center;
    font-size: 12px;
    color: rgba(245,232,192,0.45);
    letter-spacing: 1px;
    margin-bottom: 24px;
  }

  /* ── Divisor sección ── */
  .reg-section-label {
    font-size: 9px;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.5);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .reg-section-label::after {
    content: '';
    flex: 1; height: 1px;
    background: rgba(212,175,55,0.15);
  }

  /* ── Inputs ── */
  .reg-group {
    margin-bottom: 14px;
  }
  .reg-input-wrap {
    display: flex;
    align-items: stretch;
    border: 1px solid rgba(255,215,0,0.25);
    border-radius: 8px;
    overflow: hidden;
    transition: border-color 0.15s, box-shadow 0.15s;
  }
  .reg-input-wrap:focus-within {
    border-color: #FFD700;
    box-shadow: 0 0 14px rgba(255,215,0,0.2);
  }
  .reg-input-wrap.is-invalid { border-color: #ef4444; }

  .reg-input-wrap .form-floating { flex: 1; }
  .reg-input-wrap .form-control {
    background: rgba(255,255,255,0.08) !important;
    border: none !important;
    color: white !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    height: 52px;
    font-size: 13px;
  }
  .reg-input-wrap .form-control:focus {
    background: rgba(255,255,255,0.14) !important;
    box-shadow: none !important;
  }
  .reg-input-wrap .form-control::placeholder { color: transparent; }
  .reg-input-wrap .form-floating label {
    color: rgba(245,232,192,0.5);
    font-size: 13px;
    padding-top: 14px;
  }

  .reg-icon {
    background: rgba(0,0,0,0.3);
    border-left: 1px solid rgba(255,215,0,0.15);
    display: flex; align-items: center; justify-content: center;
    padding: 0 14px;
    color: rgba(212,175,55,0.6);
    font-size: 14px;
    flex-shrink: 0;
  }

  .reg-error {
    font-size: 11px;
    color: #f87171;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
    padding-left: 4px;
  }

  /* ── Toggle password ── */
  .reg-eye {
    background: rgba(0,0,0,0.3);
    border: none;
    border-left: 1px solid rgba(255,215,0,0.15);
    color: rgba(212,175,55,0.5);
    padding: 0 12px;
    cursor: pointer;
    font-size: 14px;
    transition: color 0.15s;
    flex-shrink: 0;
  }
  .reg-eye:hover { color: #FFD700; }

  /* ── Indicador de fortaleza ── */
  .reg-strength { margin-top: 8px; padding-left: 2px; }
  .reg-strength-bars { display: flex; gap: 4px; margin-bottom: 4px; }
  .reg-strength-bar {
    flex: 1; height: 3px; border-radius: 2px;
    background: rgba(255,255,255,0.1);
    transition: background 0.25s;
  }
  .reg-strength-text { font-size: 10px; color: rgba(245,232,192,0.4); }

  /* ── Botón ── */
  .reg-btn {
    width: 100%;
    background: linear-gradient(90deg, #D4AF37, #FFD700, #D4AF37);
    color: #0a0804;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    border: none;
    border-radius: 8px;
    padding: 13px;
    cursor: pointer;
    transition: box-shadow 0.2s, transform 0.15s;
    margin-top: 8px;
    font-family: 'Poppins', sans-serif;
  }
  .reg-btn:hover {
    box-shadow: 0 0 20px rgba(255,215,0,0.45);
    transform: translateY(-1px);
  }
  .reg-btn:active { transform: scale(0.99); }

  /* ── Footer links ── */
  .reg-footer-links {
    text-align: center;
    margin-top: 20px;
    font-size: 12px;
    color: rgba(245,232,192,0.4);
  }
  .reg-footer-links a {
    color: #FFD700 !important;
    text-decoration: none;
    transition: opacity 0.15s;
  }
  .reg-footer-links a:hover { opacity: 0.75; }

  /* ── Alerta ── */
  .reg-alert {
    background: rgba(220,53,69,0.2);
    border: 1px solid rgba(220,53,69,0.35);
    border-radius: 8px;
    color: #fca5a5;
    font-size: 12px;
    padding: 10px 14px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
</style>

<div class="reg-card">

  {{-- Brand --}}
  <div class="reg-brand">
    <div class="reg-brand-gem">
      <i class="bi bi-gem"></i>
    </div>
  </div>
  <h1 class="reg-title"><b>JOYEROS</b> DEL NORTE</h1>
  <p class="reg-subtitle">Crea tu cuenta</p>

  {{-- Error general --}}
  @if(session('error'))
  <div class="reg-alert">
    <i class="bi bi-exclamation-circle"></i>
    {{ session('error') }}
  </div>
  @endif

  <form action="{{ route('registro.store') }}" method="POST">
    @csrf

    {{-- ── Sección: Datos personales ── --}}
    <div class="reg-section-label">
      <i class="bi bi-person" style="font-size:9px;color:#D4AF37;"></i>
      Datos personales
    </div>

    {{-- Nombre --}}
    <div class="reg-group">
      <div class="reg-input-wrap @error('name') is-invalid @enderror">
        <div class="form-floating">
          <input type="text"
                 id="name" name="name"
                 class="form-control"
                 value="{{ old('name') }}"
                 placeholder="Nombre completo">
          <label for="name">Nombre completo</label>
        </div>
        <span class="reg-icon"><i class="bi bi-person"></i></span>
      </div>
      @error('name')
        <div class="reg-error">
          <i class="bi bi-exclamation-circle"></i> {{ $message }}
        </div>
      @enderror
    </div>

    {{-- Email --}}
    <div class="reg-group">
      <div class="reg-input-wrap @error('email') is-invalid @enderror">
        <div class="form-floating">
          <input type="email"
                 id="email" name="email"
                 class="form-control"
                 value="{{ old('email') }}"
                 placeholder="Correo electrónico">
          <label for="email">Correo electrónico</label>
        </div>
        <span class="reg-icon"><i class="bi bi-envelope"></i></span>
      </div>
      @error('email')
        <div class="reg-error">
          <i class="bi bi-exclamation-circle"></i> {{ $message }}
        </div>
      @enderror
    </div>

    {{-- ── Sección: Seguridad ── --}}
    <div class="reg-section-label" style="margin-top:20px;">
      <i class="bi bi-lock" style="font-size:9px;color:#D4AF37;"></i>
      Seguridad
    </div>

    {{-- Contraseña --}}
    <div class="reg-group">
      <div class="reg-input-wrap @error('password') is-invalid @enderror">
        <div class="form-floating">
          <input type="password"
                 id="password" name="password"
                 class="form-control"
                 placeholder="Contraseña">
          <label for="password">Contraseña</label>
        </div>
        <button type="button" class="reg-eye" onclick="togglePass('password', this)">
          <i class="bi bi-eye"></i>
        </button>
      </div>
      @error('password')
        <div class="reg-error">
          <i class="bi bi-exclamation-circle"></i> {{ $message }}
        </div>
      @enderror
      {{-- Indicador de fortaleza --}}
      <div class="reg-strength" id="strengthWrap" style="display:none;">
        <div class="reg-strength-bars">
          <div class="reg-strength-bar" id="sb1"></div>
          <div class="reg-strength-bar" id="sb2"></div>
          <div class="reg-strength-bar" id="sb3"></div>
          <div class="reg-strength-bar" id="sb4"></div>
        </div>
        <div class="reg-strength-text" id="strengthText">—</div>
      </div>
    </div>

    {{-- Confirmar contraseña --}}
    <div class="reg-group">
      <div class="reg-input-wrap @error('password_confirmation') is-invalid @enderror">
        <div class="form-floating">
          <input type="password"
                 id="password_confirmation"
                 name="password_confirmation"
                 class="form-control"
                 placeholder="Confirmar contraseña">
          <label for="password_confirmation">Confirmar contraseña</label>
        </div>
        <button type="button" class="reg-eye" onclick="togglePass('password_confirmation', this)">
          <i class="bi bi-eye"></i>
        </button>
      </div>
      @error('password_confirmation')
        <div class="reg-error">
          <i class="bi bi-exclamation-circle"></i> {{ $message }}
        </div>
      @enderror
      <div class="reg-error" id="matchHint" style="display:none;"></div>
    </div>

    {{-- Submit --}}
    <button type="submit" class="reg-btn">
      <i class="bi bi-gem me-2"></i> Crear cuenta
    </button>

  </form>

  {{-- Links --}}
  <div class="reg-footer-links">
    ¿Ya tienes cuenta?
    <a href="{{ route('login') }}">Inicia sesión aquí</a>
  </div>

</div>

<script>
  // ── Toggle password ──
  function togglePass(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
      input.type     = 'text';
      icon.className = 'bi bi-eye-slash';
    } else {
      input.type     = 'password';
      icon.className = 'bi bi-eye';
    }
  }

  // ── Fortaleza de contraseña ──
  const pwdInput     = document.getElementById('password');
  const strengthWrap = document.getElementById('strengthWrap');
  const strengthText = document.getElementById('strengthText');
  const bars = [
    document.getElementById('sb1'),
    document.getElementById('sb2'),
    document.getElementById('sb3'),
    document.getElementById('sb4'),
  ];
  const levels = [
    { color: '#ef4444', label: 'Muy débil'  },
    { color: '#f59e0b', label: 'Débil'      },
    { color: '#3b82f6', label: 'Aceptable'  },
    { color: '#10b981', label: 'Fuerte'     },
  ];

  function scorePassword(pwd) {
    let score = 0;
    if (pwd.length >= 8)           score++;
    if (/[A-Z]/.test(pwd))         score++;
    if (/[0-9]/.test(pwd))         score++;
    if (/[^A-Za-z0-9]/.test(pwd))  score++;
    return score;
  }

  pwdInput.addEventListener('input', function () {
    if (!this.value) {
      strengthWrap.style.display = 'none';
      bars.forEach(b => b.style.background = 'rgba(255,255,255,0.1)');
      return;
    }
    strengthWrap.style.display = 'block';
    const score = scorePassword(this.value);
    bars.forEach((b, i) => {
      b.style.background = i < score
        ? levels[score - 1].color
        : 'rgba(255,255,255,0.1)';
    });
    strengthText.textContent = levels[score - 1]?.label ?? '—';
    strengthText.style.color = levels[score - 1]?.color ?? 'rgba(245,232,192,0.4)';
  });

  // ── Coincidencia de contraseñas ──
  const confirmInput = document.getElementById('password_confirmation');
  const matchHint    = document.getElementById('matchHint');

  confirmInput.addEventListener('input', function () {
    if (!this.value) { matchHint.style.display = 'none'; return; }
    matchHint.style.display = 'flex';
    if (this.value === pwdInput.value) {
      matchHint.innerHTML = '<i class="bi bi-check-circle" style="color:#10b981;"></i> <span style="color:#10b981;">Las contraseñas coinciden</span>';
    } else {
      matchHint.innerHTML = '<i class="bi bi-x-circle" style="color:#ef4444;"></i> <span style="color:#ef4444;">Las contraseñas no coinciden</span>';
    }
  });
</script>

@endsection