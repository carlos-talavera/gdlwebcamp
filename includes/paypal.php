<?php

require 'paypal/autoload.php';

define("URL_SITIO", "http://localhost/gdlwebcamp"); // Crear una constante para utilizar el dominio general del sitio

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    'AQ_mdXqUq_MEDCCic9HTrsgVUkBwOK0vYNFrC-X4-5DxeewtEK3H92H-PQ8w4pVk9QF4QZiCkToclshv', // ClienteID
    'EKkbazGZBwVVSqTgthMxfEiS6OTtuO0oZS3qE5qYt6v72TrPOcTYLBOuNVwmp9-bLypaw_bMeiggcB8c' // Secret
  )
);
