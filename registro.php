<?php

require_once 'includes/templates/header.php';

?>

  <section class="seccion contenedor">
    <h2>Registro de Usuarios</h2>
    <form id="registro" class="registro" action="pagar.php" method="post">
      <div id="datos_usuario" class="registro caja clearfix">
        <div class="campo">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">
        </div>
        <div class="campo">
          <label for="apellido">Apellido:</label>
          <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
        </div>
        <div class="campo">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Tu Email">
        </div>
        <div id="error"></div>
      </div> <!--#datos_usuario-->

      <div id="paquetes" class="paquetes">
        <h3>Elige el número de boletos</h3>

        <ul class="lista-precios clearfix">
          <li>
                <div class="tabla-precio">
                  <h3>Pase por día (viernes)</h3>
                  <p class="numero">$30</p>
                <ul>
                    <li>Bocadillos gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <div class="orden">
                  <label for="pase_dia">Boletos deseados:</label>
                  <input type="number" min="0" name="boletos[un_dia][cantidad]" id="pase_dia" size="3" placeholder="0">
                  <input type="hidden" value="30" name="boletos[un_dia][precio]"> <!--Precio del boleto-->
                </div> <!--.orden-->
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
                <div class="orden">
                  <label for="pase_completo">Boletos deseados:</label>
                  <input type="number" min="0" name="boletos[completo][cantidad]" id="pase_completo" size="3" placeholder="0">
                  <input type="hidden" value="50" name="boletos[completo][precio]"> <!--Precio del boleto-->
                </div> <!--.orden-->
                </div>
          </li>
          <li>
                <div class="tabla-precio">
                  <h3>Pase por 2 días (viernes y sábado)</h3>
                  <p class="numero">$45</p>
                <ul>
                    <li>Bocadillos gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                </ul>
                <div class="orden">
                  <label for="pase_dosdias">Boletos deseados:</label>
                  <input type="number" min="0" name="boletos[dos_dias][cantidad]" id="pase_dosdias" size="3" placeholder="0">
                  <input type="hidden" value="45" name="boletos[dos_dias][precio]"> <!--Precio del boleto-->
                </div> <!--.orden-->
                </div>
          </li>
        </ul>

      </div> <!--#paquetes-->

      <div id="eventos" class="eventos clearfix">
        <h3>Elige tus talleres</h3>
        <div class="caja">
          
          <?php 
        
            try {

              require_once 'includes/funciones/bd_conexion.php';

              $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado";
              $sql .= " FROM eventos ";
              $sql .= " JOIN categoria_evento ";
              $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
              $sql .= " JOIN invitados ";
              $sql .= " ON eventos.id_inv = invitados.invitado_id ";
              $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento";

              $resultado = $conn->query($sql);

              $eventos = array();

              setlocale(LC_ALL, "es_ES");

              while($evento = $resultado->fetch_assoc()) {

                $dia_semana = strftime("%A", strtotime($evento['fecha_evento']));

                $dia = array(
                  'nombre' => $evento['nombre_evento'],
                  'id' => $evento['evento_id'],
                  'hora' => strftime("%H:%M", strtotime($evento['hora_evento'])),
                  'nombre_invitado' => $evento['nombre_invitado'],
                  'apellido_invitado' => $evento['apellido_invitado']
                );
                
                $eventos[$dia_semana][$evento['cat_evento']][] = $dia;

              }

              foreach($eventos as $dia => $categorias) : ?>

                <div id='<?php echo str_replace("á", "a", $dia); ?>' class='contenido-dia clearfix'>
                <h4><?php echo ucfirst($dia); ?></h4>

                <?php foreach($categorias as $categoria => $eventos) : ?>

                  <div>
                  <p><?php echo $categoria; ?>:</p>

                  <?php foreach($eventos as $posicion => $evento) : ?>

                    <label>
                    <input type="checkbox" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                    <time><?php echo $evento['hora']; ?></time> <?php echo $evento['nombre']; ?>
                    </label>
                    <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>

            <?php endforeach; ?>

                  </div>

            <?php endforeach; ?>

                </div>

            <?php endforeach;
            
            } catch(Exception $e) {

                die("Ha ocurrido un error al tratar de mostrar los talleres disponibles");

            }
        
          ?>
        </div><!--.caja-->
      </div> <!--#eventos-->

      <div id="resumen" class="resumen">
        <h3>Pago y Extras</h3>
          <div class="caja clearfix">
              <div class="extras">
                  <div class="orden">
                    <label for="camisa_evento">Camisa del evento $10 <small>(promoción 7 % dto.)</small></label>
                    <input type="number" min="0" name="pedido_extra[camisas][cantidad]"id="camisa_evento" size="3" placeholder="0">
                    <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                  </div> <!--.orden-->
                  <div class="orden">
                    <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                    <input type="number" min="0" name="pedido_extra[etiquetas][cantidad]" id="etiquetas" size="3" placeholder="0">
                    <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                  </div> <!--.orden-->
                  <div class="orden">
                    <label for="regalo">Seleccione un regalo</label> <br>
                      <select id="regalo" name="regalo" required>
                        <option value="">-- Seleccione un regalo --</option>
                        <option value="2">Etiquetas</option>
                        <option value="1">Pulsera</option>
                        <option value="3">Plumas</option>
                      </select>
                  </div> <!--.orden-->
                  <input type="button" id="calcular" class="button" value="Calcular">
              </div> <!--.extras-->

              <div class="total">
                <p>Resumen:</p>
                  <div id="lista-productos">

                  </div>
                  <p>Total:</p>
                  <div id="suma-total">

                  </div>
                  <input type="hidden" name="total_pedido" id="total_pedido">
                  <input id="btnRegistro" type="submit" name="enviar" class="button" value="Pagar">
              </div> <!--.total-->

          </div> <!--.caja-->
      </div> <!--.resumen-->

    </form>
  </section>

<?php

$resultado->close();
$conn->close();

require_once 'includes/templates/footer.php';

?>
