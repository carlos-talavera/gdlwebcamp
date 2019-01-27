<footer class="site-footer">
    <div class="contenedor clearfix">
        <ul class="contenedores-footer clearfix">
          <li>
            <div class="contenido-footer clearfix">
            <h3><span>Sobre</span> GdlWebCamp</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </li>
          <li>
            <div class="contenido-footer clearfix">
            <h3><span>Últimos</span> Tweets</h3>
            <a class="twitter-timeline" data-height="400" data-theme="light" data-link-color="#fe4918" href="https://twitter.com/CharlieT0218?ref_src=twsrc%5Etfw">Tweets by CharlieT0218</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>
          </li>
          <li>
            <div class="contenido-footer clearfix">
            <h3><span>Redes</span> Sociales</h3>
              <nav class="redes-sociales">
                  <a href="https://facebook.com/carlos.e.talavera" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a href="https://twitter.com/@CharlieT0218" target="_blank"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-pinterest" target="_blank"></i></a>
                  <a href="#"><i class="fab fa-youtube" target="_blank"></i></a>
                  <a href="https://instagram.com/carlos_talavera18" target="_blank"><i class="fab fa-instagram"></i></a>
              </nav> <!--.redes-sociales-->
            </div> <!--.contenido-footer-->
          </li>
      </ul> <!--.contenedores-footer-->
  </div> <!--.contenedor-->
  <p class="copyright">Todos los Derechos Reservados GDLWEBCAMP 2019 &copy;</p>
</footer> <!--.contenedor-inferor-->

  <!-- Begin MailChimp Signup Form -->
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
  	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
  	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>
  <div style="display:none;">
  <div id="mc_embed_signup">
    <form action="https://gdlwebcamp.us19.list-manage.com/subscribe/post?u=c8875da1da1744ed059f30064&amp;id=5bcc136c8b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
    	<h2>Suscríbete al newsletter y no te pierdas nada de este evento</h2>
    <div class="indicates-required"><span class="asterisk">*</span> campos obligatorios</div>
    <div class="mc-field-group">
    	<label for="mce-EMAIL">Correo electrónico  <span class="asterisk">*</span>
    </label>
    	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
    </div>
    	<div id="mce-responses" class="clear">
    		<div class="response" id="mce-error-response" style="display:none"></div>
    		<div class="response" id="mce-success-response" style="display:none"></div>
    	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_c8875da1da1744ed059f30064_5bcc136c8b" tabindex="-1" value=""></div>
        <div class="clear"><input type="submit" value="Suscríbete" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </div>
    </form>
    </div>
  </div>
  <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
  <!--End mc_embed_signup-->

<script src="js/vendor/modernizr-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.lettering.js"></script>

<?php

  $archivo = basename($_SERVER['PHP_SELF']);
  $pagina = str_replace(".php", "", $archivo);

  if($pagina == "invitados" || $pagina == "index") {

    echo '<script src="js/jquery.colorbox-min.js"></script>';

  }

  else if($pagina == "conferencia") {

    echo '<script src="js/lightbox.js"></script>">';

  }

?>

<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
  ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>
