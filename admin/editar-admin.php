<?php

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        if(!filter_var($id, FILTER_VALIDATE_INT)) {

            header('location: admin-area.php');

        }

    } else {

        header('location: admin-area.php');

    }

    require_once '../includes/funciones/bd_conexion.php';

    try {

        $query = $conn->query("SELECT * FROM admins WHERE id_admin = {$id}");

        if($query->num_rows > 0) {

            $resultados = $query->fetch_assoc();

        } else {

            header('location: admin-area.php'); // Si no existe el id

        }

    } catch(Exception $e) {

        die($e->getMessage());

    }

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
        Edición de administrador
        <small>Actualizar la información de un administrador</small>
      </h1>
    </section>

     <!-- Main content -->
     <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar información del administrador</h3>
                    </div>
                    <!-- /.box-header -->

                    <form class="editar-admin" action="#" id="editar-admin">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="user">Usuario</label>
                                <input type="text" class="form-control" id="user" placeholder="Usuario" value="<?php echo $resultados['usuario']; ?>">
                                <span id="user_valid" class="help-block" style="display: none;"></span>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $resultados['nombre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nivel">Nivel</label>
                                <input type="number" max="1" min="0" class="form-control" id="nivel" value="<?php echo $resultados['nivel']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Editar contraseña</label>
                                <label class="switch pull-right">
                                    <input type="checkbox" id="switch">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="passwords ocultar" style="display: none;">
                                <div class="form-group">
                                    <label for="old_pass">Contraseña anterior</label>
                                    <input type="password" class="form-control" id="old_pass" placeholder="Contraseña actual">
                                    <span class="help-block" id="old_pass_valid" style="display: none;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="new_pass">Contraseña nueva</label>
                                    <input type="password" class="form-control" id="new_pass" placeholder="Contraseña nueva" readonly>
                                    <span id="new_pass_valid" class="help-block" style="display: none;"></span>
                                </div>
                            </div>
                            <!-- /.passwords -->
                            <div class="form-group">
                                <label class="fot_perf">Foto de perfil</label>
                                <label class="btn btn-file btn-success">
                                <span class="upload-text">Subir un archivo</span> <input type="file" name="inputFile" id="inputFile" accept="image/*" style="display: none;">
                                </label>
                                <input type="hidden" id="id_admin" value="<?php echo $id; ?>">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-default" id="cancel-update" data-tipo="admin">Cancelar</button>
                            <button type="submit" class="btn btn-success pull-right" id="btnActAdm">Actualizar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- .row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php

$query->close();
$conn->close();

include_once 'templates/footer.php';

?>