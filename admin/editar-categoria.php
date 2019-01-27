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

        $query = $conn->query("SELECT * FROM categoria_evento WHERE id_categoria = {$id}");

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
        Edición de categoría
        <small>Actualizar la información de un categoría</small>
      </h1>
    </section>

     <!-- Main content -->
     <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar información de la categoría</h3>
                    </div>
                    <!-- /.box-header -->

                    <form class="editar-categoria" action="#" id="editar-categoria">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nombre_cat">Nombre de la categoría</label>
                                <input type="text" class="form-control" id="nombre_cat" placeholder="Categoría del evento" value="<?php echo $resultados['cat_evento']; ?>">
                                <span id="valid_cat" class="help-block" style="display: none;"></span>
                            </div>
                            <div class="form-group">
                                <label for="icono">Ícono</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                      <i class="<?php echo $resultados['icono']; ?>"></i>
                                  </div>
                                  <input type="text" id="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $resultados['icono']; ?>">
                              </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-default" id="cancel-update" data-tipo="categoria">Cancelar</button>
                            <input type="hidden" id="id_cat_evento" value="<?php echo $resultados['id_categoria']; ?>">
                            <button type="submit" class="btn btn-success pull-right" id="btnActCat">Actualizar</button>
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