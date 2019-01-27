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
        Crear Categoría
        <small>Llena el formulario para crear una categoría</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

        <!-- Main content -->
        <section class="content">
          
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Categoría</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Esconder">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <form role="form" name="crear-categoria" id="crear-categoria" action="#" method="POST">
                  <div class="box-body">
                        <div class="form-group">
                              <label for="nombre_cat">Nombre de la categoría</label>
                              <input type="text" class="form-control" id="nombre_cat" placeholder="Ingresa el nombre de la categoría" autofocus>
                              <span class="help-block" id="valid_cat" style="display: none;"></span>
                        </div>
                        <div class="form-group">
                              <label for="icono">Ícono</label>
                              <div class="input-group">
                                  <div class="input-group-addon">
                                      <i></i>
                                  </div>
                                  <input type="text" id="icono" class="form-control pull-right" placeholder="fa-icon">
                              </div>
                        </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" name="agregar" id="agregar-categoria" class="btn btn-primary" value="Añadir">
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