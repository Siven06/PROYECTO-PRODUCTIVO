@extends('web.app')

@section('titulo', 'Nosotros — Joyeros del Norte')

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

  /* ══ SECTIONS COMMON ══ */
  .jn-section {
    padding: 80px 0;
    border-bottom: 1px solid rgba(212,175,55,0.08);
  }
  .jn-section-eyebrow {
    font-size: 10px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #D4AF37;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .jn-section-eyebrow::before {
    content: '';
    width: 22px; height: 1px;
    background: rgba(212,175,55,0.5);
  }
  .jn-section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(26px, 4vw, 40px);
    font-weight: 500;
    color: #f5e8c0;
    line-height: 1.15;
    margin-bottom: 20px;
  }
  .jn-section-title em { font-style: italic; color: #D4AF37; }
  .jn-section-text {
    font-size: 14px;
    color: rgba(245,232,192,0.5);
    line-height: 1.9;
    font-weight: 300;
  }

  /* ══ HISTORIA ══ */
  .jn-history-img {
    background: linear-gradient(135deg, #1a1408, #2a1f08);
    border: 1px solid rgba(212,175,55,0.22);
    border-radius: 4px;
    aspect-ratio: 4/5;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }
  .jn-history-img::after {
    content: '';
    position: absolute;
    top: -14px; right: -14px;
    width: 100%; height: 100%;
    border: 1px solid rgba(212,175,55,0.15);
    border-radius: 4px;
    pointer-events: none;
  }
  .jn-history-img i {
    font-size: 80px;
    color: rgba(212,175,55,0.15);
  }

  /* ══ VALORES ══ */
  .jn-valores-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 40px;
  }
  .jn-valor-card {
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(212,175,55,0.15);
    border-radius: 10px;
    padding: 28px 24px;
    transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
  }
  .jn-valor-card:hover {
    border-color: rgba(212,175,55,0.45);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4), 0 0 20px rgba(212,175,55,0.08);
    transform: translateY(-4px);
  }
  .jn-valor-icon {
    width: 48px; height: 48px;
    border-radius: 10px;
    background: rgba(212,175,55,0.1);
    border: 1px solid rgba(212,175,55,0.2);
    display: flex; align-items: center; justify-content: center;
    color: #D4AF37; font-size: 20px;
    margin-bottom: 16px;
  }
  .jn-valor-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    color: #f5e8c0;
    margin-bottom: 8px;
    font-weight: 500;
  }
  .jn-valor-text {
    font-size: 12px;
    color: rgba(245,232,192,0.4);
    line-height: 1.8;
    font-weight: 300;
  }

  /* ══ EQUIPO ══ */
  .jn-team-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 40px;
  }
  .jn-team-card {
    text-align: center;
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(212,175,55,0.15);
    border-radius: 10px;
    overflow: hidden;
    transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
  }
  .jn-team-card:hover {
    border-color: rgba(212,175,55,0.45);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
    transform: translateY(-4px);
  }
  .jn-team-avatar {
    aspect-ratio: 1/1;
    background: linear-gradient(135deg, #1a1408, #2a1f08);
    display: flex; align-items: center; justify-content: center;
    border-bottom: 1px solid rgba(212,175,55,0.15);
  }
  .jn-team-avatar i {
    font-size: 56px;
    color: rgba(212,175,55,0.2);
  }
  .jn-team-info {
    padding: 20px 16px;
  }
  .jn-team-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    color: #f5e8c0;
    margin-bottom: 4px;
    font-weight: 500;
  }
  .jn-team-role {
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.55);
  }

  /* ══ STATS ══ */
  .jn-stats-section {
    padding: 70px 0;
    background: rgba(212,175,55,0.03);
    border-top: 1px solid rgba(212,175,55,0.1);
    border-bottom: 1px solid rgba(212,175,55,0.1);
  }
  .jn-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    text-align: center;
  }
  .jn-stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 52px;
    color: #D4AF37;
    font-weight: 500;
    line-height: 1;
    margin-bottom: 8px;
  }
  .jn-stat-label {
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(245,232,192,0.35);
  }
  .jn-stat-divider {
    width: 1px;
    background: rgba(212,175,55,0.15);
    height: 60px;
    margin: auto;
  }

  /* ══ CTA ══ */
  .jn-cta-section {
    padding: 90px 0;
    text-align: center;
  }
  .jn-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: #D4AF37;
    color: #0a0804;
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 600;
    padding: 14px 32px;
    border-radius: 4px;
    text-decoration: none;
    transition: box-shadow 0.2s, transform 0.15s, background 0.15s;
  }
  .jn-btn-primary:hover {
    background: #f0d875;
    box-shadow: 0 0 28px rgba(212,175,55,0.45);
    transform: translateY(-2px);
    color: #0a0804;
  }
  .jn-btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(245,232,192,0.6);
    text-decoration: none;
    padding: 14px 24px;
    border: 1px solid rgba(212,175,55,0.3);
    border-radius: 4px;
    transition: color 0.15s, border-color 0.15s;
  }
  .jn-btn-ghost:hover {
    color: #D4AF37;
    border-color: #D4AF37;
  }

  @media (max-width: 991px) {
    .jn-valores-grid { grid-template-columns: repeat(2, 1fr); }
    .jn-team-grid { grid-template-columns: repeat(2, 1fr); }
    .jn-stats-grid { grid-template-columns: repeat(2, 1fr); }
    .jn-stat-divider { display: none; }
  }
  @media (max-width: 576px) {
    .jn-valores-grid { grid-template-columns: 1fr; }
    .jn-team-grid { grid-template-columns: 1fr; }
    .jn-stats-grid { grid-template-columns: repeat(2, 1fr); }
  }
</style>

{{-- ══ PAGE HERO ══ --}}
<section class="jn-page-hero">
  <div class="jn-page-hero-line"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="jn-page-eyebrow">
          <i class="bi bi-gem" style="font-size:11px;"></i>
          Nuestra historia
        </div>
        <h1 class="jn-page-title">
          Artesanos de la <em>belleza</em><br>colombiana
        </h1>
        <p class="jn-page-lead">
          Somos una casa de joyería fundada con la pasión de crear piezas únicas que trascienden el tiempo.
          Cada joya que sale de nuestro taller lleva consigo décadas de tradición y maestría artesanal.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ══ HISTORIA ══ --}}
<section class="jn-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <div class="jn-history-img">
          <i class="bi bi-gem"></i>
        </div>
      </div>
      <div class="col-lg-6 offset-lg-1">
        <div class="jn-section-eyebrow">Nuestra historia</div>
        <h2 class="jn-section-title">Más de 15 años creando <em>memorias eternas</em></h2>
        <p class="jn-section-text mb-4">
          Joyeros del Norte nació en Cúcuta, Norte de Santander, como un pequeño taller familiar con un único propósito:
          crear piezas de joyería que cuenten historias y perduren generaciones.
        </p>
        <p class="jn-section-text mb-4">
          Hoy, con más de 15 años de experiencia, nos hemos convertido en referencia de la alta joyería colombiana.
          Trabajamos con oro de 18 y 24 quilates, plata de ley, y piedras preciosas seleccionadas cuidadosamente
          de las mejores fuentes del país.
        </p>
        <p class="jn-section-text">
          Cada pieza es elaborada a mano por nuestros maestros joyeros, quienes combinan técnicas artesanales
          tradicionales con diseños contemporáneos para ofrecer creaciones verdaderamente únicas.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ══ STATS ══ --}}
<div class="jn-stats-section">
  <div class="container">
    <div class="jn-stats-grid">
      <div>
        <div class="jn-stat-num">+15</div>
        <div class="jn-stat-label">Años de tradición</div>
      </div>
      <div>
        <div class="jn-stat-num">+200</div>
        <div class="jn-stat-label">Piezas únicas</div>
      </div>
      <div>
        <div class="jn-stat-num">500+</div>
        <div class="jn-stat-label">Clientes felices</div>
      </div>
      <div>
        <div class="jn-stat-num">18k</div>
        <div class="jn-stat-label">Oro de calidad</div>
      </div>
    </div>
  </div>
</div>

{{-- ══ VALORES ══ --}}
<section class="jn-section">
  <div class="container">
    <div class="text-center mb-2">
      <div class="jn-section-eyebrow" style="justify-content:center;">
        <i class="bi bi-stars" style="font-size:10px;"></i>
        Lo que nos define
      </div>
      <h2 class="jn-section-title">Nuestros <em>valores</em></h2>
    </div>
    <div class="jn-valores-grid">
      <div class="jn-valor-card">
        <div class="jn-valor-icon"><i class="bi bi-gem"></i></div>
        <div class="jn-valor-title">Autenticidad</div>
        <p class="jn-valor-text">
          Cada pieza es única, creada con materiales certificados y siguiendo procesos artesanales
          que garantizan su autenticidad y calidad incomparable.
        </p>
      </div>
      <div class="jn-valor-card">
        <div class="jn-valor-icon"><i class="bi bi-shield-check"></i></div>
        <div class="jn-valor-title">Garantía</div>
        <p class="jn-valor-text">
          Respaldamos cada joya con certificado de autenticidad. Oro puro garantizado,
          piedras naturales verificadas y acabados de la más alta calidad.
        </p>
      </div>
      <div class="jn-valor-card">
        <div class="jn-valor-icon"><i class="bi bi-heart"></i></div>
        <div class="jn-valor-title">Pasión</div>
        <p class="jn-valor-text">
          El amor por la joyería está en cada detalle. Trabajamos con pasión para que
          cada pieza supere tus expectativas y se convierta en un tesoro familiar.
        </p>
      </div>
      <div class="jn-valor-card">
        <div class="jn-valor-icon"><i class="bi bi-award"></i></div>
        <div class="jn-valor-title">Maestría</div>
        <p class="jn-valor-text">
          Nuestros artesanos acumulan décadas de experiencia en técnicas de orfebrería
          tradicional colombiana, asegurando un acabado perfecto en cada creación.
        </p>
      </div>
      <div class="jn-valor-card">
        <div class="jn-valor-icon"><i class="bi bi-leaf"></i></div>
        <div class="jn-valor-title">Responsabilidad</div>
        <p class="jn-valor-text">
          Adquirimos nuestros materiales de proveedores responsables, comprometidos
          con prácticas éticas y sostenibles en la minería y extracción de metales preciosos.
        </p>
      </div>
      <div class="jn-valor-card">
        <div class="jn-valor-icon"><i class="bi bi-people"></i></div>
        <div class="jn-valor-title">Comunidad</div>
        <p class="jn-valor-text">
          Somos parte de la comunidad joyera del norte de Colombia y contribuimos
          al desarrollo económico y cultural de nuestra región con orgullo.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ══ EQUIPO ══ --}}
<section class="jn-section">
  <div class="container">
    <div class="text-center mb-2">
      <div class="jn-section-eyebrow" style="justify-content:center;">
        <i class="bi bi-people" style="font-size:10px;"></i>
        Quiénes somos
      </div>
      <h2 class="jn-section-title">Nuestro <em>equipo</em></h2>
      <p class="jn-section-text mx-auto" style="max-width:480px;">
        Personas apasionadas por el arte de la joyería, unidas por el deseo de crear piezas
        que emocionen y perduren en el tiempo.
      </p>
    </div>
    <div class="jn-team-grid">
      <div class="jn-team-card">
        <div class="jn-team-avatar">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="jn-team-info">
          <div class="jn-team-name">Carlos Mendoza</div>
          <div class="jn-team-role">Maestro Joyero — Fundador</div>
        </div>
      </div>
      <div class="jn-team-card">
        <div class="jn-team-avatar">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="jn-team-info">
          <div class="jn-team-name">Ana Lucía Rojas</div>
          <div class="jn-team-role">Diseñadora de Colecciones</div>
        </div>
      </div>
      <div class="jn-team-card">
        <div class="jn-team-avatar">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="jn-team-info">
          <div class="jn-team-name">Roberto Vargas</div>
          <div class="jn-team-role">Orfebre Senior</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ CTA ══ --}}
<section class="jn-cta-section">
  <div class="container">
    <div class="jn-page-eyebrow" style="justify-content:center; margin-bottom:20px;">
      <i class="bi bi-gem" style="font-size:11px;"></i>
      ¿Lista para tu joya?
    </div>
    <h2 class="jn-section-title" style="text-align:center; margin-bottom:12px;">
      Empieza a explorar <em>nuestra colección</em>
    </h2>
    <p class="jn-section-text text-center mx-auto mb-4" style="max-width:420px;">
      Descubre piezas únicas que hablan por sí solas.
      O contáctanos para crear algo completamente personalizado para ti.
    </p>
    <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
      <a href="{{ route('web.index') }}" class="jn-btn-primary">
        <i class="bi bi-gem"></i>
        Ver colección
      </a>
      <a href="{{ route('web.contacto') }}" class="jn-btn-ghost">
        <i class="bi bi-envelope"></i>
        Contáctanos
      </a>
    </div>
  </div>
</section>
@endsection
