<?php

        try {

          require_once 'includes/funciones/bd_conexion.php';
          $query = " SELECT * FROM invitados ";
          $resultados = $conn->query($query);

        }

        catch (exception $e) {

          die('Ha ocurrido un error: ' . $e->getMessage());

        }


      ?>

      <section class="invitados contenedor seccion">
          <h2>Nuestros Invitados</h2>
              <ul class="lista-invitados clearfix">

                <?php

                while($invitados = $resultados->fetch_assoc()) { ?>
                              <li>
                                  <div class="invitado">
                                    <a class="invitado-info" href="#invitado<?php echo $invitados['invitado_id']; ?>">
                                      <img src="img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="Invitado <?php echo $invitados['invitado_id'] ?>">
                                      <p><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?></p>
                                    </a>
                                  </div>
                              </li>
                              <div style="display: none;">
                                  <div class="invitado-info" id="invitado<?php echo $invitados['invitado_id']; ?>">
                                      <h2><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?></h2>
                                      <img src="img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="Invitado <?php echo $invitados['invitado_id'] ?>">
                                      <p><?php echo $invitados['descripcion']; ?></p>
                                </div>
                              </div>

                <?php } ?>

              </ul>
      </section> <!--.invitados-->

      <?php

        $conn->close();

      ?>
