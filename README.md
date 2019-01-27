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

## LeafletJS

Para la creación de este proyecto se utilizó la librería open-source LeafletJS, enfocada a los mapas interactivos, para cambiar la ubicación del lugar basta con editar el archivo main.js (js/main.js), en la línea 9:

```js
var map = L.map('mapa').setView([20.573392, -100.382874], 17); // Aquí se cambian las coordenadas por las que requeridas

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      L.marker([20.573392, -100.382874]).addTo(map) // Agregar un tooltip, un mensaje flotante con información relevante del evento
      .bindPopup('GDLWebCamp 2018 <br> Boletos ya disponibles')
      .openPopup()
      .bindTooltip('Un Tooltip')
      .openTooltip();
```

## Uso de Fetch API y AJAX

El proyecto utiliza tanto lo más reciente, Fetch API, como AJAX, además se combina jQuery con JS, y se trata la subida de imágenes al servidor mediante estas dos formas.

Lo cual hace de él un trabajo muy completo que permitirá a los que necesiten una zona de administración, un sitio web para un evento, aprender de aquí y sacar adelante su propia idea.

## Uso de AdminLTE

AdminLTE es uno de los templates más utilizados para zonas de administración, este proyecto trata muchas de sus funcionalidades, formularios, botones, checkbox personalizados, entre muchas otras cosas.

## Versiones utilizadas en este proyecto

- PHP - 7
- JS - ES6