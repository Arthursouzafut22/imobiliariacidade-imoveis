<!doctype html>
<html lang="pt-br">

<head>
    <?php $render('header/header-tags', $cms_pagina) //meta tags padroes ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-header', $script) //scripts do banco do cms ?>

        <?php $render('header/header-import', $cms_pagina) //conteudo comum header ?>

        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/documentos/documentos.css?v=<?= VERSAO ?>" />

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms ?>

        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body>
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>

    <?php $render('header/menu-modal', $configuracoes); // ?>

    <?php $render('header/top-header', $configuracoes)  //carrega o header contato ?>    

    <?php $render('header/header', $configuracoes); //carrega o header ?>


    <?php if (isset($banner) && !empty($banner)): ?>
        <!-- BANNER HEADER -->
        <div id="banner_header" class="d-flex justify-content-around align-items-center"
            style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
            <h1 class="titulo_principal"> <?= $cms_pagina['titulo_pagina'] ?> </h1>
        </div>
        <!-- END BANNER HEADER -->
    <?php endif ?>

    
    <!-- DOCUMENTOS -->
    <section id="section_documentos">
        <div class="container-fluid">

            <div class="row text-center">
                <div class="col-12 margin-top-20 margin-bottom-30">
                    <h2><?= $cms_pagina['subtitulo_pagina'] ?></h2>
                </div>
            </div>

            <?php if (isset($texto) && !empty($texto)): ?>
            <div class="row">
                <div class="col-12 margin-top-0 margin-bottom-60">
                    <?= $texto['descricao_conteudo'] ?>
                </div>
            </div>
            <?php endif ?>
        </div>
    </section>
    <!-- END DOCUMENTOS -->

    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>
    
    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>

        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/sobre/sobre.js?v=<?= VERSAO ?>"></script>

        <!-- IMPORTACAO PARTIALS -->
        <script src="<?= $base ?>assets/js/partials/carrossel-depoimentos.js?v=<?= VERSAO ?>"></script>        
        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>