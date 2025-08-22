<!doctype html>
<html lang="pt-br">

<head>
    <?php $render('header/header-tags', $cms_pagina) //meta tags padroes 
    ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
    ?>
        <?php $render('scripts/scripts-header', $script) //scripts do banco do cms 
        ?>

        <?php $render('header/header-import', $cms_pagina) //conteudo comum header 
        ?>

        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/partials/carrossel-depoimentos.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/sobre/sobre.css?v=<?= VERSAO ?>" />

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms 
        ?>

        <link rel="stylesheet" href="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.css" />

    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body class="back_secundario">
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms 
    ?>

    <?php $render('header/menu-modal', $configuracoes); // 
    ?>

    <?php $render('header/top-header', $configuracoes)  //carrega o header contato 
    ?>
    <?php $render('header/header', $configuracoes); //carrega o header 
    ?>


    <?php if (isset($banner)): ?>
        <!-- BANNER HEADER -->
        <div id="banner_header" class="d-flex justify-content-around align-items-center"
            style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
            <h1 class="titulo_principal"> <?= $cms_pagina['titulo_pagina'] ?> </h1>
        </div>
        <!-- END BANNER HEADER -->
    <?php endif ?>


    <!-- SOBRE EMPRESA -->
    <section id="texto_sobre_empresa" class="back_primario">
        <div class="container-fluid">

            <div class="row text-center">
                <div class="col-12 margin-top-20 margin-bottom-30 <?= $cms_pagina['subtitulo_pagina'] == "" ? "hide" : "" ?>">
                    <h2 class="text-center"><?= $cms_pagina['subtitulo_pagina'] ?></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12 margin-bottom-30">
                    <img src="<?= $img_principal['caminho_imagem_conteudo'] ?>" class="img_principal_empresa"
                        width="563" height="422" alt="Imagem sobre a empresa" border="0" />

                    <?php if (isset($texto)): ?>
                        <div class="descricao_empresa color_texto">
                            <?= $texto['descricao_conteudo'] ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>

        </div>
    </section>
    <!-- END SOBRE EMPRESA -->


    <?php if (isset($video)): ?>
        <!-- VIDEO -->
        <?php if (PAGE_SPEED_100): ?>
            <section id="texto_sobre_empresa" class="wrap_video_sobre">
                <div class="container-fluid">

                    <div class="row d-flex justify-content-around align-items-center">
                        <div class="col-12 col-sm-8 col-md-8 margin-top-20 margin-bottom-20">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="<?= $video['url_video_conteudo'] ?>"></iframe>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        <?php endif ?>
        <!-- END VIDEO -->
    <?php endif ?>

    <!-- IMAGENS DA GALERIA -->
    <?php if (!empty($imagens_galeria) && PAGE_SPEED_100 == true) { ?>
        <section id="texto_sobre_empresa" class="">
            <div class="container-fluid padding_max_top_bottom ">

                <div id="carrosel-sobre">
                    <?php foreach ($imagens_galeria as $key => $img): ?>
                        <img class="img-galeria" data-fancybox="thumb-galeria" data-src="<?= $img['caminho_imagem_conteudo'] ?>" loading="lazy"
                            src="<?= $img['caminho_imagem_conteudo'] ?>" />
                    <?php endforeach ?>
                </div>
                <div class="arrow-images arrow-left arrow_circle">
                    <span class="carousel_setinha">‹</span>
                </div>
                <div class="arrow-images arrow-right arrow_circle">
                    <span class="carousel_setinha">›</span>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- END IMAGENS DA GALERIA -->


    <!-- DEPOIMENTOS -->
    <?php if (!empty($depoimentos) && PAGE_SPEED_100 == true) { ?>
        <section id="partial_depoimentos" class="">
            <div class="container-fluid margin-bottom-60 ">
                <div class="row">
                    <div class="col-12">
                        <h2 class="titulo-depoimentos text-center color_titulo"><?= $titulo_depoimentos ?></h2>
                    </div>
                </div>
                <?php $render('sections/carrossel-depoimentos', ['depoimentos' => $depoimentos]) //chamo os depoimentos 
                ?>
            </div>
        </section>

    <?php } ?>
    <!-- END DEPOIMENTOS -->

    <?php $render('footer/footer', $configuracoes) //html do footer 
    ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp 
    ?>


    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
    ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms 
        ?>

        <?php $render('footer/footer-import', $script) //comum do footer 
        ?>




        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/sobre/sobre.js?v=<?= VERSAO ?>"></script>

        <!-- IMPORTACAO PARTIALS -->
        <script src="<?= $base ?>assets/js/partials/carrossel-depoimentos.js?v=<?= VERSAO ?>"></script>


    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>


</body>

</html>