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
        En blanco
        <small>Todo empieza aquí</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Título</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Esconder">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Quitar">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          ¡Empieza a crear tu increíble aplicación!
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Parte inferior
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php 
  
    include_once 'templates/footer.php';
  
  ?>