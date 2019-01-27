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
        Invitado
        <small>Aquí se encuentran todos las invitados registrados</small>
      </h1>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de invitados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="registros" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require '../includes/funciones/bd_conexion.php';

                        $query = $conn->query("SELECT * FROM invitados");

                        while($registro = $query->fetch_assoc()) {

                          echo "<tr>";
                          echo "<td>" . $registro['invitado_id'] . "</td>";
                          echo "<td>" . $registro['nombre_invitado'] . "</td>";
                          echo "<td>" . $registro['apellido_invitado'] . "</td>";
                          echo "<td class='col-md-4'>" . $registro['descripcion'] . "</td>";
                          echo "<td>" . $registro['url_imagen'] . "</td>";
                          echo "<td><a href='editar-invitado.php?id=" . $registro['invitado_id'] . "' class='btn bg-orange btn-flat margin'><i class='fa fa-pencil-alt'></i></a><a href='#' data-id='{$registro["invitado_id"]}' data-tipo='invitado' class='btn bg-maroon btn-flat margin borrar_registro'><i class='fa fa-trash'></i></a></td>"; // Da el error de cellIndex cuando no coincide el número de td con el de th
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
