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
        Crear Invitado
        <small>Llena el formulario para agregar un invitado</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

        <!-- Main content -->
        <section class="content">
          
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Invitado</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Esconder">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <form role="form" name="crear-invitado" id="crear-invitado" action="#" method="POST">
                  <div class="box-body">
                        <div class="form-group">
                              <label for="nombre_inv">Nombre</label>
                              <input type="text" class="form-control" id="nombre_inv" placeholder="Ingresa el nombre del invitado" autofocus>
                              <span class="help-block" id="valid_name" style="display: none;"></span>      
                        </div>
                        <div class="form-group">
                              <label for="ape_inv">Apellido</label>
                              <input type="text" class="form-control" id="ape_inv" placeholder="Ingresa el apellido del invitado">
                              <span class="help-block" id="valid_ape" style="display: none;"></span>  
                        </div>
                        <div class="form-group">
                              <label for="descripcion">Descripción</label>
                              <textarea class="form-control" id="descripcion" placeholder="Ingresa la descripción" rows="8" cols="80"></textarea>
                              <span class="help-block" id="valid_desc" style="display: none;"></span>  
                        </div>
                        <div class="form-group">
                              <label class="fot_inv">Foto</label>
                              <label class="btn btn-file btn-primary">
                              <span class="upload-text">Subir un archivo</span> <input type="file" name="inputFile" id="inputFile" accept="image/*" style="display: none;">
                              </label>
                              <p class="help-block">Las dimensiones de la imagen deben estar entre 350 x 200 y 650 x 500</p>
                              <p class="help-block">Formato JPEG, JPG, PNG, GIF</p>
                        </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" name="agregar" id="agregar-invitado" class="btn btn-primary" value="Añadir">
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