<?php

require 'paypal/autoload.php';

define("URL_SITIO", ""); // Crear una constante para utilizar el dominio general del sitio, por ejemplo 'http://localhost/gdlwebcamp'

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    '', // ClienteID
    '' // Secret
  )
);
