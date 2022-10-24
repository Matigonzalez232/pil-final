<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="index.html">Arsha</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto " <?=CANONICAL == URL . "/" ? "active" : "";?> href="<?= URL?>">Inicio</a></li>
        <li><a class="nav-link scrollto" <?=CANONICAL == URL . "/" ? "active" : "";?> href="<?= URL . "/empresa" ?>">Sobre nosotros</a></li>
        <li><a class="nav-link scrollto" <?=CANONICAL == URL . "/" ? "active" : "";?> href="<?= URL . "/c/novedades" ?>">Novedades</a></li>
        <li><a class="nav-link scrollto" <?=CANONICAL == URL . "/" ? "active" : "";?> href="<?= URL . "/c/Portfolio-contenido" ?>">Portfolio</a></li>
        <li><a class="nav-link scrollto" <?=CANONICAL == URL . "/" ? "active" : "";?> href="<?= URL . "/c/servicio-inicio" ?>">Servicios</a></li>
        <li><a class="getstarted scrollto" <?=CANONICAL == URL . "/" ? "active" : "";?> href="<?= URL . "/contacto" ?>">Contacto</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->