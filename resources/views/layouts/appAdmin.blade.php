<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="es" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <img class="foto-perfil" src="/storage/fotos_perfil/usuario.png" alt="foto de perfil">
        <p>Admin</p>
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
        <a href="#">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Category</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Category</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Category</a></li>
          <li><a href="#">HTML & CSS</a></li>
          <li><a href="#">JavaScript</a></li>
          <li><a href="#">PHP & MySQL</a></li>
        </ul>
      </li>
      <li>
        <a href="/publicaciones">
          <i class='bx bx-book-alt' ></i>
          <span class="link_name">Publicaciones</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Publicaciones</a></li>
        </ul>
      </li>
      <li>
        <a href="/aulas">
          <i class="fas fa-graduation-cap"></i>
          <span class="link_name">Aulas</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Aulas</a></li>
        </ul>
      </li>
      <li>
        <a href="/profesores">
          <i class="fas fa-chalkboard-teacher"></i>
          <span class="link_name">Profesores</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Profesores</a></li>
        </ul>
      </li>
      <li>
        <a href="/cursos">
          <i class="fas fa-book"></i>
          <span class="link_name">Cursos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Cursos</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fas fa-check-double"></i>
            <span class="link_name">Asistencia</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Asistencia</a></li>
          <li><a href="/asistencia_alumnos">Alumnos</a></li>
          <li><a href="/asistencia_profesores">Profesores</a></li>
          <li><a href="/asistencia_trabajadores">Trabajadores</a></li>
          <li><a href="/nueva_asistencia">Registrar asistencia</a></li>          
        </ul>
      </li>
      <li>
        <a href="/trabajadores">
          <i class="fas fa-briefcase"></i>
          <span class="link_name">Personal Complementario</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Personal Complementario</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-compass' ></i>
          <span class="link_name">Explore</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Explore</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-history'></i>
          <span class="link_name">History</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">History</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li>
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <!--<img src="image/profile.jpg" alt="profileImg">-->
          </div>
          <div class="name-job">
            <div class="profile_name">Cerrar Sesión</div>
            
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