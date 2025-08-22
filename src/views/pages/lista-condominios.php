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
        <link rel="stylesheet" href="<?= $base ?>assets/css/condominios/condominios.css?v=<?= VERSAO ?>" />

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms ?>

        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body class="body-condominio">
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>

    <?php $render('header/menu-modal', $configuracoes); // ?>

    <?php $render('header/top-header', $configuracoes)  //carrega o header contato ?>

    <?php $render('header/header', $configuracoes); //carrega o header ?>

    <div id="banner-anuncie" style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>')">

        <h1 class="titulo-principal margin-bottom-30">
            <?= $cms_pagina['titulo_pagina'] ?>
        </h1>
        
        <div id="corpo-busca" class="container">
            <!--<div class="row d-flex justify-content-center align-item">
                <h3 class="margin-bottom-20">Buscar condomínios</h3>
            </div>-->
            <div class="row d-flex justify-content-center align-item">

                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="container-busca">
                        <label>Cidade</label>
                        <select class="custom-select mr-sm-2 form-select" id="cidade">
                            <!-- <option value="1">Cidade</option> -->
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="container-busca">
                        <label>Bairro</label>
                        <select class="custom-select mr-sm-2 form-select" id="bairro">
                            <option value="0">Todas os Bairros</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- CONDOMINIOS -->
    <section id="section_listagem_condominios" class="margin-top-30 margin-bottom-60">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="container_loader text-center margin-top-20 margin-bottom-20">
                        <span>Carregando Condomínios...</span>
                    </div>
                </div>
            </div>
            <div id="container_condominios" class="row">
                
            </div>
        </div>

        <div id="wrap_paginacao" class="col-xs-12">
            <div id="container_geral_paginacao">
                <div id="primeiraPagina" class="btn-paginacao">
                    <span class="carousel_setinha_listagem">‹</span>
                </div>
                <div class="container-paginacao"></div>
                <div id="btn-end"></div>
            </div>
        </div>
    </section>
    <!-- END CONDOMINIOS -->

    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>

        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/condominios/index.js?v=<?= VERSAO ?>"></script>


        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>