<?php

  require_once 'includes/templates/header.php';

?>

  <section class="seccion contenedor">
      <h2>Calendario de Eventos</h2>

      <?php

        try {

          require_once 'includes/funciones/bd_conexion.php';
          $query = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado "; // cat_evento, nombre_invitado y apellido_invitado porque vamos uniendo las tablas
          $query .= " FROM eventos ";
          $query .= " INNER JOIN categoria_evento "; // Tabla con la que uniremos la de eventos
          $query .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; // Cuáles columnas de las tablas deben de ser iguales
          $query .= " INNER JOIN invitados ";
          $query .= " ON eventos.id_inv = invitados.invitado_id ";
          $query .= " ORDER BY evento_id ";
          // Un JOIN es como hacer una consulta a muchas tablas
          $resultados = $conn->query($query);

        }

        catch (exception $e) {

          die('Ha ocurrido un error: ' . $e->getMessage());

        }

      ?>

      <div class="calendario">
        <?php

        $calendario = array();

        while($eventos = $resultados->fetch_assoc()) {

          // Obtener la fecha del evento

          $fecha = $eventos['fecha_evento'];

          $evento = array( // Crear nuestro propio arreglo, formatear el que viene de la BBDD

            'titulo' => $eventos['nombre_evento'],
            'fecha' => $eventos['fecha_evento'],
            'hora' => $eventos['hora_evento'],
            'categoria' => $eventos['cat_evento'],
            'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado'],
            'icono' => $eventos['icono']

          );

          $calendario[$fecha][] = $evento; // Agrupar por fecha, crear una dimensión de fecha y así que en cada fecha estén los eventos que correspondan a ella

        }

        ?>

        <?php

          // Imprimir los Eventos

          foreach($calendario as $dia => $lista_eventos) { ?>

            <h3>
              <i class="fas fa-calendar-alt">
                <?php

                  setlocale(LC_TIME, "spanish");
                  //echo date("F j, Y", strtotime($dia));

                  echo ucfirst(strftime("%A, %d de %B del %Y", strtotime($dia))); // strftime respeta la configuración local
                  // strtotime convierte una cadena a fecha
                  // ucfirst hace mayúscula la primera letra de la cadena

                ?>
              </i>
            </h3>

            <?php

              foreach($lista_eventos as $evento) { ?>

                <div class="dia">
                  <p class="titulo"><?php echo $evento['titulo']; ?> </p>
                  <p class="hora"><i class="far fa-clock"></i>
                    <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
                  </p>
                  <p><i class="<?php echo $evento['icono']; ?>"></i>
                    <?php echo $evento['categoria']; ?>
                  </p>
                  <p><i class="fa fa-user"></i>
                    <?php echo $evento['invitado']; ?>
                  </p>
                </div>

              <?php } // Fin foreach eventos ?>

          <?php }  // Fin foreach dias ?>

      </div> <!--.calendario-->

      <?php

        $conn->close();

      ?>

  </section>

  <?php require_once 'includes/templates/footer.php'; ?>
