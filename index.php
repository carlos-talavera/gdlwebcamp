<?php

  require_once 'includes/templates/header.php';

?>

  <section class="seccion contenedor">
    <h2>La mejor conferencia de diseño web en español</h2>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </section> <!--.seccion-->

  <section class="programa">
      <div class="contenedor-video">
          <video autoplay loop muted poster="img/bg-talleres.jpg">
              <source src="video/video.mp4" type="video/mp4">
              <source src="video/video.webm" type="video/webm">
              <source src="video/video.ogv" type="video/ogg">
          </video>
      </div> <!--.contenedor-video-->
      <div class="contenido-programa">
        <div class="contenedor">
          <div class="programa-evento">
              <h2>Programa del Evento</h2>
              <?php

                try {

                  require_once 'includes/funciones/bd_conexion.php';
                  $query = " SELECT * FROM categoria_evento ORDER BY id_categoria DESC ";
                  $resultados = $conn->query($query);

                }

                catch (exception $e) {

                  die('Ha ocurrido un error: ' . $e->getMessage());

                }


              ?>
              <nav class="menu-programa">
                <?php while($cat = $resultados->fetch_array(MYSQLI_ASSOC)) { ?>
                  <a href="#<?php echo strtolower($cat['cat_evento']); ?>">
                    <i class="<?php echo $cat['icono']; ?>"></i> <?php echo $cat['cat_evento']; ?>
                  </a>
                <?php } ?>
              </nav>

              <?php

                try {

                  require_once 'includes/funciones/bd_conexion.php';
                  $query = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado "; // cat_evento, nombre_invitado y apellido_invitado porque vamos uniendo las tablas
                  $query .= " FROM eventos ";
                  $query .= " INNER JOIN categoria_evento "; // Tabla con la que uniremos la de eventos
                  $query .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; // Cuáles columnas de las tablas deben de ser iguales
                  $query .= " INNER JOIN invitados ";
                  $query .= " ON eventos.id_inv = invitados.invitado_id ";
                  $query .= " AND eventos.id_cat_evento = 1 "; // Solo los de categoria 1, los seminarios
                  $query .= " ORDER BY evento_id LIMIT 2; "; // Solo dos registros porque en el diseño solo manejamos dos
                  // Un JOIN es como hacer una consulta a muchas tablas
                  $query .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado "; // cat_evento, nombre_invitado y apellido_invitado porque vamos uniendo las tablas
                  $query .= " FROM eventos ";
                  $query .= " INNER JOIN categoria_evento "; // Tabla con la que uniremos la de eventos
                  $query .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; // Cuáles columnas de las tablas deben de ser iguales
                  $query .= " INNER JOIN invitados ";
                  $query .= " ON eventos.id_inv = invitados.invitado_id ";
                  $query .= " AND eventos.id_cat_evento = 2 "; // Solo los de categoria 1, los seminarios
                  $query .= " ORDER BY evento_id LIMIT 2; "; // Solo dos registros porque en el diseño solo manejamos dos
                  // Un JOIN es como hacer una consulta a muchas tablas
                  $query .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado "; // cat_evento, nombre_invitado y apellido_invitado porque vamos uniendo las tablas
                  $query .= " FROM eventos ";
                  $query .= " INNER JOIN categoria_evento "; // Tabla con la que uniremos la de eventos
                  $query .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; // Cuáles columnas de las tablas deben de ser iguales
                  $query .= " INNER JOIN invitados ";
                  $query .= " ON eventos.id_inv = invitados.invitado_id ";
                  $query .= " AND eventos.id_cat_evento = 3 "; // Solo los de categoria 1, los seminarios
                  $query .= " ORDER BY evento_id LIMIT 2 "; // Solo dos registros porque en el diseño solo manejamos dos
                  // Un JOIN es como hacer una consulta a muchas tablas

                }

                catch (exception $e) {

                  die('Ha ocurrido un error: ' . $e->getMessage());

                }


              ?>

              <?php $conn->multi_query($query); // Varias consultas a la vez ?>

              <?php

                do {

                  $resultados = $conn->store_result(); // Almacenar los resultados
                  $row = $resultados->fetch_all(MYSQLI_ASSOC); // Ordenar los resultados en un array asociativo

                  ?>

                  <?php $i = 0; ?>

                  <?php foreach($row as $evento): ?>

                    <?php if($i % 2 == 0) { ?>

                  <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">

                    <?php } ?>

                    <div class="detalle-evento">
                      <h3><?php echo $evento['nombre_evento']; ?></h3>
                      <p><i class="far fa-clock"></i> <?php echo $evento['hora_evento']; ?></p>
                      <p><i class="fas fa-calendar-alt"></i> <?php echo $evento['fecha_evento']; ?></p>
                      <p><i class="fa fa-user"></i> <?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></p>
                    </div>

                    <?php if($i % 2 == 1): ?>

                      <a href="calendario.php" class="button float-right">Ver todos</a>
                    </div> <!--#echo $row['cat_evento']-->

                  <?php endif; ?>

                  <?php $i++; ?>

                <?php endforeach; ?>

                <?php $resultados->free(); // Liberar la memoria

                }

                while($conn->more_results() && $conn->next_result()); // Mientras haya más resultados y haya resultados después

              ?>

          </div> <!--.programa-evento-->
        </div> <!--.contenedor-->
      </div> <!--.contenido-programa-->
  </section> <!--.programa-->

  <?php require_once 'includes/templates/invitados.php'; ?>

  <div class="contador parallax">
      <div class="contenedor">
          <ul class="resumen-evento clearfix">
            <li><p class="numero"></p> Invitados</li>
            <li><p class="numero"></p> Talleres</li>
            <li><p class="numero"></p> Días</li>
            <li><p class="numero"></p> Conferencias</li>
          </ul>
      </div> <!--.contenedor-->

  </div> <!--.contador parallax-->

  <section class="precios seccion">
    <h2>Precios</h2>
    <div class="contenedor">
        <ul class="lista-precios clearfix">
          <li>
                <div class="tabla-precio">
                  <h3>Pase por día</h3>
                  <p class="numero">$30</p>
                <ul>
                    <li>Bocadillos gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <a href="#" class="button hollow">Comprar</a>
              </div>
          </li>
          <li>
                <div class="tabla-precio">
                  <h3>Todos los días</h3>
                  <p class="numero">$50</p>
                <ul>
                    <li>Bocadillos gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <a href="#" class="button">Comprar</a>
                </div>
          </li>
          <li>
                <div class="tabla-precio">
                  <h3>Pase por 2 días</h3>
                  <p class="numero">$45</p>
                <ul>
                    <li>Bocadillos gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <a href="#" class="button hollow">Comprar</a>
                </div>
          </li>
        </ul>
    </div>

  </section> <!--.precios-->

  <div class="mapa" id="mapa"></div>

  <section class="seccion">
    <h2>Testimoniales</h2>
      <div class="testimoniales contenedor clearfix">
        <div class="testimonial">
            <blockquote>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <footer class="info-testimonial clearfix">
                    <img src="img/testimonial.jpg" alt="Testimonial">
                    <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                </footer>
            </blockquote>
        </div> <!--.testimonial-->
        <div class="testimonial">
            <blockquote>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <footer class="info-testimonial clearfix">
                    <img src="img/testimonial.jpg" alt="Testimonial">
                    <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                </footer>
            </blockquote>
        </div> <!--.testimonial-->
        <div class="testimonial">
            <blockquote>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <footer class="info-testimonial clearfix">
                    <img src="img/testimonial.jpg" alt="Testimonial">
                    <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                </footer>
            </blockquote>
        </div> <!--.testimonial-->
      </div> <!--.testimoniales-->
  </section>

  <div class="newsletter parallax">
      <div class="contenido contenedor">
          <p>regístrate al newsletter:</p>
          <h3>GdlWebCamp</h3>
          <a href="#mc_embed_signup" class="boton-newsletter button transparente">Registro</a>
      </div> <!--.contenedor-->

  </div> <!--.newsletter parallax-->

  <section class="seccion">
    <h2>Faltan</h2>
    <div class="cuenta-regresiva contenedor">
      <ul class="clearfix">
        <li><p id="dias" class="numero"></p> Días</li>
        <li><p id="horas" class="numero"></p> Horas</li>
        <li><p id="minutos" class="numero"></p> Minutos</li>
        <li><p id="segundos" class="numero"></p> Segundos</li>
      </ul>
    </div>
  </section>

  <?php require_once 'includes/templates/footer.php'; ?>
