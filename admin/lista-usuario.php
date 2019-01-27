<?php

  include_once 'templates/header.php';

  include_once 'templates/barra.php';

  include_once 'templates/navegacion.php';

  if($_SESSION['nivel'] != 1) {

    include_once 'forbidden.php';

  } else {

?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <small>Aquí se encuentran todos los usuarios registrados</small>
      </h1>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="registros" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de registro</th>
                            <th>Artículos</th>
                            <th>Talleres</th>
                            <th>Regalo</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php

                        require '../includes/funciones/bd_conexion.php';

                        $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados";
                        $sql .= " INNER JOIN regalos";
                        $sql .= " ON registrados.regalo = regalos.ID_Regalo";
                        $sql .= " ORDER BY ID_Registrado";

                        $query = $conn->query($sql);

                        function modales($tipo) {

                            global $conn, $registro, $articulos, $arreglo_articulos; // Globales porque si no no las encuentra y dice que no están declaradas

                          ?>

                          <!-- Modal -->
                          <div class="modal fade" id='modal<?php echo $tipo . $registro['ID_Registrado']; ?>' style='display: none;'>
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><?php echo ($tipo === 'Articulos') ? 'Artículos' : $tipo; ?> del usuario <?php echo $registro['nombre_registrado'] . " " . $registro['apellido_registrado']; ?></h4>
                                </div>
                                <div class="modal-body">
                                  
                                  <?php

                                    $j = 1;

                                    if($tipo === 'Talleres') { ?>

                                    <ul class='simbologia-cat'>
                                    <li style='font-size: 1.8rem;'><div class='sqr-cat bg-primary'></div> Talleres</li>
                                    <li style='font-size: 1.8rem;'><div class='sqr-cat bg-green'></div> Conferencias</li>
                                    <li style='font-size: 1.8rem;'><div class='sqr-cat bg-red'></div> Seminarios</li>
                                    </ul>

                                    <?php 

                                      $talleres = json_decode($registro['talleres_registrados'], true);

                                      $talleres = "'" . implode("', '", $talleres['eventos']) . "'";

                                      $sql_talleres = "SELECT eventos.*, categoria_evento.cat_evento FROM eventos JOIN categoria_evento ON eventos.id_cat_evento = categoria_evento.id_categoria WHERE eventos.evento_id IN ($talleres) AND categoria_evento.cat_evento = 'Talleres' ORDER BY eventos.evento_id";
                                      $sql_conferencias = "SELECT eventos.*, categoria_evento.cat_evento FROM eventos JOIN categoria_evento ON eventos.id_cat_evento = categoria_evento.id_categoria WHERE eventos.evento_id IN ($talleres) AND categoria_evento.cat_evento = 'Conferencias' ORDER BY eventos.evento_id";
                                      $sql_seminarios = "SELECT eventos.*, categoria_evento.cat_evento FROM eventos JOIN categoria_evento ON eventos.id_cat_evento = categoria_evento.id_categoria WHERE eventos.evento_id IN ($talleres) AND categoria_evento.cat_evento = 'Seminario' ORDER BY eventos.evento_id";

                                      $resultado_talleres = $conn->query($sql_talleres);
                                      $resultado_conferencias = $conn->query($sql_conferencias);
                                      $resultado_seminarios = $conn->query($sql_seminarios);

                                      while($taller = $resultado_talleres->fetch_assoc()) {

                                        echo "<p class='btn btn-flat btn-block bg-primary'>{$taller['nombre_evento']}</p>";

                                      }

                                      while($conferencia = $resultado_conferencias->fetch_assoc()) {

                                        echo "<p class='btn btn-flat btn-block bg-green'>{$conferencia['nombre_evento']}</p>"; 

                                      }

                                      while($seminario = $resultado_seminarios->fetch_assoc()) {

                                        echo "<p class='btn btn-flat btn-block bg-red'>{$seminario['nombre_evento']}</p>"; 

                                      }

                                    } else if($tipo === 'Articulos') {

                                      foreach($articulos as $articulo => $cantidad) {

                                        if($j % 2 == 0) {

                                          echo "<p class='btn btn-flat btn-block bg-primary'>{$cantidad}" . " " . $arreglo_articulos[$articulo] . "</p>";

                                        } else {

                                          echo "<p class='btn btn-flat btn-block bg-green'>{$cantidad}" . " " . $arreglo_articulos[$articulo] . "</p>";

                                        }

                                        $j++;

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

                        while($registro = $query->fetch_assoc()) {

                          echo "<tr>";
                          echo "<td>" . $registro['ID_Registrado'] . "</td>";
                          echo "<td>" . $registro['nombre_registrado'] . " " . $registro['apellido_registrado'];

                          $pagado = $registro['pagado'];

                          if($pagado) {

                            echo " <span style='display: block; margin-top: 1vh;' class='badge bg-green'>Pagado</span>";

                          } else {

                            echo " <span style='display: block; margin-top: 1vh;' class='badge bg-red'>No Pagado</span>";

                          }
                          
                          echo "</td>";

                          $registro['email_registrado'] = explode("@", $registro['email_registrado']);

                          echo "<td>" . $registro['email_registrado'][0] . "<br>@" . $registro['email_registrado'][1] .  "</td>";

                          $registro['fecha_registro'] = explode(" ", $registro['fecha_registro']);
                          
                          echo "<td>" . $registro['fecha_registro'][0] . "<br>" . $registro['fecha_registro'][1] . "</td>";

                          $articulos = json_decode($registro['pases_articulos'], true);
                          
                          $arreglo_articulos = array(
                            'un_dia' => 'Pase 1 día',
                            'pase_completo' => 'Pase completo',
                            'dos_dias' => 'Pase 2 días',
                            'camisas' => 'Camisas',
                            'etiquetas' => 'Etiquetas'
                          );

                          echo "<td>";
                          
                          echo "<button class='btn btn-info btn-md' data-toggle='modal' data-target='#modalArticulos{$registro['ID_Registrado']}'>Ver artículos</button>";

                          echo "</td>";

                          modales('Talleres');
                          modales('Articulos');

                          echo "<td>";

                          echo "<button class='btn btn-info btn-md' data-toggle='modal' data-target='#modalTalleres{$registro['ID_Registrado']}'>Ver talleres</button>";
                            
                          echo "</td>";
                            
                          echo "<td>" . $registro['nombre_regalo'] . "</td>";
                          echo "<td>$ " . $registro['total_pagado'] . "</td>";
                          echo "<td><a href='editar-usuario.php?id=" . $registro['ID_Registrado'] . "' class='btn bg-orange btn-flat margin'><i class='fa fa-pencil-alt'></i></a><a href='#' data-id='{$registro["ID_Registrado"]}' data-tipo='usuario' class='btn bg-maroon btn-flat margin borrar_registro'><i class='fa fa-trash'></i></a></td>"; // Da el error de cellIndex cuando no coincide el número de td con el de th
                          echo "</tr>";

                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- .col-xs-12 -->
      </div>
      <!-- .row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php

    $query->close();
    $conn->close();

    }

    include_once 'templates/footer.php';

?>
