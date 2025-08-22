<!doctype html>
<html lang="pt-br">
<head>
    <?php $render('header/header-tags', $cms_pagina) //meta tags padroes ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100) : 
        ?>
        <?php $render('scripts/scripts-header', $script) //scripts do banco do cms ?>        

        <?php $render('header/header-import', $cms_pagina) //conteudo comum header ?>

        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/favoritos/favoritos.css?v=<?=VERSAO?>" />
        
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
    

    <?php if(isset($banner)) : ?>
    <!-- BANNER HEADER -->
    <div id="banner_header" class="d-flex justify-content-around align-items-center" style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
        <h1 class="titulo_principal"> <?= $banner['campo_custom1'] ?> </h1>
    </div>
    <!-- END BANNER HEADER -->
    <?php endif ?>


    <!-- FAVORITOS -->
    <section id="conteudo_favoritos" class="back_primario">
        <div class="container-fluid">
            <div class="row" id="container-favoritos">
           
            </div>

        </div>
    </section>
    <!-- END FAVORITOS -->    

    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>
    
    <?php 
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100) : 
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>

        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <!-- <script src="<?= $base ?>assets/js/favoritos/index.js?v=<?= VERSAO ?>"></script> -->
        
    

        <?php 
        //END - Se for pagespeed eu nao mostro os scripts
        endif 
    ?>
</body>
</html>