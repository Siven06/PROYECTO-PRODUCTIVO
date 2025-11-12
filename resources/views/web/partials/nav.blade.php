<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand fw-bold text-uppercase" href="#!">JOYEROS DEL NORTE</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- NAV LINKS -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active nav-btn" aria-current="page" href="/">INICIO</a></li>
                <li class="nav-item"><a class="nav-link nav-btn" href="#">ACERCA</a></li>
                <li class="nav-item"><a class="nav-link nav-btn" href="#">TIENDA</a></li>

                @auth
                    @if(auth()->user()->is_admin ?? false)
                        <li class="nav-item"><a class="nav-link nav-btn" href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endif
                @endauth
            </ul>

            <!-- ICONOS DERECHA -->
            <div class="d-flex align-items-center gap-3">

                <!-- Carrito (solo ícono) -->
                <a href="{{ route('carrito.mostrar') }}" class="btn btn-cart position-relative">
                    <i class="bi bi-cart-fill fs-4"></i>
                    <span class="badge bg-danger text-white position-absolute top-0 start-100 translate-middle rounded-pill">
                        {{ session('carrito') ? array_sum(array_column(session('carrito'), 'cantidad')) : 0 }}
                    </span>
                </a>

                <!-- Dropdown de usuario -->
                <li class="nav-item dropdown list-unstyled m-0">
                    @auth
                        <a class="nav-link dropdown-toggle nav-btn" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('perfil.pedidos') }}">Mis pedidos</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="{{ route('perfil.edit') }}">Mi perfil</a></li>
                        </ul>
                    @else
                        <a class="nav-link nav-btn" href="{{ route('login') }}">Iniciar sesión</a>
                    @endauth
                </li>

            </div>
        </div>
    </div>
</nav>
