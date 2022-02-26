<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{asset('css/tablas.css')}}">
    <link rel="stylesheet" href="{{asset('css/colores.css')}}">
    <script src="https://kit.fontawesome.com/191a957bb7.js" crossorigin="anonymous"></script>
  </head>
<body> 
  <header>
    <div class="home-content">
      <i class='bx bx-menu close'></i>
      <div class="info-header">
        <img class="foto-perfil" src="/storage/fotos_perfil/{{ $profesor->foto_perfil }}" alt="foto de perfil">
        <p>{{ $profesor->primer_nombre }}</p>
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
        <a @if (auth()->user()->role == 'profesor')
          href="{{route('profesor.mis_cursos')}}"
        @else
          href="/profesor/{{ $profesor->id }}/cursos"    
        @endif 
        >
          <i class="fas fa-book" title="Cursos"></i>
          <span class="link_name">Mis Cursos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Mis Cursos</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fas fa-check-double" title="Asistencia"></i>
            <span class="link_name">Reporte academico</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Reporte academico</a></li>
          <li><a href="#">Asistencia</a></li>
          <li><a href="#">Disciplina</a></li>          
        </ul>
      </li>
      
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <!--<img src="image/profile.jpg" alt="profileImg">-->
          </div>
          <div class="name-job">
            <div class="profile_name">Prem Shahi</div>
            <div class="job">Web Desginer</div>
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
  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
    sidebarBtn.classList.toggle("close");
  });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>