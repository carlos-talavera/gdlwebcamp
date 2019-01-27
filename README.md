# GDLWebCamp

En este proyecto todos los archivos externos utilizados fueron almacenados localmente, pero de cualquier manera se pueden utilizar las versiones del CDN

## Edición de los pagos con PayPal

En el archivo paypal.php (/includes/paypal.php) se encuentra la clave secreta y la clave del cliente, ahí se cambiarían por las de su aplicación:

```php
<?php

require 'paypal/autoload.php'; // Librería almacenada localmente

define("URL_SITIO", ""); // Crear una constante para utilizar el dominio general del sitio, por ejemplo 'http://localhost/gdlwebcamp'

$apiContext = new \PayPal\Rest\ApiContext(

  new \PayPal\Auth\OAuthTokenCredential(
    '', // ClienteID - Clave del cliente
    '' // Clave Secreta
  )

);
```

## Uso de Fetch API y AJAX

El proyecto utiliza tanto lo más reciente, Fetch API, como AJAX, además se combina jQuery con JS, y se trata la subida de imágenes al servidor mediante estas dos formas.

Lo cual hace de él un trabajo muy completo que permitirá a los que necesiten una zona de administración, un sitio web para un evento, aprender de aquí y sacar adelante su propia idea.

## Versiones utilizadas en este proyecto

- PHP - 7
- JS - ES6