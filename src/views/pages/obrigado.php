<!doctype html>
<html lang="pt-br">

<head>
    <?php $render('header/header-tags', $cms_pagina) //meta tags padroes ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-header', $script) //scripts do banco do cms ?>

        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/style.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/obrigado/obrigado.css?v=<?= VERSAO ?>">

        <?php $render('header/header-import', $cms_pagina) //conteudo comum header ?>

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms ?>

        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body class="back_primario" >
    
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>

    <?php $render('header/menu-modal', $configuracoes); // ?>
    
    <?php $render('header/top-header', $configuracoes)  //carrega o header contato ?>    
    
    <?php $render('header/header', $configuracoes); //carrega o header ?>

    <div class="container-obrigado color_titulo">
        <div class="container-info">
            <h2 class="text-center "><?= $conteudo['titulo_conteudo'] ?></h2>
            <p class=""><?= $conteudo['descricao_conteudo'] ?></p>
            <a href="javascript:void(0)" onclick="history.back()" class="btn-action-anucniar botao_tema">Voltar para página
                anterior</a>
        </div>
    </div>


    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>
    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    
    <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>
    <?php $render('footer/footer-import', $script) //comum do footer ?>

 
</body>

</html>