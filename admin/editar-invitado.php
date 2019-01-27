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

        $query = $conn->query("SELECT * FROM invitados WHERE invitado_id = {$id}");

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
        Edición de invitado
        <small>Actualizar la información de un invitado</small>
      </h1>
    </section>

     <!-- Main content -->
     <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar información del invitado</h3>
                    </div>
                    <!-- /.box-header -->

                    <form class="editar-invitado" action="#" id="editar-invitado">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nombre_inv">Nombre</label>
                                <input type="text" class="form-control" id="nombre_inv" placeholder="Nombre" value="<?php echo $resultados['nombre_invitado']; ?>">
                                <span class="help-block" id="valid_name" style="display: none;"></span>
                            </div>
                            <div class="form-group">
                                <label for="ape_inv">Apellido</label>
                                <input type="text" class="form-control" id="ape_inv" placeholder="ape_inv" value="<?php echo $resultados['apellido_invitado']; ?>">
                                <span class="help-block" id="valid_ape" style="display: none;"></span>  
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" value="<?php echo $resultados['descripcion']; ?>">
                                <span class="help-block" id="valid_desc" style="display: none;"></span>
                            </div>
                            <div class="form-group">
                                <label>Imagen actual</label>
                                <img src="../img/invitados/<?php echo $resultados['url_imagen']; ?>" alt="Imagen actual del invitado con el ID <?php echo $id; ?>" style="display: block; width: 50%; height: 50%;">
                            </div>
                            <div class="form-group">
                                <label class="fot_inv">Foto</label>
                                <label class="btn btn-file btn-success">
                                <span class="upload-text">Subir un archivo</span> <input type="file" name="inputFile" id="inputFile" accept="image/*" style="display: none;">
                                </label>
                                <input type="hidden" id="id_invitado" value="<?php echo $id; ?>">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-default" id="cancel-update" data-tipo="invitado">Cancelar</button>
                            <button type="submit" class="btn btn-success pull-right" id="btnActInv">Actualizar</button>
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