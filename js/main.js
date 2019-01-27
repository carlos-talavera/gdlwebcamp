(function () {

  var regalo = document.getElementById('regalo');

  document.addEventListener('DOMContentLoaded', function() {

      if(document.getElementById('mapa')) {

      var map = L.map('mapa').setView([20.573392, -100.382874], 17);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      L.marker([20.573392, -100.382874]).addTo(map)
      .bindPopup('GDLWebCamp 2018 <br> Boletos ya disponibles')
      .openPopup()
      .bindTooltip('Un Tooltip')
      .openTooltip();

    }

    // Campos Datos Usuarios

    var nombre = document.getElementById('nombre');
    var apellido = document.getElementById('apellido');
    var email = document.getElementById('email');

    // Campos pases

    var pase_dia = document.getElementById('pase_dia');
    var pase_dosdias = document.getElementById('pase_dosdias');
    var pase_completo = document.getElementById('pase_completo');

    // Botones y divs

    var calcular = document.getElementById('calcular');
    var errorDiv = document.getElementById('error');
    var botonRegistro = document.getElementById('btnRegistro');
    var lista_productos = document.getElementById('lista-productos');
    var suma = document.getElementById('suma-total');

    // Extras

    var etiquetas = document.getElementById('etiquetas');
    var camisas = document.getElementById('camisa_evento');

    if(botonRegistro) {

    botonRegistro.disabled = true; // Deshabilitar un botón

    }

    if(document.getElementById('calcular')) {

    calcular.addEventListener('click', calcularMontos);

    pase_dia.addEventListener('blur', mostrarDias);
    pase_dosdias.addEventListener('blur', mostrarDias);
    pase_completo.addEventListener('blur', mostrarDias);

    nombre.addEventListener('blur', validarCampos);
    apellido.addEventListener('blur', validarCampos);
    email.addEventListener('blur', validarCampos);
    email.addEventListener('blur', validarMail);

    function validarCampos() {

      if(this.value == "") {

      errorDiv.style.display = "block";
      errorDiv.innerHTML = "Este campo es obligatorio";
      this.style.border = "1px solid red";

    } else {

      errorDiv.style.display = "none";
      this.style.border = "1px solid #cccccc";

    }

    }

    function validarMail() {

      if(this.value.indexOf("@") > -1) {

        errorDiv.style.display = "none";
        this.style.border = "1px solid #cccccc";

      } else {

        errorDiv.style.display = "block";
        errorDiv.innerHTML = "Debe tener al menos una @";
        this.style.border = "1px solid red";

      }

    }

    function calcularMontos(event) {

      event.preventDefault();

      if(regalo.value === "") {

        alert('Debes elegir un regalo');
        regalo.focus(); // Resaltar el campo incompleto

      } else {

        var boletosDia = parseInt(pase_dia.value, 10) || 0,
            boletosDosDias = parseInt(pase_dosdias.value, 10) || 0,
            boletoCompleto = parseInt(pase_completo.value, 10) || 0,
            cantidadCamisas = parseInt(camisas.value, 10) || 0,
            cantidadEtiquetas = parseInt(etiquetas.value, 10) || 0;

        var totalPagar = (boletosDia * 30) + (boletosDosDias * 45) + (boletoCompleto * 50) + (cantidadCamisas * 10 * 0.93) + (cantidadEtiquetas * 2);

        var listadoProductos = [];

        if(boletosDia > 0) {

          if(boletosDia == 1) {

            listadoProductos.push(boletosDia + " Pase por día");

          } else {

            listadoProductos.push(boletosDia + " Pases por día");

        }

        }

        if(boletosDosDias > 0) {

          if(boletosDosDias == 1) {

            listadoProductos.push(boletosDosDias + " Pase por dos días");

          } else {

            listadoProductos.push(boletosDosDias + " Pases por dos días");

        }

        }

        if(boletoCompleto > 0) {

          if(boletoCompleto == 1) {

            listadoProductos.push(boletoCompleto + " Pase Completo");

          } else {

            listadoProductos.push(boletoCompleto + " Pases Completos");

        }

        }

        if(cantidadCamisas > 0) {

          if(cantidadCamisas == 1) {

            listadoProductos.push(cantidadCamisas + " Camisa");

          } else {

            listadoProductos.push(cantidadCamisas + " Camisas");

          }

        }

        if(cantidadEtiquetas > 0) {

          if(cantidadEtiquetas == 1) {

            listadoProductos.push(cantidadEtiquetas + " Paquete de etiquetas");

          } else {

          listadoProductos.push(cantidadEtiquetas + " Paquetes de etiquetas");

        }

        }

        lista_productos.style.display = "block";

        lista_productos.innerHTML = ''; // Lo inicializamos vacío para que no se reescriba todo, para que no se escriba abajo toda la información nueva, solo se reemplace

        for(var i = 0; i < listadoProductos.length; i++) {

          lista_productos.innerHTML += listadoProductos[i] + "<br>";

        }

        suma.innerHTML = "$ " + totalPagar.toFixed(2);

        botonRegistro.disabled = false;

        document.getElementById('total_pedido').value = totalPagar;

      }

    }

    function mostrarDias() {

      var boletosDia = parseInt(pase_dia.value, 10) || 0,
          boletosDosDias = parseInt(pase_dosdias.value, 10) || 0,
          boletoCompleto = parseInt(pase_completo.value, 10) || 0;

      var diasElegidos = [];

      var viernes = document.getElementById('viernes');
      var sabado = document.getElementById('sabado');
      var domingo = document.getElementById('domingo');

      viernes.style.display = "none",
      sabado.style.display = "none",
      domingo.style.display = "none";

      if(boletosDia > 0 && boletosDosDias == 0 && boletoCompleto == 0) {

        diasElegidos.push("viernes");

      }

      if(boletosDosDias > 0 && boletoCompleto == 0) {

        diasElegidos.push("viernes", "sabado");

      }

      if(boletoCompleto > 0) {

        diasElegidos.push("viernes", "sabado", "domingo");

      }

      for(var i = 0; i < diasElegidos.length; i++) {

        document.getElementById(diasElegidos[i]).style.display = "block";

      }

    }

  }



  });

})();

$(function() {

  // Cambiar tipografía con el plugin Lettering

  $('.nombre-sitio').lettering();

  // Menú fijo

  var windowHeight = $(window).height(); // Alto de la ventana

  var barraAltura = $('.barra').innerHeight(); // Alto de la barra que queremos dejar fija

  $(window).scroll(function() {

    var scroll = $(window).scrollTop(); // Importante para que funcione la detección del scroll, scrollTop detecta como, todo el desplazamiento dentro de la página

    if(scroll > windowHeight) { // Si la cantidad de pixeles en la que hemos desplazado la barra de navegación es mayor que el alto de la ventana...

      $('.barra').addClass('fixed');
      $('body').css({'margin-top': barraAltura + 'px'}); // Le agregamos margen arriba al body para compensar lo que se le quita a la barra al cambiarla a fixed

    } else {

      $('.barra').removeClass('fixed');
      $('body').css({'margin-top': '0px'}); // Se lo quitamos

    }

  });

  // Menú movil, menú hamburguesa

  $('.menu-movil').on('click', function() {

    $('.navegacion-principal').slideToggle(); // Mezcla de slideUp y slideDown, detecta cuándo está abajo y cuándo está arriba
    // Entonces si está abajo, sube y si está arriba, baja

  });

  // Programa de conferencias

  $('.programa-evento .info-curso:first').show();
  $('.menu-programa a:first').addClass('activo');

  $('.menu-programa a').on('click', function() {

    $('.menu-programa a').removeClass('activo');
    $(this).addClass('activo');
    $('.ocultar').hide();
    var enlace = $(this).attr('href');
    $(enlace).fadeIn(1000);

    return false;

  });

  // Animaciones para los números

  $('.resumen-evento li:nth-child(1) p').animateNumber({number: 6}, 1200); // Método de la librería animateNumber
  $('.resumen-evento li:nth-child(2) p').animateNumber({number: 15}, 1200);
  $('.resumen-evento li:nth-child(3) p').animateNumber({number: 3}, 1500);
  $('.resumen-evento li:nth-child(4) p').animateNumber({number: 9}, 1200);

  // Cuenta Regresiva

  $('.cuenta-regresiva').countdown('2019/12/13 09:00:00', function(e) {

    $('#dias').html(e.strftime('%D'));
    $('#horas').html(e.strftime('%H'));
    $('#minutos').html(e.strftime('%M'));
    $('#segundos').html(e.strftime('%S'));

  });

  // Colorbox

  if(document.querySelector('.invitado-info')) {

    $('.invitado-info').colorbox({inline: true, width: "50%"});

  }

  if(document.querySelector('.boton-newsletter')) {

    $('.boton-newsletter').colorbox({inline: true, width: "50%"});

  }

});
