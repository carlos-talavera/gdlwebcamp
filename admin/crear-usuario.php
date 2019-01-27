<?php 

  include_once 'templates/header.php'; 
  
  include_once 'templates/barra.php';

  include_once 'templates/navegacion.php';

?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Usuario
        <small>Llena el formulario para crear un usuario</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

        <!-- Main content -->
        <section class="content">
          
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear usuario</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Esconder">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <form role="form" name="crear-usuario" id="crear-usuario" action="#" method="POST">
                  <div class="box-body">
                    <p class="text-green">* Todos los campos del formulario son obligatorios</p>

                        <?php
                        
                            require_once '../includes/funciones/bd_conexion.php';

                            $j = 1;

                            setlocale(LC_ALL, "es_ES");

                            function modales($tipo) {

                            global $conn, $j; // Globales porque si no no las encuentra y dice que no están declaradas

                          ?>

                          <!-- Modal -->
                          <div class="modal fade" id='<?php echo ($tipo === 'Artículos') ? 'selectArt' : 'selectEvt'; ?>' style='display: none;'>
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><?php echo $tipo; ?></h4>
                                </div>
                                <div class="modal-body">
                                  
                                  <?php

                                    if($tipo === 'Artículos') { ?>
  
                                        <div class="form-group">
                                            <label>Pases</label>

                                            <div class="input-group input-group-md">
                                                <div class="input-group-btn">
                                                <button type="button" id="btnTipoPass" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Tipo de pase
                                                    <span class="fa fa-caret-down"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" class="pase" data-tipo="Pase de un día">Pase de un día</a></li>
                                                    <li><a href="#" class="pase" data-tipo="Pase completo">Pase completo</a></li>
                                                    <li><a href="#" class="pase" data-tipo="Pase de dos días">Pase de dos días</a></li>
                                                </ul>
                                                </div>
                                                <!-- /btn-group -->
                                                <input type="number" min="0" style="display: none;" data-tipo="Pase de un día" class="num_pases form-control">
                                                <input type="number" min="0" style="display: none;" data-tipo="Pase completo" class="num_pases form-control">
                                                <input type="number" min="0" style="display: none;" data-tipo="Pase de dos días" class="num_pases form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Extras</label>

                                            <div class="input-group input-group-md">
                                                <div class="input-group-btn">
                                                <button type="button" id="btnTipoExt" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Tipo de extra
                                                    <span class="fa fa-caret-down"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" class="extra" data-tipo="Camisa">Camisa</a></li>
                                                    <li><a href="#" class="extra" data-tipo="Paquete de etiquetas">Paquete de etiquetas</a></li>
                                                </ul>
                                                </div>
                                                <!-- /btn-group -->
                                                <input type="number" min="0" style="display: none;" data-tipo="Camisa" class="num_extras form-control">
                                                <input type="number" min="0" style="display: none;" data-tipo="Paquete de etiquetas" class="num_extras form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label>Regalo</label>
                                                <select id="regalos_crear" style='width: 100%;'>
                                                    <option value="0">-- Seleccione un regalo --</option>

                                    <?php

                                        $regalos = $conn->query("SELECT * FROM regalos");
                                  
                                        while($regalo = $regalos->fetch_assoc()) {

                                            echo "<option value='{$regalo['ID_regalo']}'>{$regalo['nombre_regalo']}</option>";

                                        }
                                  
                                    ?>

                                                </select>
                                        </div>        

                                    <?php }

                                    else if($tipo === 'Eventos') { ?>

                                      <div class="eventos-modal">
                                        <aside class="aside-btn-arrow-1"><button type="button" class="btn bg-primary btn-arrow-slider"><i class="fa fa-angle-left"></i></button></aside>
                                        <aside class="aside-btn-arrow-2"><button type="button" class="btn bg-primary btn-arrow-slider"><i class="fa fa-angle-right"></i></button></aside>
        
                                      <?php 
                                      
                                      try {

                                        $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado";
                                        $sql .= " FROM eventos ";
                                        $sql .= " JOIN categoria_evento ";
                                        $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                                        $sql .= " JOIN invitados ";
                                        $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                                        $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento";

                                        $resultado = $conn->query($sql);

                                        $eventos = array();

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

                                          <div style='order: 2;' id='<?php echo str_replace("á", "a", $dia); ?>' class='contenido-dia clearfix' data-posicion="<?php echo $j; ?>">
                                          <h4><?php echo ucfirst($dia); ?></h4>

                                          <?php foreach($categorias as $categoria => $eventos) : ?>

                                            <div>
                                            <p><?php echo $categoria; ?>:</p>

                                            <?php foreach($eventos as $posicion => $evento) : ?>

                                              <label>
                                              <input type="checkbox" class="check-evt" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                                              <time><?php echo $evento['hora']; ?></time> <?php echo $evento['nombre']; ?>
                                              </label>
                                              <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>

                                      <?php endforeach; ?>

                                            </div>

                                      <?php endforeach; ?>

                                          </div>

                                      <?php 
                                      
                                      $j++;
                                    
                                      endforeach; 

                                      ?>

                                      </div>
                                      
                                      <?php } catch(Exception $e) {

                                          die("Ha ocurrido un error al tratar de mostrar los talleres disponibles");

                                      }

                                    }
                                  
                                  ?>
                                
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                              
                            </div>
                          </div>

                          <?php

                            }

                            modales('Eventos');
                            modales('Artículos');
                        
                        ?>

                        <div class="form-group">
                              <label for="nombre_reg">Nombre</label>
                              <input type="text" class="form-control input-evt-blur" id="nombre_reg" placeholder="Ingresa el nombre" autofocus>
                              <span class="help-block" id="valid_nom_reg" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label for="ape_reg">Apellido</label>
                              <input type="text" class="form-control input-evt-blur" id="ape_reg" placeholder="Ingresa el apellido">
                              <span class="help-block" id="valid_ape_reg" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label for="email_reg">Email</label>
                              <input type="email" class="form-control input-evt-blur" id="email_reg" placeholder="Ingresa el email">
                              <span class="help-block" id="valid_email_reg" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label>Artículos</label>
                              <button type='button' id="btnVerArt" class='btn btn-primary' style='display: block;' data-toggle='modal' data-target='#selectArt'>Ver los artículos disponibles</button>
                        </div>
                        <div class="form-group">
                              <label>Eventos</label>
                              <button type='button' id="btnVerEvt" class='btn btn-primary' style='display: block;' data-toggle='modal' data-target='#selectEvt'>Ver los eventos disponibles</button>
                        </div>
                        <div class="form-group">
                              
                        </div>
                        <div class="form-group">
                              <label>Pagado</label>
                              <select id="select_pagado" style='width: 100%;'>
                                  <option value="-1">-- Seleccione el estatus de pago --</option>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                              </select>
                        </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" name="agregar" id="agregar-usuario" class="btn btn-primary" value="Añadir">
                  </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        
        </section>
        <!-- /.content -->
      </div>
      <!-- /.col-md-8-->
    </div>
    <!-- /.row-->
  </div>
  <!-- /.content-wrapper -->

  <?php 
  
    include_once 'templates/footer.php';
  
  ?>