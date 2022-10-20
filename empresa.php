<?php
require_once "Config/Autoload.php"; //arreglar el unset
Config\Autoload::run();

$template = new Clases\TemplateSite();
$f = new Clases\PublicFunction();
$contenidos = new Clases\Contenidos();

$data = [
    "filter" => ['contenidos.cod = "sobre-nosotros-inicio"'],
    "images" => true,
    
];

#List de contenidos (al ser único el título, solo trae un resultado)
$contenidoData = $contenidos->list($data, $_SESSION["lang"], true);
#Si se encontro el contenido se almacena y sino se redirecciona al inicio
if (empty($contenidoData)) $f->headerMove(URL);
#Información de cabecera
$template->set("title", $contenidoData['data']['titulo'] . " | " . TITULO);
$template->set("description", $contenidoData['data']['description']);
$template->set("keywords", $contenidoData['data']['keywords']);
$template->set("imagen", isset($contenidoData['data']['images'][0]['url']) ? $contenidoData['data']['images'][0]['url'] : LOGO);
$template->themeInit();
?>

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php"><?= $contenidoData['area']['data']['titulo'] ?></a></li>
                <li><?= $contenidoData['data']['titulo'] ?></li>
            </ol>
            <h2><?= $contenidoData['data']['titulo'] ?></h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <p>
                <?= $contenidoData['data']['contenido'] ?>
            </p>
        </div>
    </section>

<?php
$template->themeEnd();
?>