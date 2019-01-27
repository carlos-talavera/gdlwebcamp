<?php

  if(isset($_POST['enviar'])) {

      setlocale(LC_ALL, "es_ES");

      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $email = $_POST['email'];
      $regalo = $_POST['regalo'];
      $total = $_POST['total_pedido'];
      $fecha = date('Y-m-d H:i:s');

      // Pedidos

      $boletos = $_POST['boletos'];
      $camisas = $_POST['pedido_camisas'];
      $etiquetas = $_POST['pedido_etiquetas'];

      include_once 'includes/funciones/funciones.php';

      $pedido = productos_json($boletos, $camisas, $etiquetas);

      // Eventos

      $eventos = $_POST['registro'];
      $registro = eventos_json($eventos);

      try {

        require_once 'includes/funciones/bd_conexion.php';
        $stmt = $conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); // stmt = statement
        $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header('location: ' . $_SERVER['PHP_SELF'] . '?exitoso');

      }

      catch (exception $e) {

        die('Ha ocurrido un error: ' . $e->getMessage());

      }

    }

    ?>

  <?php include_once 'includes/templates/header.php'; ?>

<section class="seccion contenedor">
  <h2>Resumen Registro</h2>

  <?php if(isset($_GET['exitoso'])) {

      echo "<h3>Registro exitoso</h3>";

  } else {

    header('location: index.php');

  }

  ?>

</section>

<?php

include_once 'includes/templates/footer.php';

?>
