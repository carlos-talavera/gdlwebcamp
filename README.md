# GDLWebCamp

En este proyecto todos los archivos externos utilizados fueron almacenados localmente, pero de cualquier manera se pueden utilizar las versiones del CDN

## Conexión a la BD

Para cambiar los datos de la conexión a la BD hay que ir al archivo bd_conexion.php (includes/funciones/bd_conexion.php), y modificar la creación de la conexión:

```php
<?php

  $conn = new mysqli("host", "usuario", "contraseña", "nombre_bd"); // Editar aquí
  $conn->set_charset("UTF8");
  date_default_timezone_set('America/Mexico_City'); // Cambiar por su región

  if($conn->connect_error) {

    $error = $conn->connect_error;
    echo $error;

  }
```

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

## Uso de Fetch API

El proyecto utiliza lo más reciente, Fetch API, además se combina jQuery con JS, y se trata la subida de imágenes al servidor mediante estas dos formas.

Lo cual hace de él un trabajo muy completo que permitirá a los que necesiten una zona de administración, un sitio web para un evento, aprender de aquí y sacar adelante su propia idea.

## Fetch API

Uso de Fetch API subiendo archivos al servidor (imágenes):

```js
let datos = new FormData();
                datos.append('accion', 'actualizar');
                datos.append('id', id_admin);
                datos.append('usuario', usuario);
                datos.append('nombre', nombre);
                datos.append('nivel', nivel);

                if(passAntigua.value.trim() !== "" && passNueva.value.trim() !== "") { // Validación de campos

                    datos.append('passNueva', passNueva.value);

                }

                if(foto.length > 0) {
                
                    for (let i = 0; i < foto.length; i++) {

                        let file = foto[i];

                        datos.append('inputFile[]', file); // Esto será recibido por el archivo de PHP dentro del array $_FILES

                    }

                }

                fetch(url, {
                    method: 'POST',
                    headers: reqHeaders,
                    body: datos
                }).then(resultados => {
                    return resultados.json();
                }).then(edicion => validar(edicion));
```

## Uso de AdminLTE

AdminLTE es uno de los templates más utilizados para zonas de administración, este proyecto trata muchas de sus funcionalidades, formularios, botones, checkbox personalizados, entre muchas otras cosas.

## Versiones utilizadas en este proyecto

- PHP - 7
- JS - ES6