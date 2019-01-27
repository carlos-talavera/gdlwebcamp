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
        Dashboard
        <small>Información sobre el evento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="chart">
                    <canvas id="registros_dia" style="height:230px"></canvas>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- ./row -->

        <h2 class="page-header">Resumen de Registros</h2>

        <div class="row">
            <div class="col-lg-3 col-xs-6">

                <?php
                
                    require_once '../includes/funciones/bd_conexion.php';

                    $sql = "SELECT COUNT(ID_Registrado) AS registrados FROM registrados";
                    $query = $conn->query($sql);

                    $resultado = $query->fetch_assoc();
                
                ?>

                <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3><?php echo $resultado['registrados']; ?></h3>

                    <p>Total registrados</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-user"></i>
                    </div>
                    <a href="lista-usuario.php" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">

                <?php
                
                    $sql = "SELECT COUNT(ID_Registrado) AS registrados FROM registrados WHERE pagado = 1";
                    $query = $conn->query($sql);

                    $resultado = $query->fetch_assoc();
                
                ?>

                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3><?php echo $resultado['registrados']; ?></h3>

                    <p>Total pagados</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">

                <?php
                
                    $sql = "SELECT COUNT(ID_Registrado) AS registrados FROM registrados WHERE pagado = 0";
                    $query = $conn->query($sql);

                    $resultado = $query->fetch_assoc();
                
                ?>

                <div class="small-box bg-red">
                    <div class="inner">
                    <h3><?php echo $resultado['registrados']; ?></h3>

                    <p>Total sin pagar</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-user-times"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">

                <?php
                
                    $sql = "SELECT SUM(total_pagado) AS ganancias FROM registrados WHERE pagado = 1";
                    $query = $conn->query($sql);

                    $resultado = $query->fetch_assoc();
                
                ?>

                <div class="small-box bg-green">
                    <div class="inner">
                    <h3>$<?php echo $resultado['ganancias']; ?></h3>

                    <p>Ganancias Totales</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- ./row -->

        <h2 class="page-header">Regalos</h2>

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                
                <?php
                
                    $sql = "SELECT COUNT(total_pagado) AS pulseras FROM registrados WHERE regalo = 1 AND pagado = 1";
                    $query = $conn->query($sql);

                    $resultado = $query->fetch_assoc();
                
                ?>

                <div class="small-box bg-teal">
                    <div class="inner">
                    <h3><?php echo $resultado['pulseras']; ?></h3>

                    <p>Pulseras</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-gift"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                
                <?php
                
                    $sql = "SELECT COUNT(total_pagado) AS etiquetas FROM registrados WHERE regalo = 2 AND pagado = 1";
                    $query = $conn->query($sql);

                    $resultado = $query->fetch_assoc();
                
                ?>

                <div class="small-box bg-maroon">
                    <div class="inner">
                    <h3><?php echo $resultado['etiquetas']; ?></h3>

                    <p>Etiquetas</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-gift"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                
                <?php
                
                    $sql = "SELECT COUNT(total_pagado) AS plumas FROM registrados WHERE regalo = 3 AND pagado = 1";
                    $query = $conn->query($sql);

                    $resultado = $query->fetch_assoc();
                
                ?>

                <div class="small-box bg-purple-active">
                    <div class="inner">
                    <h3><?php echo $resultado['plumas']; ?></h3>

                    <p>Plumas</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-gift"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- ./row -->
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php 
  
    include_once 'templates/footer.php';
  
  ?>