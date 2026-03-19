@extends('plantilla.app')

@push('estilos')
<style>
  /* ── Layout ── */
  .jw-form-wrapper {
    max-width: 820px;
  }
  .jw-card {
    background: #fff;
    border: 0.5px solid rgba(0,0,0,0.07);
    border-radius: 14px;
    overflow: hidden;
  }
  .jw-card-header {
    padding: 18px 24px;
    border-bottom: 0.5px solid rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .jw-card-header-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: var(--dark-bg);
    border: 1px solid var(--gold-border);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 18px; flex-shrink: 0;
  }
  .jw-card-title {
    font-family: var(--font-display);
    font-size: 20px; font-weight: 500; color: #1a1a1a; margin: 0;
  }
  .jw-card-subtitle {
    font-size: 12px; color: #9ca3af; margin-top: 1px;
  }
  .jw-card-body   { padding: 28px 28px 20px; }
  .jw-card-footer {
    padding: 16px 28px;
    border-top: 0.5px solid rgba(0,0,0,0.06);
    background: #fafaf8;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  /* ── Secciones del formulario ── */
  .jw-form-section {
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 0.5px solid rgba(0,0,0,0.05);
  }
  .jw-form-section:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
  }
  .jw-section-label {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #9ca3af;
    font-weight: 500;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .jw-section-label::after {
    content: '';
    flex: 1;
    height: 0.5px;
    background: rgba(0,0,0,0.07);
  }

  /* ── Campos ── */
  .jw-field { margin-bottom: 0; }
  .jw-label {
    display: block;
    font-size: 12px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 6px;
    letter-spacing: 0.2px;
  }
  .jw-label .required {
    color: var(--gold);
    margin-left: 3px;
  }
  .jw-input,
  .jw-select {
    width: 100%;
    padding: 9px 14px;
    border: 0.5px solid rgba(0,0,0,0.14);
    border-radius: 8px;
    font-size: 13px;
    font-family: var(--font-body);
    color: #1a1a1a;
    background: #fff;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
    appearance: none;
  }
  .jw-input:focus,
  .jw-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
  }
  .jw-input.is-invalid,
  .jw-select.is-invalid {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
  }
  .jw-input::placeholder { color: #c0c0c0; }
  .jw-error {
    font-size: 11px;
    color: #ef4444;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .jw-hint {
    font-size: 11px;
    color: #9ca3af;
    margin-top: 4px;
  }

  /* Select con flecha personalizada */
  .jw-select-wrap { position: relative; }
  .jw-select-wrap::after {
    content: '';
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    width: 0; height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 5px solid #9ca3af;
    pointer-events: none;
  }
  .jw-select { padding-right: 32px; }

  /* Password toggle */
  .jw-input-wrap { position: relative; }
  .jw-input-wrap .jw-input { padding-right: 40px; }
  .jw-eye-btn {
    position: absolute;
    right: 10px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    color: #9ca3af; cursor: pointer;
    padding: 4px; font-size: 14px;
    transition: color 0.15s;
  }
  .jw-eye-btn:hover { color: var(--gold); }

  /* Indicador de fortaleza de contraseña */
  .jw-strength-wrap { margin-top: 8px; }
  .jw-strength-bars {
    display: flex; gap: 4px; margin-bottom: 4px;
  }
  .jw-strength-bar {
    flex: 1; height: 3px; border-radius: 2px;
    background: #f0f0f0; transition: background 0.25s;
  }
  .jw-strength-text { font-size: 11px; color: #9ca3af; }

  /* Avatar preview */
  .jw-avatar-preview {
    width: 52px; height: 52px; border-radius: 50%;
    background: var(--gold-dim);
    border: 1.5px solid var(--gold-border);
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display);
    font-size: 22px; color: var(--gold); font-weight: 600;
    flex-shrink: 0;
    transition: background 0.2s;
  }

  /* Botones */
  .jw-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 20px; border-radius: 8px; font-size: 13px;
    font-weight: 500; border: none; cursor: pointer;
    text-decoration: none; transition: all 0.15s;
    font-family: var(--font-body); line-height: 1;
  }
  .jw-btn:active { transform: scale(0.98); }
  .jw-btn-cancel {
    background: transparent; color: #6b7280;
    border: 0.5px solid rgba(0,0,0,0.15);
  }
  .jw-btn-cancel:hover { background: #f5f5f3; color: #374151; }
  .jw-btn-save {
    background: var(--dark-bg); color: var(--gold);
    border: 1px solid var(--gold-border);
  }
  .jw-btn-save:hover { background: var(--dark-surface); }

  /* Badge de edición */
  .jw-edit-pill {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(212,175,55,0.1); color: #92700a;
    border: 0.5px solid var(--gold-border);
    font-size: 11px; padding: 3px 10px; border-radius: 20px;
    margin-left: auto;
  }
</style>
@endpush

@section('contenido')
<div class="app-content">
  <div class="container-fluid py-3">
    <div class="jw-form-wrapper">
      <div class="jw-card">

        {{-- Header --}}
        <div class="jw-card-header">
          <div class="jw-card-header-icon">
            <i class="bi bi-person{{ isset($registro) ? '-gear' : '-plus' }}"></i>
          </div>
          <div>
            <h3 class="jw-card-title">
              {{ isset($registro) ? 'Editar usuario' : 'Nuevo usuario' }}
            </h3>
            <div class="jw-card-subtitle">
              {{ isset($registro) ? 'Modifica los datos del usuario' : 'Completa los datos para registrar un nuevo usuario' }}
            </div>
          </div>
          @isset($registro)
          <div class="jw-edit-pill" style="margin-left:auto;">
            <i class="bi bi-person-circle" style="font-size:11px;"></i>
            {{ $registro->name }}
          </div>
          @endisset
        </div>

        {{-- Formulario --}}
        <form action="{{ isset($registro) ? route('usuarios.update', $registro->id) : route('usuarios.store') }}"
              method="POST" id="formUsuario">
          @csrf
          @isset($registro)
            @method('PUT')
          @endisset

          <div class="jw-card-body">

            {{-- ── Sección 1: Información personal ── --}}
            <div class="jw-form-section">
              <div class="jw-section-label">
                <i class="bi bi-person" style="font-size:11px;color:var(--gold);"></i>
                Información personal
              </div>

              <div class="row g-3 align-items-start">

                {{-- Avatar preview --}}
                <div class="col-auto d-flex align-items-end pb-1">
                  <div class="jw-avatar-preview" id="avatarPreview">
                    {{ isset($registro) ? strtoupper(substr($registro->name, 0, 1)) : '?' }}
                  </div>
                </div>

                <div class="col">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="jw-field">
                        <label for="name" class="jw-label">
                          Nombre completo <span class="required">*</span>
                        </label>
                        <input type="text"
                               class="jw-input @error('name') is-invalid @enderror"
                               id="name" name="name"
                               value="{{ old('name', $registro->name ?? '') }}"
                               placeholder="Ej. María García"
                               required>
                        @error('name')
                          <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="jw-field">
                        <label for="email" class="jw-label">
                          Correo electrónico <span class="required">*</span>
                        </label>
                        <input type="email"
                               class="jw-input @error('email') is-invalid @enderror"
                               id="email" name="email"
                               value="{{ old('email', $registro->email ?? '') }}"
                               placeholder="correo@ejemplo.com"
                               required>
                        @error('email')
                          <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="jw-field">
                        <label for="activo" class="jw-label">Estado</label>
                        <div class="jw-select-wrap">
                          <select class="jw-select @error('activo') is-invalid @enderror"
                                  id="activo" name="activo">
                            <option value="1" {{ old('activo', $registro->activo ?? '1') == '1' ? 'selected' : '' }}>
                              Activo
                            </option>
                            <option value="0" {{ old('activo', $registro->activo ?? '1') == '0' ? 'selected' : '' }}>
                              Inactivo
                            </option>
                          </select>
                        </div>
                        @error('activo')
                          <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="jw-field">
                        <label for="role" class="jw-label">Rol asignado</label>
                        <div class="jw-select-wrap">
                          <select name="role" id="role" class="jw-select">
                            @foreach($roles as $role)
                              <option value="{{ $role->name }}"
                                {{ isset($registro) && $registro->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            {{-- ── Sección 2: Seguridad ── --}}
            <div class="jw-form-section">
              <div class="jw-section-label">
                <i class="bi bi-lock" style="font-size:11px;color:var(--gold);"></i>
                Seguridad
              </div>

              @isset($registro)
              <div class="alert mb-3"
                   style="background:rgba(212,175,55,0.08);border:0.5px solid var(--gold-border);border-radius:8px;font-size:12px;color:#92700a;padding:10px 14px;">
                <i class="bi bi-info-circle me-1"></i>
                Deja los campos de contraseña vacíos si no deseas cambiarla.
              </div>
              @endisset

              <div class="row g-3">
                <div class="col-md-6">
                  <div class="jw-field">
                    <label for="password" class="jw-label">
                      Contraseña
                      @unless(isset($registro))<span class="required">*</span>@endunless
                    </label>
                    <div class="jw-input-wrap">
                      <input type="password"
                             class="jw-input @error('password') is-invalid @enderror"
                             id="password" name="password"
                             placeholder="{{ isset($registro) ? 'Dejar vacío para mantener' : 'Mínimo 8 caracteres' }}">
                      <button type="button" class="jw-eye-btn" onclick="togglePass('password', this)">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    @error('password')
                      <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="jw-strength-wrap" id="strengthWrap" style="display:none;">
                      <div class="jw-strength-bars">
                        <div class="jw-strength-bar" id="sb1"></div>
                        <div class="jw-strength-bar" id="sb2"></div>
                        <div class="jw-strength-bar" id="sb3"></div>
                        <div class="jw-strength-bar" id="sb4"></div>
                      </div>
                      <div class="jw-strength-text" id="strengthText">—</div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="jw-field">
                    <label for="password_confirmation" class="jw-label">
                      Confirmar contraseña
                      @unless(isset($registro))<span class="required">*</span>@endunless
                    </label>
                    <div class="jw-input-wrap">
                      <input type="password"
                             class="jw-input @error('password_confirmation') is-invalid @enderror"
                             id="password_confirmation" name="password_confirmation"
                             placeholder="Repite la contraseña">
                      <button type="button" class="jw-eye-btn" onclick="togglePass('password_confirmation', this)">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    @error('password_confirmation')
                      <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div class="jw-hint" id="matchHint" style="display:none;"></div>
                  </div>
                </div>
              </div>
            </div>

          </div>{{-- /card-body --}}

          {{-- Footer --}}
          <div class="jw-card-footer">
            <button type="button" class="jw-btn jw-btn-cancel"
                    onclick="window.location.href='{{ route('usuarios.index') }}'">
              <i class="bi bi-x-lg"></i> Cancelar
            </button>
            <button type="submit" class="jw-btn jw-btn-save">
              <i class="bi bi-check-lg"></i>
              {{ isset($registro) ? 'Guardar cambios' : 'Crear usuario' }}
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('mnuSeguridad').classList.add('menu-open');
  document.getElementById('itemUsuario').classList.add('active');

  // ── Avatar preview en tiempo real ──
  const nameInput     = document.getElementById('name');
  const avatarPreview = document.getElementById('avatarPreview');
  nameInput.addEventListener('input', function () {
    const val = this.value.trim();
    avatarPreview.textContent = val ? val.charAt(0).toUpperCase() : '?';
  });

  // ── Toggle mostrar/ocultar contraseña ──
  function togglePass(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
      input.type   = 'text';
      icon.className = 'bi bi-eye-slash';
    } else {
      input.type   = 'password';
      icon.className = 'bi bi-eye';
    }
  }

  // ── Indicador de fortaleza ──
  const pwdInput      = document.getElementById('password');
  const strengthWrap  = document.getElementById('strengthWrap');
  const strengthText  = document.getElementById('strengthText');
  const bars          = [
    document.getElementById('sb1'),
    document.getElementById('sb2'),
    document.getElementById('sb3'),
    document.getElementById('sb4'),
  ];

  const levels = [
    { color: '#ef4444', label: 'Muy débil' },
    { color: '#f59e0b', label: 'Débil'     },
    { color: '#3b82f6', label: 'Aceptable' },
    { color: '#10b981', label: 'Fuerte'    },
  ];

  function scorePassword(pwd) {
    let score = 0;
    if (pwd.length >= 8)  score++;
    if (/[A-Z]/.test(pwd)) score++;
    if (/[0-9]/.test(pwd)) score++;
    if (/[^A-Za-z0-9]/.test(pwd)) score++;
    return score;
  }

  pwdInput.addEventListener('input', function () {
    const val = this.value;
    if (!val) {
      strengthWrap.style.display = 'none';
      bars.forEach(b => b.style.background = '#f0f0f0');
      return;
    }
    strengthWrap.style.display = 'block';
    const score = scorePassword(val);
    bars.forEach((b, i) => {
      b.style.background = i < score ? levels[score - 1].color : '#f0f0f0';
    });
    strengthText.textContent  = levels[score - 1]?.label ?? '—';
    strengthText.style.color  = levels[score - 1]?.color ?? '#9ca3af';
  });

  // ── Validación de coincidencia de contraseña ──
  const confirmInput = document.getElementById('password_confirmation');
  const matchHint    = document.getElementById('matchHint');

  confirmInput.addEventListener('input', function () {
    if (!this.value) { matchHint.style.display = 'none'; return; }
    matchHint.style.display = 'block';
    if (this.value === pwdInput.value) {
      matchHint.innerHTML = '<i class="bi bi-check-circle" style="color:#10b981;"></i> <span style="color:#10b981;">Las contraseñas coinciden</span>';
    } else {
      matchHint.innerHTML = '<i class="bi bi-x-circle" style="color:#ef4444;"></i> <span style="color:#ef4444;">Las contraseñas no coinciden</span>';
    }
  });
</script>
@endpush