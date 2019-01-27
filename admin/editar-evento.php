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

        $query = $conn->query("SELECT * FROM eventos WHERE evento_id = {$id}");

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
        Edición de evento
        <small>Actualizar la información de un evento</small>
      </h1>
    </section>

     <!-- Main content -->
     <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar información del evento</h3>
                    </div>
                    <!-- /.box-header -->

                    <form class="editar-evento" action="#" id="editar-evento">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nombre_evento">Evento</label>
                                <input type="text" class="form-control valores" id="nombre_evento" placeholder="Usuario" value="<?php echo $resultados['nombre_evento']; ?>">
                                <span id="valid_evt" class="help-block" style="display: none;"></span>
                            </div>
                            <div class="form-group">
                              <label>Categoría</label>
                              <select class="form-control seleccionar categoria" name="categoria" style="width: 100%;">
                                  <option value="0">-Seleccione-</option>
                                  <?php
                                  
                                    $resultCat = cat_inv("categoria");
                                    $idsCat = $resultCat[0];
                                    $categorias = $resultCat[1];
                                    
                                    for($i = 0; $i < count($categorias); $i++) {

                                        if($idsCat[$i] === $resultados['id_cat_evento']) {

                                            echo "<option value='{$idsCat[$i]}' selected='selected'>{$categorias[$i]}</option>";

                                        } else {

                                            echo "<option value='{$idsCat[$i]}'>{$categorias[$i]}</option>";

                                        }

                                    }
                                  
                                  ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <label>Invitado</label>
                                <select class="form-control seleccionar invitado" name="invitado" style="width: 100%;">
                                    <option value="0">-Seleccione-</option>
                                    <?php

                                        $resultInv = cat_inv("invitado");
                                        $idsInv = $resultInv[0];
                                        $invitados = $resultInv[1];
                                    
                                        for($x = 0; $x < count($invitados); $x++) {

                                            if($idsInv[$x] === $resultados['id_inv']) {

                                                echo "<option value='{$idsInv[$x]}' selected='selected'>{$invitados[$x]}</option>";

                                            } else {

                                                echo "<option value='{$idsInv[$x]}'>{$invitados[$x]}</option>";

                                            }

                                        }
                                    
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fecha</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right valores" id="fecha" value="<?php echo date("Y/m/d", strtotime($resultados['fecha_evento'])); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hora</label>
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker valores" id="hora" value="<?php echo $resultados['hora_evento']; ?>">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" id="id_evt" value="<?php echo $resultados['evento_id']; ?>">
                            <button class="btn btn-default" id="cancel-update" data-tipo="evento">Cancelar</button>
                            <button type="submit" class="btn btn-success pull-right" id="btnActEvt">Actualizar</button>
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