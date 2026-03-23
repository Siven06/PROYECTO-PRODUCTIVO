<style>
  .jn-footer {
    background: #060402;
    border-top: 1px solid rgba(212,175,55,0.2);
    padding: 60px 0 0;
    font-family: 'Poppins', sans-serif;
  }

  /* ── Brand ── */
  .jn-footer-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    margin-bottom: 16px;
  }
  .jn-footer-gem {
    width: 34px; height: 34px;
    border: 1.5px solid rgba(212,175,55,0.5);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #D4AF37; font-size: 15px; flex-shrink: 0;
  }
  .jn-footer-brand-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px; font-weight: 600;
    color: #f5e8c0; letter-spacing: 1px;
    line-height: 1.1;
  }
  .jn-footer-brand-sub {
    font-size: 8px; letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.5);
  }
  .jn-footer-desc {
    font-size: 12px;
    color: rgba(245,232,192,0.35);
    line-height: 1.8;
    max-width: 260px;
    margin-bottom: 20px;
  }

  /* ── Redes sociales ── */
  .jn-socials {
    display: flex;
    gap: 8px;
  }
  .jn-social-btn {
    width: 34px; height: 34px;
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    color: rgba(245,232,192,0.4);
    font-size: 14px;
    text-decoration: none;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
  }
  .jn-social-btn:hover {
    background: rgba(212,175,55,0.12);
    border-color: rgba(212,175,55,0.5);
    color: #D4AF37;
  }

  /* ── Columnas ── */
  .jn-footer-col-title {
    font-size: 9px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #D4AF37;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .jn-footer-col-title::after {
    content: '';
    flex: 1; height: 1px;
    background: rgba(212,175,55,0.15);
  }

  .jn-footer-links {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .jn-footer-links a {
    font-size: 12px;
    color: rgba(245,232,192,0.4);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 7px;
    transition: color 0.15s, gap 0.15s;
  }
  .jn-footer-links a:hover {
    color: #D4AF37;
    gap: 10px;
  }
  .jn-footer-links a i {
    font-size: 10px;
    color: rgba(212,175,55,0.4);
    transition: color 0.15s;
  }
  .jn-footer-links a:hover i { color: #D4AF37; }

  /* ── Contacto ── */
  .jn-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 14px;
  }
  .jn-contact-icon {
    width: 28px; height: 28px;
    border-radius: 6px;
    background: rgba(212,175,55,0.08);
    border: 1px solid rgba(212,175,55,0.15);
    display: flex; align-items: center; justify-content: center;
    color: #D4AF37; font-size: 12px;
    flex-shrink: 0; margin-top: 1px;
  }
  .jn-contact-label {
    font-size: 10px;
    color: rgba(212,175,55,0.5);
    letter-spacing: 0.5px;
    margin-bottom: 2px;
  }
  .jn-contact-val {
    font-size: 12px;
    color: rgba(245,232,192,0.5);
    line-height: 1.4;
  }

  /* ── Divisor ── */
  .jn-footer-divider {
    border: none;
    border-top: 1px solid rgba(212,175,55,0.1);
    margin: 48px 0 0;
  }

  /* ── Barra inferior ── */
  .jn-footer-bottom {
    padding: 18px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
  }
  .jn-footer-copy {
    font-size: 11px;
    color: rgba(245,232,192,0.25);
    letter-spacing: 0.5px;
  }
  .jn-footer-copy span { color: rgba(212,175,55,0.5); }
  .jn-footer-legal {
    display: flex;
    gap: 20px;
  }
  .jn-footer-legal a {
    font-size: 11px;
    color: rgba(245,232,192,0.2);
    text-decoration: none;
    transition: color 0.15s;
  }
  .jn-footer-legal a:hover { color: rgba(212,175,55,0.6); }

  @media (max-width: 767px) {
    .jn-footer { padding: 40px 0 0; }
    .jn-footer-bottom { justify-content: center; text-align: center; }
    .jn-footer-legal { justify-content: center; }
    .jn-footer-desc { max-width: 100%; }
  }
</style>

<footer class="jn-footer">
  <div class="container">
    <div class="row g-5">

      {{-- ── Col 1: Brand ── --}}
      <div class="col-lg-4 col-md-6">
        <a href="{{ route('web.index') }}" class="jn-footer-brand">
          <div class="jn-footer-gem">
            <i class="bi bi-gem"></i>
          </div>
          <div>
            <div class="jn-footer-brand-name">Joyeros del Norte</div>
            <div class="jn-footer-brand-sub">Alta joyería</div>
          </div>
        </a>

        <p class="jn-footer-desc">
          Tradición joyera colombiana desde hace más de 15 años.
          Piezas únicas en oro, plata y piedras preciosas creadas con maestría artesanal.
        </p>

        <div class="jn-socials">
          <a href="#" class="jn-social-btn" title="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="#" class="jn-social-btn" title="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="#" class="jn-social-btn" title="WhatsApp">
            <i class="bi bi-whatsapp"></i>
          </a>
          <a href="#" class="jn-social-btn" title="TikTok">
            <i class="bi bi-tiktok"></i>
          </a>
        </div>
      </div>

      {{-- ── Col 2: Navegación ── --}}
      <div class="col-lg-2 col-md-6 col-6">
        <div class="jn-footer-col-title">Navegación</div>
        <ul class="jn-footer-links">
          <li>
            <a href="{{ route('web.index') }}">
              <i class="bi bi-chevron-right"></i> Inicio
            </a>
          </li>
          <li>
            <a href="{{ route('web.nosotros') }}">
              <i class="bi bi-chevron-right"></i> Nosotros
            </a>
          </li>
          <li>
            <a href="{{ route('web.index') }}#productos">
              <i class="bi bi-chevron-right"></i> Colección
            </a>
          </li>
          <li>
            <a href="{{ route('web.contacto') }}">
              <i class="bi bi-chevron-right"></i> Contacto
            </a>
          </li>
        </ul>
      </div>

      {{-- ── Col 3: Mi cuenta ── --}}
      <div class="col-lg-2 col-md-6 col-6">
        <div class="jn-footer-col-title">Mi cuenta</div>
        <ul class="jn-footer-links">
          @auth
          <li>
            <a href="{{ route('dashboard') }}">
              <i class="bi bi-chevron-right"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="{{ route('perfil.pedidos') }}">
              <i class="bi bi-chevron-right"></i> Mis pedidos
            </a>
          </li>
          <li>
            <a href="{{ route('perfil.edit') }}">
              <i class="bi bi-chevron-right"></i> Mi perfil
            </a>
          </li>
          <li>
            <a href="{{ route('carrito.mostrar') }}">
              <i class="bi bi-chevron-right"></i> Carrito
            </a>
          </li>
          @else
          <li>
            <a href="{{ route('login') }}">
              <i class="bi bi-chevron-right"></i> Iniciar sesión
            </a>
          </li>
          <li>
            <a href="{{ route('registro') }}">
              <i class="bi bi-chevron-right"></i> Registrarse
            </a>
          </li>
          <li>
            <a href="{{ route('carrito.mostrar') }}">
              <i class="bi bi-chevron-right"></i> Carrito
            </a>
          </li>
          @endauth
        </ul>
      </div>

      {{-- ── Col 4: Contacto ── --}}
      <div class="col-lg-4 col-md-6">
        <div class="jn-footer-col-title">Contacto</div>

        <div class="jn-contact-item">
          <div class="jn-contact-icon">
            <i class="bi bi-geo-alt"></i>
          </div>
          <div>
            <div class="jn-contact-label">Dirección</div>
            <div class="jn-contact-val">
              Cúcuta, Norte de Santander<br>Colombia
            </div>
          </div>
        </div>

        <div class="jn-contact-item">
          <div class="jn-contact-icon">
            <i class="bi bi-whatsapp"></i>
          </div>
          <div>
            <div class="jn-contact-label">WhatsApp</div>
            <div class="jn-contact-val">+57 300 000 0000</div>
          </div>
        </div>

        <div class="jn-contact-item">
          <div class="jn-contact-icon">
            <i class="bi bi-envelope"></i>
          </div>
          <div>
            <div class="jn-contact-label">Email</div>
            <div class="jn-contact-val">contacto@joyerosdelnorte.com</div>
          </div>
        </div>

        <div class="jn-contact-item">
          <div class="jn-contact-icon">
            <i class="bi bi-clock"></i>
          </div>
          <div>
            <div class="jn-contact-label">Horario</div>
            <div class="jn-contact-val">Lun – Sáb: 9:00am – 6:00pm</div>
          </div>
        </div>

      </div>
    </div>

    {{-- Divisor --}}
    <hr class="jn-footer-divider">

    {{-- Barra inferior --}}
    <div class="jn-footer-bottom">
      <div class="jn-footer-copy">
        &copy; {{ date('Y') }} <span>Joyeros del Norte</span> — Todos los derechos reservados.
        Hecho con <span style="color:rgba(212,175,55,0.6);">♦</span> en Colombia.
      </div>
      <div class="jn-footer-legal">
        <a href="#">Términos de uso</a>
        <a href="#">Política de privacidad</a>
      </div>
    </div>

  </div>
</footer>