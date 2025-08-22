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
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/partials/carrossel-depoimentos.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/equipe/equipe.css?v=<?= VERSAO ?>" />

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
        <div id="banner_header" class="d-flex justify-content-around align-items-center"
            style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
            <h1 class="titulo_principal"> <?= $banner['campo_custom1'] ?> </h1>
        </div>
        <!-- END BANNER HEADER -->
    <?php endif ?>


    <!-- CONTEUDO -->
    <section id="conteudo_section" class="">
        <div class="container-fluid">
            <div class="row margin-top-40">
                <?php if (isset($conteudo_galeria_diretoria)): ?>
                    <?php if (isset($conteudo_galeria_diretoria['titulo_conteudo'])): ?>
                        <h2 class="col-12 text-center margin-bottom-10">
                            <?= $conteudo_galeria_diretoria['titulo_conteudo'] ?>
                        </h2>
                    <?php endif ?>
                    <?php if (isset($conteudo_galeria_diretoria['subtitulo_conteudo'])): ?>
                        <h3 class="col-12 text-center margin-bottom-40">
                            <?= $conteudo_galeria_diretoria['subtitulo_conteudo'] ?>
                        </h3>
                    <?php endif ?>
                <?php endif ?>
            </div>

            <div class="row">
                <?php foreach ($galeria_diretoria as $key => $value): ?>
                    <!-- COL FUNCIONARIO -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div id="<?= $value['cod_imagem_conteudo'] ?>" class="card_funcionario">

                            <div class="head-card"></div>

                            <img src="<?= $value['caminho_imagem_conteudo'] ?>" class="img_perfil" width="210" height="210" alt="<?= $value['campo_custom1'] != "" ? $value['campo_custom1'] : "Foto da Equipe" ?>" />

                            <div class="card_funcionario_body">

                                <?php if ($value['campo_custom1'] != ""): ?>
                                    <strong><?= $value['campo_custom1'] ?></strong>
                                <?php endif ?>

                                <?php if ($value['campo_custom2'] != ""): ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-contact-round">
                                            <path d="M16 2v2" />
                                            <path d="M17.915 22a6 6 0 0 0-12 0" />
                                            <path d="M8 2v2" />
                                            <circle cx="12" cy="12" r="4" />
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                        </svg>
                                        <span><?= $value['campo_custom2'] ?></span>
                                    </div>
                                <?php endif ?>

                                <?php if ($value['campo_custom3'] != ""): ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-mail">
                                            <rect width="20" height="16" x="2" y="4" rx="2" />
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                        </svg>
                                        <span><?= $value['campo_custom3'] ?></span>
                                    </div>
                                <?php endif ?>

                                <?php if ($value['campo_custom4'] != ""): ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-phone">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                        </svg>
                                        <span><?= $value['campo_custom4'] ?></span>
                                    </div>
                                <?php endif ?>

                                <?php if ($value['campo_custom5']  != ""): ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-file-user">
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                            <path d="M15 18a3 3 0 1 0-6 0" />
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                                            <circle cx="12" cy="13" r="2" />
                                        </svg>
                                        <span><?= $value['campo_custom5'] ?></span>
                                    </div>
                                <?php endif ?>

                                <?php if ($value['cod_imagem_conteudo'] != ""): ?>
                                    <button data-codconteudo="<?= $value['cod_imagem_conteudo'] ?>" type="button"
                                        class="btn btn-block btn-primario btn_saber_mais">
                                        Saber Mais
                                    </button>
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                    <!-- END COL FUNCIONARIO -->
                <?php endforeach ?>
            </div>


            <div class="row margin-top-40 margin-bottom-60">

                <?php if (isset($conteudo_galeria_corretores)): ?>
                    <?php if (isset($conteudo_galeria_corretores['titulo_conteudo'])): ?>
                        <h2 class="col-12 text-center margin-bottom-10">
                            <?= $conteudo_galeria_corretores['titulo_conteudo'] ?>
                        </h2>
                    <?php endif ?>
                    <?php if (isset($conteudo_galeria_corretores['subtitulo_conteudo'])): ?>
                        <h3 class="col-12 text-center margin-bottom-40">
                            <?= $conteudo_galeria_corretores['subtitulo_conteudo'] ?>
                        </h3>
                    <?php endif ?>
                <?php endif ?>

                <?php foreach ($galeria_corretores as $key => $value): ?>
                    <!-- COL FUNCIONARIO -->
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                        <div id="<?= $value['cod_imagem_conteudo'] ?>" class="card_funcionario">
                            <div class="head-card">

                            </div>
                            <img src="<?= $value['caminho_imagem_conteudo'] ?>" class="img_perfil" width="210" height="210"
                                alt="<?= $value['campo_custom1'] != "" ? $value['campo_custom1'] : "Foto da Equipe" ?>" />

                            <div class="card_funcionario_body">

                                <?php if ($value['campo_custom1'] != ""): ?>
                                    <strong><?= $value['campo_custom1'] ?></strong>
                                <?php endif ?>

                                <?php if ($value['campo_custom2'] != ""): ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-contact-round">
                                            <path d="M16 2v2" />
                                            <path d="M17.915 22a6 6 0 0 0-12 0" />
                                            <path d="M8 2v2" />
                                            <circle cx="12" cy="12" r="4" />
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                        </svg>
                                        <span><?= $value['campo_custom2'] ?></span>
                                    </div>
                                <?php endif ?>

                                <?php if ($value['campo_custom3'] != ""): ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-mail">
                                            <rect width="20" height="16" x="2" y="4" rx="2" />
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                        </svg>
                                        <span><?= $value['campo_custom3'] ?></span>
                                    </div>
                                <?php endif ?>

                                <?php 
                                if ($value['campo_custom4'] != "") { ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-phone">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                        </svg>
                                        <span><?= $value['campo_custom4'] ?></span>
                                    </div>
                                <?php } else { echo "Nao informacao"; } ?>

                                <?php if ($value['campo_custom5'] != ""): ?>
                                    <div class="info-func">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-file-user">
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                            <path d="M15 18a3 3 0 1 0-6 0" />
                                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                                            <circle cx="12" cy="13" r="2" />
                                        </svg>
                                        <span><?= $value['campo_custom5'] ?></span>
                                    </div>
                                <?php endif ?>

                                <?php if ($value['cod_imagem_conteudo'] != ""): ?>
                                    <button data-codconteudo="<?= $value['cod_imagem_conteudo'] ?>" type="button"
                                        class="btn btn-block btn-primario btn_saber_mais">
                                        Saber Mais
                                    </button>
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                    <!-- END COL FUNCIONARIO -->
                <?php endforeach ?>

            </div>

    </section>
    <!-- END CONTEUDO -->


    <!-- MODAL DE IMOVEL -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="row d-flex justify-content-start align-items-center margin-bottom-10">
                                <div class="col-12 col-sm-12 wrap_imagem">

                                </div>
                                <div class="col-12 col-sm-6 wrap_dados_colaborador" style="display: none;">

                                </div>
                            </div>
                            <div id="container-descricao" class="row">
                                <div class="col-12 margin-top-10 wrap_descricao_colaborador">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <button id="fechar-modal" type="button"
                                    class="btn btn-block btn-primario">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL DE IMOVEL -->


    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>

        <?php $render('footer/footer-import', $script) //comum do footer ?>

        
        <script src="<?= $base ?>assets/js/equipe/equipe.js?v=<?= VERSAO ?>"></script>

        <!-- IMPORTACAO PARTIALS ->         
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/partials/carrossel-depoimentos.js?v=<?= VERSAO ?>"></script>
        <!-- IMPORTACAO DA PAGINA -->



        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>

<?php
/* *-/ ?>
    <?php $render('scripts-body-inicial', $script); ?>


    <?php $render('menu-modal', $configuracoes);?>
    <?php $render('header', $configuracoes); ?>

    <div id="banner-anuncie" class="d-flex justify-content-around align-items-center">
        <h1 class="titulo_principal text-center"><?= $cms_pagina['titulo_pagina']?></h1>
    </div>

    <div id="container-conteudo" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="container-text-1" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h3 class="titulo-cargos"><?= $titulo_diretoria['titulo_conteudo'] ?></h3>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="container-setor row d-flex justify-content-start align-items-center">
                <?php foreach ($diretores as $key => $value) : ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 card-funcionario">
                    <div id="<?= $value['cod_imagem_conteudo'] ?>" class="row container-func">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                            <img src="<?=  $value['caminho_imagem_conteudo'] ?>" class="img-perfil">
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="row container-corretor">
                                <div class="col-12">
                                    <span class=""><?= $value['campo_custom1'] ?></span></br>
                                </div>
                                <div class="col-12">
                                    <span class=""><?= $value['campo_custom2'] ?></span><br>
                                    <span class=""><?= $value['campo_custom3'] ?></span>
                                </div>
                                <div class="col-12">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-12">
                                            <button id="<?= $value['cod_imagem_conteudo'] ?>" type="button"
                                                class="btn btn-block btn-primario btn-saber-mais">Saber Mais</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin:5px" class="linha-divisoria"></div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>

    </div>


    <div id="container-conteudo" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="container-text-1" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h3 class="titulo-cargos"><?= $titulo_corretor['titulo_conteudo'] ?></h3>
                </div>
            </div>
        </div>
        <div class="container-setor row d-flex justify-content-start align-items-center">
            <?php foreach ($corretores as $key => $value) : ?>
            <div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 card-funcionario">
                <div id="<?= $value['cod_imagem_conteudo'] ?>" class="row container-func">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <img src="<?=  $value['caminho_imagem_conteudo'] ?>" class="img-perfil">
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="row container-corretor">
                            <div class="col-12">
                                <span class=""><?= $value['campo_custom1'] ?></span></br>
                            </div>
                            <div class="col-12">
                                <span class=""><?= $value['campo_custom2'] ?></span><br>
                                <span class=""><?= $value['campo_custom3'] ?></span>
                            </div>
                            <div class="col-12">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12">
                                        <button id="<?= $value['cod_imagem_conteudo'] ?>" type="button"
                                            class="btn btn-block btn-primario btn-saber-mais">Saber Mais</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin:5px" class="linha-divisoria"></div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>


    <?php $render('footer', $configuracoes); ?>
    <?php $render('whatsapp', $configuracoes); ?>

    <script src="<?= $base ?>assets/lib/jquery.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/utils.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/lib/bootstrap450/js/bootstrap.min.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/lib/lazysizes.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/menu.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/equipe/index.js?v=<?= VERSAO ?>"></script>

    <?php $render('scripts-footer', $script) ?>

</body>

</html>
*/
?>