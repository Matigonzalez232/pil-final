<?php
require_once "Config/Autoload.php";
Config\Autoload::run();

$template = new Clases\TemplateSite();
$f = new Clases\PublicFunction();
$contenidos = new Clases\Contenidos();
$config = new Clases\Config();
$enviar = new Clases\Email();
$emailData = $config->viewEmail();
//no funcionan los envios
$captchaData = $config->viewCaptcha();
#Se carga la configuración de email

$contenidoContacto = $contenidos->list(["filter" => ['contenidos.area = "contacto"']], $_SESSION['lang']);
$listaContacto = $contenidoContacto;
unset($listaContacto['contacto-inicio']);
unset($listaContacto['mapa']);
#Información de cabecera
$template->set("title", "Contacto | " . TITULO);
$template->set("description", "Envianos tus dudas y nosotros te asesoramos");
$template->set("keywords", "");
$template->themeInit();
?>
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="index.php">INICIO</a></li>
      <li><?= strtoupper($contenidoContacto[array_key_first($contenidoContacto)]['data']['area']) ?></li>
    </ol>
  </div>
</section>
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2><?= $contenidoContacto['contacto-inicio']['data']['area'] ?></h2>
      <p><?= $contenidoContacto['contacto-inicio']['data']['contenido'] ?></p>
    </div>

    <div class="row">

      <div class="col-lg-5 d-flex align-items-stretch">
        <div class="info">
          <?php foreach ($listaContacto as $key => $item) { ?>

            <div class="address">
              <i class="<?= $item['data']['subtitulo'] ?>"></i>
              <h4><?= $item['data']['titulo'] ?></h4>
              <?= $item['data']['contenido'] ?>
            </div>
          <?php } ?>
          <iframe src="<?= $contenidoContacto['mapa']['data']['link'] ?>" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
        </div>

      </div>

      <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
        <?php
        if (isset($_POST['submit'])) {
          $nombre = isset($_POST["nombre"]) ?  $f->antihack_mysqli($_POST["nombre"]) : '';
          $apellido = isset($_POST["apellido"]) ?  $f->antihack_mysqli($_POST["apellido"]) : '';
          $email = isset($_POST["email"]) ?  $f->antihack_mysqli($_POST["email"]) : '';
          $asunto = isset($_POST["asunto"]) ?  $f->antihack_mysqli($_POST["asunto"]) : '';
          $mensaje = isset($_POST["mensaje"]) ?  $f->antihack_mysqli($_POST["mensaje"]) : '';

          if (!empty($nombre) && !empty($email) && !empty($mensaje) && !empty($apellido)  && !empty($asunto)) {

            //MENSAJE A USUARIO
            $mensajeFinal = "<b>Gracias por realizar tu consulta, te contactaremos a la brevedad.</b><br/>";
            $mensajeFinal .= "<b>Consulta</b>: " . $mensaje . "<br/>";

            $enviar->set("asunto", "Realizaste tu consulta.");
            $enviar->set("receptor", $email);
            $enviar->set("emisor", $emailData['data']['remitente']);
            $enviar->set("mensaje", $mensajeFinal);
            $enviar->emailEnviar();

            //MENSAJE AL ADMIN
            $mensajeFinalAdmin = "<b>Nueva consulta desde la web.</b><br/>";
            $mensajeFinalAdmin .= "<b>Nombre</b>: " . $nombre . " <br/>";
            $mensajeFinalAdmin .= "<b>Apellido</b>: " . $apellido . "<br/>";
            $mensajeFinalAdmin .= "<b>Email</b>: " . $email . "<br/>";
            $mensajeFinalAdmin .= "<b>Asunto</b>: " . $asunto . "<br/>";
            $mensajeFinalAdmin .= "<b>Consulta</b>: " . $mensaje . "<br/>";

            $enviar->set("asunto", "Nueva consulta desde la web :" . $asunto);
            $enviar->set("receptor", $emailData['data']['remitente']);
            $enviar->set("mensaje", $mensajeFinalAdmin);
            $enviar->emailEnviar();
            //mensaje de success
            echo "<div class='alert alert-success'>nofallo</div>";
          } else {
            //echo error
            echo "<div class='alert alert-danger'>fallo</div>";
          }
        }
        ?>
        <form method="post" role="form">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="name">Tu nombre</label>
              <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
              <label for="name">Tu apellido</label>
              <input type="text" name="apellido" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
              <label for="name"> Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Asunto</label>
            <input type="text" class="form-control" name="asunto" required>
          </div>
          <div class="form-group">
            <label for="name">Mensaje</label>
            <textarea class="form-control" name="mensaje" rows="10" required></textarea>
          </div>

          <div class="text-center">
            <button type="submit" name="submit">Enviar Consulta</button>
          </div>
        </form>
      </div>

    </div>

  </div>
</section><!-- End Contact Section -->
<?php $template->themeEnd() ?>