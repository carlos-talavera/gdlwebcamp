<?php

require 'paypal/autoload.php';

define("URL_SITIO", "http://localhost/PayPal"); // Crear una constante para utilizar el dominio general del sitio

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    'AR-EFqNYaBLA1eV6Lo12ORcQoBLDpxQVGGAJS-xtkxHUeX-8EiFp9RlokA8Gdusl5dP2ICJs2MbP63CX', // ClienteID
    'EDZ4uLlZUqOl37z-oZ8AQrG_hCGs7-CfIC3s4q8L7gFs0uYRGrKe1BUxPPCb-iU41K_9uFmh81RIYskr' // Secret
  )
);
