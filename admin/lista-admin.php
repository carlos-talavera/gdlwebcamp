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
        Administradores
        <small>Aquí se encuentran todos los administradores registrados</small>
      </h1>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de administradores</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="registros" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Foto</th>
                            <th>Antigüedad</th>
                            <th>Última Edición (YYYY/MM/DD hh:mm:ss)</th>
                            <th>Nivel</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require '../includes/funciones/bd_conexion.php';

                        $query = $conn->query("SELECT id_admin, usuario, nombre, foto_perfil, fecha_registro, ult_edicion, nivel FROM admins");

                        while($registro = $query->fetch_assoc()) {

                          echo "<tr>";
                          echo "<td>" . $registro['id_admin'] . "</td>";
                          echo "<td>" . $registro['usuario'] . "</td>";
                          echo "<td>" . $registro['nombre'] . "</td>";
                          echo "<td>" . $registro['foto_perfil'] . "</td>";//<img src='img/admins/" . $registro['foto_perfil'] . "' style='max-width: 10%; max-height: 50%; padding: 0!important; margin: 0!important;'></td>";
                          echo "<td>" . fechas($registro['fecha_registro']) . "</td>";
                          echo "<td>" . $registro['ult_edicion'] . "</td>";
                          echo "<td>" . $registro['nivel'] . "</td>";
                          echo "<td><a href='editar-admin.php?id=" . $registro['id_admin'] . "' class='btn bg-orange btn-flat margin'><i class='fa fa-pencil-alt'></i></a><a href='#' data-id='{$registro["id_admin"]}' data-tipo='admin' class='btn bg-maroon btn-flat margin borrar_registro'><i class='fa fa-trash'></i></a></td>"; // Da el error de cellIndex cuando no coincide el número de td con el de th
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
