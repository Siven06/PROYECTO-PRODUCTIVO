@extends('web.app')

@section('titulo', 'Contacto — Joyeros del Norte')

@section('contenido')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:wght@300;400;500&display=swap');

  body {
    background: #0a0804;
    font-family: 'Poppins', sans-serif;
    color: #f5e8c0;
  }

  /* ══ PAGE HERO ══ */
  .jn-page-hero {
    position: relative;
    padding: 100px 0 80px;
    overflow: hidden;
    background: #0a0804;
    border-bottom: 1px solid rgba(212,175,55,0.12);
  }
  .jn-page-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 60% 50%, rgba(212,175,55,0.07) 0%, transparent 70%);
    pointer-events: none;
  }
  .jn-page-hero-line {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(to bottom, transparent, rgba(212,175,55,0.8) 30%, rgba(212,175,55,0.8) 70%, transparent);
  }
  .jn-page-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 10px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.7);
    margin-bottom: 18px;
  }
  .jn-page-eyebrow::before,
  .jn-page-eyebrow::after {
    content: '';
    width: 28px; height: 1px;
    background: rgba(212,175,55,0.4);
  }
  .jn-page-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(40px, 6vw, 68px);
    font-weight: 500;
    line-height: 1.1;
    color: #f5e8c0;
    margin-bottom: 18px;
  }
  .jn-page-title em { font-style: italic; color: #D4AF37; }
  .jn-page-lead {
    font-size: 14px;
    color: rgba(245,232,192,0.5);
    max-width: 500px;
    line-height: 1.8;
    font-weight: 300;
  }

  /* ══ CONTACT SECTION ══ */
  .jn-contact-section {
    padding: 80px 0 100px;
  }

  /* ── Info cards ── */
  .jn-info-card {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(212,175,55,0.15);
    border-radius: 10px;
    padding: 22px 20px;
    margin-bottom: 16px;
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  .jn-info-card:hover {
    border-color: rgba(212,175,55,0.4);
    box-shadow: 0 8px 30px rgba(0,0,0,0.35);
  }
  .jn-info-icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    background: rgba(212,175,55,0.1);
    border: 1px solid rgba(212,175,55,0.2);
    display: flex; align-items: center; justify-content: center;
    color: #D4AF37; font-size: 18px;
    flex-shrink: 0;
  }
  .jn-info-label {
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.55);
    margin-bottom: 4px;
  }
  .jn-info-value {
    font-size: 14px;
    color: rgba(245,232,192,0.75);
    line-height: 1.5;
    font-weight: 300;
  }
  .jn-info-value a {
    color: rgba(245,232,192,0.75);
    text-decoration: none;
    transition: color 0.15s;
  }
  .jn-info-value a:hover { color: #D4AF37; }

  /* ── Social row ── */
  .jn-socials {
    display: flex; gap: 10px; margin-top: 28px;
  }
  .jn-social-btn {
    width: 42px; height: 42px;
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: rgba(245,232,192,0.4); font-size: 16px;
    text-decoration: none;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
  }
  .jn-social-btn:hover {
    background: rgba(212,175,55,0.12);
    border-color: rgba(212,175,55,0.5);
    color: #D4AF37;
  }

  /* ── Divider ── */
  .jn-col-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    font-weight: 500;
    color: #f5e8c0;
    margin-bottom: 8px;
  }
  .jn-col-subtitle {
    font-size: 13px;
    color: rgba(245,232,192,0.4);
    font-weight: 300;
    margin-bottom: 32px;
    line-height: 1.7;
  }

  /* ── Form ── */
  .jn-form {
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(212,175,55,0.15);
    border-radius: 12px;
    padding: 36px 32px;
  }
  .jn-form-group {
    margin-bottom: 20px;
  }
  .jn-form-label {
    display: block;
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.6);
    margin-bottom: 8px;
  }
  .jn-form-control {
    width: 100%;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 6px;
    padding: 12px 16px;
    font-size: 13px;
    color: #f5e8c0;
    font-family: 'Poppins', sans-serif;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
  }
  .jn-form-control::placeholder { color: rgba(245,232,192,0.25); }
  .jn-form-control:focus {
    border-color: rgba(212,175,55,0.6);
    box-shadow: 0 0 16px rgba(212,175,55,0.12);
  }
  textarea.jn-form-control { resize: vertical; min-height: 130px; }
  select.jn-form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23D4AF37' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    cursor: pointer;
  }
  select.jn-form-control option { background: #141008; color: #f5e8c0; }

  .jn-btn-submit {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: #D4AF37;
    color: #0a0804;
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 600;
    padding: 15px 28px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: box-shadow 0.2s, transform 0.15s, background 0.15s;
    font-family: 'Poppins', sans-serif;
    margin-top: 8px;
  }
  .jn-btn-submit:hover {
    background: #f0d875;
    box-shadow: 0 0 28px rgba(212,175,55,0.45);
    transform: translateY(-2px);
  }

  /* ── Alert ── */
  .jn-alert {
    border-radius: 8px;
    padding: 14px 18px;
    font-size: 13px;
    margin-bottom: 20px;
    display: none;
  }
  .jn-alert.success {
    background: rgba(212,175,55,0.1);
    border: 1px solid rgba(212,175,55,0.35);
    color: #D4AF37;
  }
  .jn-alert.error {
    background: rgba(200,60,60,0.12);
    border: 1px solid rgba(200,60,60,0.35);
    color: #e88;
  }

  /* ── Map placeholder ── */
  .jn-map {
    background: linear-gradient(135deg, #1a1408, #12100a);
    border: 1px solid rgba(212,175,55,0.15);
    border-radius: 10px;
    aspect-ratio: 16/9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: rgba(212,175,55,0.3);
    margin-top: 40px;
  }
  .jn-map i { font-size: 40px; }
  .jn-map p { font-size: 12px; letter-spacing: 2px; text-transform: uppercase; margin: 0; }

  @media (max-width: 767px) {
    .jn-form { padding: 24px 18px; }
  }
</style>

{{-- ══ PAGE HERO ══ --}}
<section class="jn-page-hero">
  <div class="jn-page-hero-line"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="jn-page-eyebrow">
          <i class="bi bi-envelope" style="font-size:11px;"></i>
          Hablemos
        </div>
        <h1 class="jn-page-title">
          Estamos aquí para <em>ayudarte</em>
        </h1>
        <p class="jn-page-lead">
          ¿Tienes preguntas sobre nuestras piezas, quieres encargar una joya personalizada o simplemente
          deseas conocer más sobre nuestra historia? Escríbenos, con mucho gusto te atendemos.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ══ CONTACT ══ --}}
<section class="jn-contact-section">
  <div class="container">
    <div class="row g-5">

      {{-- Left: Info --}}
      <div class="col-lg-4">
        <h2 class="jn-col-title">Información de <em style="font-style:italic;color:#D4AF37;">contacto</em></h2>
        <p class="jn-col-subtitle">
          Visítanos, llámanos o escríbenos.<br>
          Respondemos en menos de 24 horas.
        </p>

        <div class="jn-info-card">
          <div class="jn-info-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div>
            <div class="jn-info-label">Dirección</div>
            <div class="jn-info-value">
              Cúcuta, Norte de Santander<br>Colombia
            </div>
          </div>
        </div>

        <div class="jn-info-card">
          <div class="jn-info-icon"><i class="bi bi-whatsapp"></i></div>
          <div>
            <div class="jn-info-label">WhatsApp</div>
            <div class="jn-info-value">
              <a href="https://wa.me/573000000000" target="_blank">+57 300 000 0000</a>
            </div>
          </div>
        </div>

        <div class="jn-info-card">
          <div class="jn-info-icon"><i class="bi bi-envelope-fill"></i></div>
          <div>
            <div class="jn-info-label">Email</div>
            <div class="jn-info-value">
              <a href="mailto:contacto@joyerosdelnorte.com">contacto@joyerosdelnorte.com</a>
            </div>
          </div>
        </div>

        <div class="jn-info-card">
          <div class="jn-info-icon"><i class="bi bi-clock-fill"></i></div>
          <div>
            <div class="jn-info-label">Horario de atención</div>
            <div class="jn-info-value">
              Lun – Vie: 9:00am – 6:00pm<br>
              Sábado: 9:00am – 2:00pm
            </div>
          </div>
        </div>

        <div class="jn-socials">
          <a href="#" class="jn-social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="jn-social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="jn-social-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          <a href="#" class="jn-social-btn" title="TikTok"><i class="bi bi-tiktok"></i></a>
        </div>

        {{-- Map placeholder --}}
        <div class="jn-map">
          <i class="bi bi-map"></i>
          <p>Cúcuta, Colombia</p>
        </div>
      </div>

      {{-- Right: Form --}}
      <div class="col-lg-7 offset-lg-1">
        <h2 class="jn-col-title">Envíanos un <em style="font-style:italic;color:#D4AF37;">mensaje</em></h2>
        <p class="jn-col-subtitle">
          Cuéntanos qué tienes en mente. Nuestro equipo revisará tu mensaje y se pondrá
          en contacto contigo a la brevedad posible.
        </p>

        {{-- Success / Error alerts (Blade) --}}
        @if(session('success'))
          <div class="jn-alert success" style="display:block;">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          </div>
        @endif
        @if($errors->any())
          <div class="jn-alert error" style="display:block;">
            <i class="bi bi-exclamation-circle me-2"></i>
            @foreach($errors->all() as $error)
              {{ $error }}<br>
            @endforeach
          </div>
        @endif

        <form class="jn-form" method="POST" action="{{ route('web.contacto.enviar') }}">
          @csrf

          <div class="row g-3">
            <div class="col-sm-6">
              <div class="jn-form-group">
                <label class="jn-form-label" for="nombre">Nombre completo</label>
                <input id="nombre" type="text" name="nombre" class="jn-form-control"
                       placeholder="Tu nombre" value="{{ old('nombre') }}" required>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="jn-form-group">
                <label class="jn-form-label" for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" class="jn-form-control"
                       placeholder="tu@email.com" value="{{ old('email') }}" required>
              </div>
            </div>
          </div>

          <div class="jn-form-group">
            <label class="jn-form-label" for="telefono">Teléfono (opcional)</label>
            <input id="telefono" type="tel" name="telefono" class="jn-form-control"
                   placeholder="+57 300 000 0000" value="{{ old('telefono') }}">
          </div>

          <div class="jn-form-group">
            <label class="jn-form-label" for="asunto">Asunto</label>
            <select id="asunto" name="asunto" class="jn-form-control" required>
              <option value="" disabled {{ old('asunto') ? '' : 'selected' }}>Selecciona un motivo…</option>
              <option value="informacion" {{ old('asunto') == 'informacion' ? 'selected' : '' }}>Información sobre productos</option>
              <option value="personalizado" {{ old('asunto') == 'personalizado' ? 'selected' : '' }}>Joya personalizada</option>
              <option value="pedido" {{ old('asunto') == 'pedido' ? 'selected' : '' }}>Estado de un pedido</option>
              <option value="garantia" {{ old('asunto') == 'garantia' ? 'selected' : '' }}>Garantía o reparación</option>
              <option value="otro" {{ old('asunto') == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
          </div>

          <div class="jn-form-group">
            <label class="jn-form-label" for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" class="jn-form-control"
                      placeholder="Cuéntanos en qué podemos ayudarte…" required>{{ old('mensaje') }}</textarea>
          </div>

          <button type="submit" class="jn-btn-submit">
            <i class="bi bi-send"></i>
            Enviar mensaje
          </button>
        </form>
      </div>

    </div>
  </div>
</section>
@endsection
