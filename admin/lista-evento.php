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
        Eventos
        <small>Aquí se encuentran todos los eventos registrados</small>
      </h1>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de eventos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="registros" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Categoría</th>
                            <th>Invitado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require '../includes/funciones/bd_conexion.php';

                        $query = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado FROM eventos ";
                        $query .= "INNER JOIN categoria_evento ";
                        $query .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                        $query .= "INNER JOIN invitados ";
                        $query .= "ON eventos.id_inv = invitados.invitado_id ";
                        $query .= "ORDER BY evento_id;";

                        $resultado = $conn->query($query);

                        while($registro = $resultado->fetch_assoc()) {
                          
                          echo "<tr>";
                          echo "<td>" . $registro['evento_id'] . "</td>";
                          echo "<td>" . $registro['nombre_evento'] . "</td>";
                          echo "<td>" . $registro['fecha_evento'] . "</td>";
                          echo "<td>" . $registro['hora_evento'] . "</td>";
                          echo "<td>" . $registro['cat_evento'] . "</td>";
                          echo "<td>" . $registro['nombre_invitado'] . " " . $registro['apellido_invitado'] . "</td>";
                          echo "<td><a href='editar-evento.php?id=" . $registro['evento_id'] . "' class='btn bg-orange btn-flat margin'><i class='fa fa-pencil-alt'></i></a><a href='#' data-id='{$registro["evento_id"]}' data-tipo='evento' class='btn bg-maroon btn-flat margin borrar_registro'><i class='fa fa-trash'></i></a></td>"; // Da el error de cellIndex cuando no coincide el número de td con el de th
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

    $resultado->close();
    $conn->close();

    }

    include_once 'templates/footer.php';

?>
