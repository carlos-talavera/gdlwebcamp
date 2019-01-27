<?php

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;

require 'includes/paypal.php';
require_once 'includes/funciones/bd_conexion.php';

$query = $conn->query("SELECT * FROM registrados WHERE ID_Registrado = {$_GET['id_pago']}");

if(!$query || !isset($_GET['paymentId'], $_GET['token'], $_GET['PayerID'])) {

  header('location: index.php?troll');

} else {

include_once 'includes/templates/header.php';

?>

      <div class="formulario">

            <?php

            echo "<title>Resumen registro</title>";

            echo "<h2>Resumen registro</h2>";

              $paymentId = $_GET['paymentId'];
              $idPago = (int) $_GET['id_pago'];

              // Validación OP de PayPal

              // Petición a REST API

              $pago = Payment::get($paymentId, $apiContext); // No hay que instanciarla porque es estática, pedimos el pago que queremos
              $execution = new PaymentExecution();
              $execution->setPayerId($_GET['PayerID']); // Buscamos por el ID del comprador

              // Resultado tiene la información de la transacción

              $resultado = $pago->execute($execution, $apiContext);

              $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state; // Debe contener "completed"

              //var_dump($respuesta);

              if($respuesta === "completed") {

                echo "<center><p>El pago con el ID " . $paymentId . " se realizó correctamente</p></center>";

                $stmt = $conn->prepare("UPDATE registrados SET pagado = ? WHERE ID_Registrado = ?");
                $pagado = 1;
                $stmt->bind_param("ii", $pagado, $idPago);
                $stmt->execute();
                $stmt->close();
                $conn->close();

              } else {

                header('location: registro.php?cancel');

              }

            ?>
        </div>
<?php

include_once 'includes/templates/footer.php';

}

?>
