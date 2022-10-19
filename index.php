<?php
require_once "Config/Autoload.php";
Config\Autoload::run();

$template = new Clases\TemplateSite();
$contenidos = new Clases\Contenidos();

$data_galeria_pricipal = [
    "images" => true,
    "filter" => ['contenidos.cod = "slider-inicio"']
];

$galeria_principal = $contenidos->list($data_galeria_pricipal, 'es', true);

$data_galeria_inicio = [
    "images" => true,
    "filter" => ['contenidos.cod = "marcas-inicio"']
];

$galeria_inicio = $contenidos->list($data_galeria_inicio, 'es', true);
$sobre_nosotros_inicio = $contenidos->list(["filter" => ['contenidos.cod = "sobre-nosotros-inicio"']], 'es', true);

// $why_us_titulo = $contenidos->list(["filter" => ['contenidos.cod = "acordeon-titulo"']], 'es', true);
$why_us = $contenidos->list(["images" => true, "filter" => ['contenidos.area = "texto-acordeon"']], 'es');
$why_us_list = $why_us;
unset($why_us_list['acordeon-titulo']);
$template->themeInit();
?>
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1><?= $galeria_principal['data']['titulo'] ?></h1>
                <h2><?= $galeria_principal['data']['contenido'] ?></h2>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="<?= $galeria_principal['images'][0]['url'] ?>" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section>
<!-- ======= Clients Section ======= -->
<section id="clients" class="clients section-bg">
    <div class="container">

        <div class="row" data-aos="zoom-in">
            <?php foreach ($galeria_inicio['images'] as $key => $item) { ?>
                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                    <img src="<?php echo $item['url'] ?>" class="img-fluid" alt="">
                </div>
            <?php } ?>
        </div>

    </div>
</section><!-- End Cliens Section -->
<main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2><?= $sobre_nosotros_inicio['data']['titulo'] ?></h2>
            </div>
            <?= $sobre_nosotros_inicio['data']['contenido'] ?>
            <a href="<?= $sobre_nosotros_inicio['data']['link'] ?>" class="btn-learn-more">Ver mas</a>
        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                    <div class="content">
                        <h3><?= $why_us['acordeon-titulo']['data']['titulo']; ?></h3>
                        <p>
                            <?= $why_us['acordeon-titulo']['data']['contenido']; ?>
                        </p>
                    </div>

                    <div class="accordion-list">
                        <ul>
                            <?php
                            $i = 0;
                            foreach ($why_us_list as $key => $item) {
                                $i++;
                            ?>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-<?= $i ?>">
                                        <span><?= 0, $i ?></span> <?= $item['data']['titulo'] ?>
                                        <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i>
                                    </a>
                                    <div id="accordion-list-<?= $i ?>" class="collapse " data-bs-parent=".accordion-list">
                                        <p>
                                            <?= $item['data']['contenido']; ?>
                                    </div>
                                </li>
                            <?php } ?>


                        </ul>
                    </div>

                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("<?= $why_us['acordeon-titulo']['images'][0]['url']; ?>");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
            </div>

        </div>
    </section><!-- End Why Us Section -->
</main>
<?php
$template->themeend();
?>