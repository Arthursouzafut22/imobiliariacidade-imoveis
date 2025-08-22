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
        <link rel="stylesheet" href="<?= $base ?>assets/css/politica/politica.css?v=<?= VERSAO ?>" />

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

    <?php if (isset($banner)): ?>
        <!-- BANNER HEADER -->
        <!-- <div id="banner_header" class="d-flex justify-content-around align-items-center" style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
        <h5 class="titulo_principal"> <?= $banner['campo_custom1'] ?> </h2>
    </div> -->
        <!-- END BANNER HEADER -->
    <?php endif ?>


    <!-- SOBRE EMPRESA -->
    <section id="texto_sobre_empresa" class="back_primario">
        <div class="container-fluid">
            <div class="row">
                <?php if (isset($cms_pagina)): ?>

                    <div class="col-12 margin-top-40 margin-bottom-30">
                        <h1 class=" text-center color_titulo"><?= $cms_pagina['titulo_pagina'] ?></h1>
                    </div>

                    <div class="col-12 margin-bottom-30 color_texto">
                        <?= $cms_pagina['descricao_conteudo'] ?>
                    </div>
                <?php endif ?>
            </div>

        </div>
    </section>
    <!-- END SOBRE EMPRESA -->


    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>


    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>

        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>