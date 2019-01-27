<?php

$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);

?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php if($pagina == "index") {

    echo "GDLWebCamp";

  } else {

    if(strpos($pagina, "_") !== FALSE) {

      echo ucfirst(str_replace("_", " ", $pagina));

    } else {

      echo ucfirst($pagina);

    }

  } ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css">

  <?php

    if($pagina == "invitados" || $pagina == "index") {

      echo '<link rel="stylesheet" href="css/colorbox.css">';

    }

    else if($pagina == "conferencia") {

      echo '<link rel="stylesheet" href="css/lightbox.css">';

  }

  ?>

  <style>

    .navegacion-principal a#<?php echo $pagina; ?> {

      border-bottom: 2px solid #fe4918;

    }

  </style>

  <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->


  <header class="site-header">
      <div class="hero">
          <div class="contenido-header">
              <nav class="redes-sociales">
                  <a href="https://facebook.com/carlos.e.talavera" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a href="https://twitter.com/@CharlieT0218" target="_blank"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-pinterest" target="_blank"></i></a>
                  <a href="#"><i class="fab fa-youtube" target="_blank"></i></a>
                  <a href="https://instagram.com/carlos_talavera18" target="_blank"><i class="fab fa-instagram"></i></a>
              </nav>
              <div class="informacion-evento">
                <div class="clearfix">
                  <p class="fecha"><i class="fas fa-calendar-alt"></i> 13-15 Dic</p>
                  <p class="ciudad"><i class="fas fa-map-marker-alt"></i> Guadalajara, MX</p>
                </div>

                <h1 class="nombre-sitio">GdlWebCamp</h1>
                <p class="slogan">La mejor conferencia de <span>diseño web</span></p>
              </div> <!--.informacion-evento-->
          </div>
      </div> <!--.hero-->

  </header>

  <div class="barra">
      <div class="contenedor clearfix">
          <div class="logo">
              <a href="index.php">
                <img src="img/logo.svg" alt="Logo SVG GdlWebCamp">
              </a>
          </div>

          <div class="menu-movil">
              <span></span>
              <span></span>
              <span></span>
          </div>

          <nav class="navegacion-principal clearfix">
              <a href="conferencia.php" id="conferencia">Conferencia</a>
              <a href="calendario.php" id="calendario">Calendario</a>
              <a href="invitados.php" id="invitados">Invitados</a>
              <a href="registro.php" id="registro">Reservaciones</a>
          </nav>
      </div> <!--.contenedor clearfix-->
  </div> <!--.barra-->
