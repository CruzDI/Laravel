<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
  <img src="{{ asset('images/logo.png') }}" width="70" height="70" class="d-inline-block align-top rounded-circle" style="margin-right: 10px;" alt="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
        <a class="nav-link active" href="{{ route('index') }}">Inicio
      <span class="visually-hidden">(current)</span>
        </a>
        </li>
        
        @guest
                    <li class="nav-item dropdown">

<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-user"></i> 
</a>

                  <div class="dropdown-menu">
                            @if (Route::has('login'))
                                
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                                
                            @endif

                            @if (Route::has('register'))
                                
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                
                            @endif
                            </div>
</li>
                        @else
                        @if(Auth::check() && Auth::user()->idperfil == 1)
                        <li class="nav-item">
              <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('perfiles.index') }}">Perfiles</a>
            </li>
            
          @endif
        
        <li class="nav-item">
          <a class="nav-link" href="{{ Route('clientes.index') }}">Clientes</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="{{ Route('facturas.index') }}">Facturacion</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ Route('productos.index') }}">Productos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ Route('carrito') }}"><i class="fa fa-shopping-cart fa-2x"></i></a>
        </li>
        
        
        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
