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
        <link rel="stylesheet" rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/404.css?v=<?= VERSAO ?>">

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms ?>

        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body>
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>
    <?php $render('header/menu-modal', $configuracoes); // ?>
    <?php $render('header/top-header', $configuracoes) ?>
    <?php $render('header/header', $configuracoes); //carrega o header ?>

    <div class="container-obrigado">
        <div class="container-info">
            <h2 class="text-center">Página não encontrada!</h2>
            <div class="acoes">
                <a href="<?= $base ?>" class="btn-action-anucniar">Voltar para página incial</a>
            </div>
        </div>
    </div>
    
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>
    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    
    <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>
    <?php $render('footer/footer-import', $script) //comum do footer ?>

   
</body>

</html>