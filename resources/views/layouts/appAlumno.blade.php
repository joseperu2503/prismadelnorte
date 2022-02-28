<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="es" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/colores.css')}}">
    <script src="https://kit.fontawesome.com/191a957bb7.js" crossorigin="anonymous"></script>
    @yield('css') 
    <link rel="stylesheet" href="{{asset('css/tablas.css')}}"> 
  </head>
<body> 
  <header>
    <div class="home-content">
      <i class='bx bx-menu close'></i>
      <div class="info-header close">
        <img class="foto-perfil" src="{{ $alumno->foto_perfil }}" alt="foto de perfil">
        <p>{{ $alumno->primer_nombre }}</p>
      </div>
    </div>
  </header>
  <div class="sidebar close">
    <div class="logo-details">
      <img class="logo" src="https://i.postimg.cc/y8ZNkg1R/icono-prisma.png" alt="">
      <span class="logo_name">Prisma del Norte</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="/alumno">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Inicio</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Inicio</a></li>
        </ul>
      </li>
    
      <li>
        <a href="/alumno/perfil">
          <i class="fas fa-id-card"></i>
          <span class="link_name">Perfil</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Perfil</a></li>
        </ul>
      </li>
      <li>
        <a href="/alumno/cursos">
          <i class="fas fa-book"></i>
          <span class="link_name">Mis Cursos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Mis Cursos</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fas fa-check-double"></i>
            <span class="link_name">Reporte academico</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Reporte academico</a></li>
          <li><a href="/alumno/mi_asistencia">Asistencia</a></li>
          <li><a href="#">Disciplina</a></li>          
        </ul>
      </li>
      <li>
        <div class="profile-details">
          
          <div class="profile-content">
            <!--<img src="image/profile.jpg" alt="profileImg">-->
          </div>
          <div class="name-job">
            <div class="profile_name">Cerrar Sesion</div>
          </div>
          <a href="{{route('login.destroy')}}">
            <i class='bx bx-log-out' ></i>
          </a>
          
        </div>
      </li>
    </ul>
  </div>
  <section class="home-section">   
    <main class="main">
      @yield('content')
    </main>
  </section>
  <script src="{{asset('js/sidebar.js')}}"></script>
  @yield('js')
</body>
</html>