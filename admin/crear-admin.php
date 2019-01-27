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
        Crear Administrador
        <small>Llena el formulario para crear un administrador</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

        <!-- Main content -->
        <section class="content">
          
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Administrador</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Esconder">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <form role="form" name="crear-admin" id="crear-admin" action="#" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                        <div class="form-group">
                              <label for="user">Usuario</label>
                              <input type="text" class="form-control" name="user" id="user" placeholder="Ingresa el usuario" autocomplete="off" autofocus>
                              <span class="help-block" id="user_error" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label for="nombre">Nombre</label>
                              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre, incluyendo apellido" autocomplete="off">
                        </div>
                        <div class="form-group">
                              <label for="password">Contraseña</label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Ingresa la contraseña">
                              <span class="help-block" id="valid_pass" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label for="password_rep">Repetir Contraseña</label>
                              <input type="password" class="form-control" name="password" id="password_rep" placeholder="Ingresa la contraseña">
                              <span class="help-block" id="valid_pass_rep" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label class="fot_perf">Foto de perfil</label>
                              <label class="btn btn-file btn-primary">
                              <span class="upload-text">Subir un archivo</span> <input type="file" name="inputFile" id="inputFile" accept="image/*" style="display: none;">
                              </label>
                              <p class="help-block">Formato JPEG, JPG, PNG, GIF</p>
                        </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" name="agregar" id="agregar-admin" class="btn btn-primary" value="Añadir">
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