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
        Crear Evento
        <small>Llena el formulario para crear un evento</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

        <!-- Main content -->
        <section class="content">
          
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear evento</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Esconder">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <form role="form" name="crear-evento" id="crear-evento" action="#">
                  <div class="box-body">
                        <div class="form-group">
                              <label for="nombre_evento">Nombre del evento</label>
                              <input type="text" class="form-control valores" name="nombre_evento" id="nombre_evento" placeholder="Ingresa el nombre del evento" autofocus>
                              <span class="help-block" id="valid_evt" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label>Categoría</label>
                              <select class="form-control seleccionar categoria" name="categoria" style="width: 100%;">
                                  <option value="0" selected="selected">-Seleccione-</option>
                                  <?php
                                  
                                    $resultCat = cat_inv("categoria");
                                    $idsCat = $resultCat[0];
                                    $categorias = $resultCat[1];
                                    
                                    for($i = 0; $i < count($categorias); $i++) {

                                        echo "<option value='{$idsCat[$i]}'>{$categorias[$i]}</option>";

                                    }
                                  
                                  ?>
                              </select>
                        </div>
                        <div class="form-group">
                              <label>Invitado</label>
                              <select class="form-control seleccionar invitado" name="invitado" style="width: 100%;">
                                  <option value="0" selected="selected">-Seleccione-</option>
                                  <?php

                                    $resultInv = cat_inv("invitado");
                                    $idsInv = $resultInv[0];
                                    $invitados = $resultInv[1];
                                  
                                    for($x = 0; $x < count($invitados); $x++) {

                                        echo "<option value='{$idsInv[$x]}'>{$invitados[$x]}</option>";

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
                                <input type="text" class="form-control pull-right valores" id="fecha">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Hora</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker valores" id="hora">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" name="agregar" id="agregar-evento" class="btn btn-primary" value="Añadir">
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