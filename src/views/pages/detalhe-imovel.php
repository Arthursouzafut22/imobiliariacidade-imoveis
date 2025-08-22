<!doctype html>
<html lang="pt-br">

<head>
    <?php $render('header/header-tags', $imovel->cms_pagina) //meta tags padroes 
    ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
    ?>
        <?php $render('scripts/scripts-header', $imovel->script) //scripts do banco do cms 
        ?>

        <?php $render('header/header-import', $imovel->cms_pagina) //conteudo comum header 
        ?>

        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/detalhe-imovel/detalhe-imovel.css?v=<?= VERSAO ?>" />


        <!-- IMPORT BOOSTRAP -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <script src="https://storage.googleapis.com/vrview/2.0/build/vrview.min.js?v=<?= VERSAO ?>"></script>
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
            rel="stylesheet" />
        <script src="https://app.imoview.com.br/scripts/esteira.js?v=<?= VERSAO ?>" type="text/javascript"></script>

        <?php $render('scripts/scripts-pos-header', $imovel->script); //scripts do banco do cms 
        ?>

    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<input type="hidden" id="EXIBIR_LACAMENTO_EM_MODAL" value="<?= EXIBIR_LACAMENTO_EM_MODAL ?>" />

<body class="back_primario">

    <?php $render('scripts/scripts-body-inicial', $imovel->script); //scripts do banco do cms 
    ?>

    <?php $render('header/menu-modal', $imovel->configuracoes); // 
    ?>

    <?php $render('header/top-header', $imovel->configuracoes)  //carrega o header contato 
    ?>

    <?php $render('header/header', $imovel->configuracoes); //carrega o header 
    ?>


    <!-- CONTEUDO GALERIA, MAPA, STREET VIEW -->
    <div id="section_conteuo_header" class="" style="position: relative;">
        <?php echo $imovel->tag ?>

        <div class="btn-actions-favoritos" codigo="<?= $imovel->codigo ?>">
            <img src="<?= $base ?>assets/icons/<?= $imovel->estaFavoritado ? 'icon-favorito-ativo.svg' : 'icon-favorito.svg' ?>"
                class="" id="icon-favoritos-<?= $imovel->codigo ?>">
        </div>

        <!-- GALERIA DE FOTOS -->
        <?php
        $limitFotos = DISPOSITIVO_MOBILE == 0 ? 7 : 3;
        $classBotaoMobile = DISPOSITIVO_MOBILE == 0 ? "open_foto_sel" : "";
        $totalFotosApi = count($imovel->fotos); //total de fotos do imovel
        $numeroFotos = $totalFotosApi >= $limitFotos ? $limitFotos : $totalFotosApi; //maximo de fotos do for é 7
        $totalFotosFaltantes = $limitFotos - $totalFotosApi;


        ?>
        <div id="cont-fotos" class="container-exibicao" data-totalfotos="<?php echo $totalFotosApi; ?>">
            <ul class="galeria-vs2 ">
                <?php
                //aqui eu tiro 1 porque o for começa com zero
                $numeroForeach = $numeroFotos - 1;

                //faço o for nas fotos
                for ($index = 0; $index <= $numeroForeach; $index++) {
                    $tamanhoFoto = $index == 0 ? "urlm" : "urlp";
                    $urlImagem = $imovel->fotos[$index]->$tamanhoFoto;
                ?>
                    <li class="item_imagem_galeria back_primario <?= $classBotaoMobile ?>" data-index="<?= $index ?>"
                        data-foto="api">
                        <img src="<?= $urlImagem ?>" border="0" alt="<?= $imovel->fotos[$index]->descricao ?>" />
                    </li>
                    <?php
                }

                //se tiver faltando fotos
                if ($totalFotosFaltantes > 0) {
                    //faço o for nas fotos que estão faltando
                    for ($index = 1; $index <= $totalFotosFaltantes; $index++) {

                        //se for a foto 1 em um imóvel que nao tem foto no mobile força aparecer
                        $style_foto = $totalFotosApi == 0 && $index == 1 ? "display:block;" : "";
                        $nome_foto = isset($imovel->fotos[$index]->descricao) && $imovel->fotos[$index]->descricao != "" ? $imovel->fotos[$index]->descricao : "Foto Imóvel";
                    ?>
                        <li class="item_imagem_galeria <?= $classBotaoMobile ?>" data-index="<?= $index ?>"
                            style="<?= $style_foto ?>" data-foto="faltante">
                            <img src="<?= $base ?>assets/images/imagem-nao-disponivel-<?= TEMA_STRING ?>.webp" border="0"
                                alt="<?= $nome_foto ?>" />
                        </li>
                <?php
                    }
                }
                ?>
            </ul>

            <!-- galeria completa fica oculpa só quando clica que abre ela -->
            <div class="galeria_completa">
                <?php
                foreach ($imovel->fotos as $key => $itemFoto) {
                    $nome_foto = $imovel->fotos[$index]->descricao != "" ? $imovel->fotos[$index]->descricao : "Foto Imóvel";
                ?>
                    <a data-fancybox="gallery" data-index="<?= $key ?>" href="<?= $itemFoto->url ?>">
                        <img class="loadimage" data-src="<?= $itemFoto->url ?>"
                            title="<?= $itemFoto->fotos[$index]->descricao ?>" alt="<?= $nome_foto ?>" border="0" />
                    </a>
                <?php
                }
                ?>
            </div>
            <!-- end galeria completa fica oculpa só quando clica que abre ela -->

            <?php
            if ($totalFotosApi > 0) {
            ?>
                <!-- botao ver fotos no mobile -->
                <button type="buttom" class="open_galeria_completa botao_ver_mais_fotos_mobile">
                    Ver fotos do imóvel
                </button>
                <!-- end botao ver fotos no mobile -->
            <?php
            }
            ?>

        </div>
        <!-- END GALERIA DE FOTOS -->


        <!-- CONTAINER EXIBICAO DO MAPA -->
        <div class="row">
            <div class="col-12">
                <div id="map" class="container-exibicao"></div>
            </div>
        </div>
        <!-- END CONTAINER EXIBICAO DO MAPA -->


        <!-- CONTAINER EXIBICAO STREET VIEW -->
        <div id="pano" class="row container-exibicao">
            <div class="col-12">
                <iframe title="Street View" id="ifram-stree" width="100%" height="400px" src=""></iframe>
            </div>
        </div>
        <!-- END CONTAINER EXIBICAO STREET VIEW -->

        <!-- CONTAINER TOUR VIRTUAL -->
        <div id="tour-virtual" class="row container-exibicao">
            <div class="col-12">
                <iframe title="Tour Virtual View" id="ifram-tour" width="100%" height="400px" src=""
                    allowfullscreen></iframe>
            </div>
        </div>
        <!-- END CONTAINER TOUR VIRTUAL -->


        <!-- CONTAINER VIDEO -->
        <div id="video" class="row container-exibicao">
            <div class="col-12">
                <iframe title="Container Vídeo" id="ifram-video" width="100%" height="400px" src="#" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
        <!-- CONTAINER VIDEO -->

        <!-- CONTAINER IMAGENS 360 -->
        <div id="imagens360" title="Container Imagens 360" class="row container-exibicao"></div>
        <!-- END CONTAINER IMAGENS 360 -->

    </div>
    <!-- END CONTEUDO GALERIA, MAPA, STREET VIEW -->


    <!-- CARROSSEL DE FOTOS 360 -->
    <div class="container-controls-360-fixa">
        <div id="arrow-360-left-c1" class="btn-arrow-foto360">
            <span class="material-symbols-outlined">
                chevron_left
            </span>
        </div>
        <div id="arrow-360-right-c1" class="btn-arrow-foto360">
            <span class="material-symbols-outlined">
                navigate_next
            </span>
        </div>
    </div>


    <div class="modal-foto-360">
        <div class="btn-close-360">
            <span class="material-symbols-outlined">
                close
            </span>
            <strong>Fechar Fotos 360</strong>
        </div>
        <div class="body-360">
            <div id="carrossel-foto360" class="">
            </div>

            <div class="container-controls">
                <div id="arrow-360-left" class="btn-arrow-foto360">
                    <span class="material-symbols-outlined">
                        chevron_left
                    </span>
                </div>
                <div id="arrow-360-right" class="btn-arrow-foto360">
                    <span class="material-symbols-outlined">
                        navigate_next
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- END CARROSSEL DE FOTOS 360 -->

    <!-- BOTOES GALERIA, MAPA, STREET VIEW -->
    <div class="container-fluid">
        <div class="row margin-top-10">
            <div class="col-12">
                <div id="container-buttom" class="wrap_botoes_detalhes_imovel">
                    <?php
                    if (MAPA_DETALHES_IMOVEL_LOCALIZACAO != 0 || $imovel->urlvideo != '' || $imovel->urlpublica != '' || MAPA_DETALHES_IMOVEL_RUA != 0) {
                    ?>
                        <button id="btn-fotos" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" src="<?= $base ?>assets/icons/icon-foto-cinza.svg"
                                alt="Galeria de Imagens" border="0" /> <span class="text-botao-cinza">FOTOS</span>
                        </button>
                    <?php
                    }
                    ?>
                    <?php if (MAPA_DETALHES_IMOVEL_LOCALIZACAO != 0): ?>
                        <button id="btn-mapa" class="btn  btn-cinza-light">
                            <img class="icon-botao lazyload" src="<?= $base ?>assets/icons/icon-mapa-cinza.svg" alt="Mapa"
                                border="0" /> <span class="text-botao-cinza">MAPA</span>
                        </button>
                    <?php endif; ?>

                    <?php if ($imovel->urlvideo != ''): ?>
                        <button id="btn-video" class="btn  btn-cinza-light">
                            <img class="icon-botao lazyload" data-src="<?= $base ?>assets/icons/icon-camera-cinza.svg"
                                alt="Mapa" border="0" /> <span class="text-botao-cinza">VÍDEO</span>
                        </button>
                    <?php endif; ?>

                    <?php if ($imovel->urlpublica != ''): ?>
                        <button id="btn-tour" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" data-src="<?= $base ?>assets/icons/icon-cubo-cinza.svg"
                                alt="Tour Virtual" border="0" /> <span class="text-botao-cinza">TOUR VIRTUAL</span>
                        </button>
                    <?php endif; ?>

                    <?php if (MAPA_DETALHES_IMOVEL_RUA != 0): ?>
                        <button id="btn-rua" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" src="<?= $base ?>assets/icons/icon-street-cinza.svg" alt="Rua"
                                border="0" /> <span class="text-botao-cinza">RUA</span>
                        </button>
                    <?php endif; ?>

                    <?php if ((APIGOOLGE != '' && APIGOOLGE != '#') && count($imovel->fotos360) > 0): ?>
                        <button id="btn-foto-360" class="btn btn-cinza-light">
                            <span class="icon-botao material-symbols-outlined">360</span> <span
                                class="text-botao-cinza">360°</span>
                        </button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <!-- BOTOES GALERIA, MAPA, STREET VIEW -->

    <div class="linha-divisoria"></div>

    <!-- CONTEUDO PRINCIPAL -->
    <div class="container-fluid">
        <div class="espacamento">
            <div class="row margin-top-20">
                <div class="col-6">
                    <button class="open_modal_agendar_visita botao_header_mobile btn-fale-corretor">
                        <img class="icon-botao lazyload" width="22px"
                            data-src="<?= $base ?>assets/icons/icon-email-branco.svg" src="" alt="Fale Conosco"
                            border="0" /> &nbsp;&nbsp;FALE CONOSCO
                    </button>
                </div>
                <div class="col-6">
                    <button class="open_modal_agendar_visita botao_header_mobile agendar-visita">
                        <img class="icon-botao lazyload" data-src="<?= $base ?>assets/icons/icon-calendario-white.svg"
                            src="" alt="Agendar Visita" border="0" /> &nbsp;&nbsp;AGENDAR VISITA
                    </button>
                </div>
            </div>

            <div class="row margin-top-20">
                <!-- COL LEFT -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 container-esquerda ">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb back_primario">
                            <li class="breadcrumb-item"><a href="<?= $base ?>">Início</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= $base ?><?= strtolower($imovel->codigofinalidade == 2 ? 'venda' : 'aluguel') ?>"><?= $imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?></a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="<?= $base ?><?= strtolower($imovel->codigofinalidade == 2 ? 'venda' : 'aluguel') ?>/<?= $imovel->url_tipo ?>"><?= $imovel->tipo ?></a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="<?= $base ?><?= strtolower($imovel->codigofinalidade == 2 ? 'venda' : 'aluguel') ?>/imovel/<?= $imovel->url_cidade ?>/<?= $imovel->url_bairro ?>"><?= $imovel->bairro ?></a>
                            </li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="preco-imovel-mobile ">
                                    <?= $imovel->valor ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h1 class="titulo_principal color_titulo"><?= $imovel->titulo ?></h1>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-end color_texto">

                        <div class="icon_detalhes <?= $imovel->areaprincipal == "0,00" ? "hide" : "" ?>">
                            <img class="icons-caracteristicas"
                                src="<?= BASE_URL ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-area.svg" alt="">
                            <span><?= $imovel->areaprincipal ?> m²</span>
                            <span>Área Principal</span>
                        </div>

                        <div class="icon_detalhes <?= $imovel->arealote == "0,00" ? "hide" : "" ?>">
                            <img class="icons-caracteristicas"
                                src="<?= BASE_URL ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-cerca.svg" alt="">
                            <span><?= $imovel->arealote ?> m²</span>
                            <span>Área Lote</span>
                        </div>

                        <div class="icon_detalhes <?= $imovel->numeroquartos == "0" ? "hide" : "" ?>">
                            <img class="icons-caracteristicas"
                                src="<?= BASE_URL ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-bed.svg" alt="">
                            <span><?= $imovel->numeroquartos ?></span>
                            <span>Quartos</span>
                        </div>

                        <div class="icon_detalhes <?= $imovel->numerobanhos == "0" ? "hide" : "" ?>">

                            <img class="icons-caracteristicas"
                                src="<?= BASE_URL ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-shower.svg" alt="">
                            <span><?= $imovel->numerobanhos ?> </span>
                            <span>Banheiro</span>
                        </div>

                        <div class="icon_detalhes <?= $imovel->numerovagas == "0" ? "hide" : "" ?>">
                            <img class="icons-caracteristicas"
                                src="<?= BASE_URL ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-garage.svg" alt="">
                            <span><?= $imovel->numerovagas ?></span>
                            <span>Vagas</span>
                        </div>

                        <div class="icon_detalhes <?= $imovel->numerosuites == "0" ? "hide" : "" ?>">
                            <img class="icons-caracteristicas"
                                src="<?= BASE_URL ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-suites.svg" alt="">
                            <span><?= $imovel->numerosuites ?></span>
                            <span>Suite</span>
                        </div>
                    </div>

                    <?php if ($imovel->descricao != "") { ?>
                        <div class="row margin-top-20 <?= $imovel->descricao == "" ? "hide" : "" ?>">
                            <div class="col-12 margin-bottom-10">
                                <h2 class="titulo_secundario color_titulo_section_detalhes ">Descrição do imóvel</h2>
                            </div>
                            <div class="col-12">
                                <p class="descricao color_texto"><?= nl2br($imovel->descricao) ?></p>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($imovel->nomecondominio != ''): ?>
                        <div class="row" style="padding-top: 20px">
                            <div class="col-12">
                                <h2 class="titulo_secundario color_titulo_section_detalhes">Nome do condomínio</h2>
                            </div>
                            <div class="col-12">
                                <p class="descricao"><?= $imovel->nomecondominio ?> </p>
                            </div>
                            <div class="col-12 margin-bottom-30 color_texto">
                                <a target="_blank"
                                    href="<?= $base ?>condominio/<?= $imovel->url_condominio ?>/<?= $imovel->codigocondominio ?>"
                                    class="link">
                                    Saber mais sobre o condomínio <img class="icon-link lazyload"
                                        data-src="<?= $base ?>assets/icons/icon-arrow-right.svg" alt="Sobre o condomínio"
                                        border="0" />
                                </a><br>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row margin-top-20 section_caracteristicas_internas" style="display: none;">
                        <div class="col-12 margin-bottom-30">
                            <h2 class="titulo_secundario color_titulo_section_detalhes">Características internas</h2>
                        </div>

                        <div class="col-12">
                            <ul class="lista-caracteristicas-extras caracteristicas-internas">
                                <li
                                    class="caracteristicas-extras <?= ($imovel->arcondicionado) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->arcondicionado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Ar condicionado
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->armariobanheiro) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->armariobanheiro) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Armário banheiro
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->box) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->box) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Box banheiro
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->despensa) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->despensa) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Despensa
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->vistamar) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->vistamar) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Vista para o mar
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->areaservico) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->areaservico) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Área serviço
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->lavabo) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->lavabo) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Lavabo
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->conexaointernet) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->conexaointernet) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Conexão internet
                                </li>

                                <li
                                    class="caracteristicas-extras <?= ($imovel->cabeamentoestruturado) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->cabeamentoestruturado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Cabeamento estruturado
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->vistamontanha) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->vistamontanha) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Vista para montanha
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->areaprivativa) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->areaprivativa) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Área privativa
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->armariocozinha) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->armariocozinha) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Armário cozinha
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->closet) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->closet) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Closet
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->armarioquarto) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->armarioquarto) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Armário quarto
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->solmanha) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->solmanha) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Sol da manhã
                                </li>

                                <li
                                    class="caracteristicas-extras <?= ($imovel->escritorio) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->escritorio) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Escritório
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->rouparia) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->rouparia) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Rouparia
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->varandagourmet) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->varandagourmet) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Varanda gourmet
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->tvacabo) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->tvacabo) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    TV a cabo
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->vistalago) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->vistalago) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Vista para lago
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->dce) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->dce) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    DCE
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->lareira) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->lareira) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Lareira
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="row margin-bottom-20 section_caracteristicas_externas" style="display: none;">
                        <div class="col-12 margin-bottom-30 margin-top-30">
                            <h2 class="titulo_secundario color_titulo_section_detalhes">Características externas</h2>
                        </div>

                        <div class="col-12 color_texto">
                            <ul class="lista-caracteristicas-extras caracteristicas-externas">
                                <li
                                    class="caracteristicas-extras <?= ($imovel->aguaindividual) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->aguaindividual) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Água individual
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->aquecedoreletrico) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->aquecedoreletrico) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Aquec. elétrico
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->aquecedorsolar) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->aquecedorsolar) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Aquec. solar
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->cercaeletrica) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->cercaeletrica) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Cerca elétrica
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->gascanalizado) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->gascanalizado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Gás canalizado
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->jardim) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->jardim) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Jardim
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->portaoeletronico) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->portaoeletronico) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Portão eletrônico
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->seguranca24horas) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->seguranca24horas) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Segurança 24 horas
                                </li>

                                <li
                                    class="caracteristicas-extras <?= ($imovel->gramado) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->gramado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Gramado
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->alarme) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->alarme) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Alarme
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->aquecedorgas) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->aquecedorgas) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Aquec. gás
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->boxdespejo) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->boxdespejo) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Box despejo
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->circuitotv) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->circuitotv) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Circuito TV
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->interfone) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->interfone) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Interfone
                                </li>

                                <li
                                    class="caracteristicas-extras <?= ($imovel->quintal) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->quintal) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Quintal
                                </li>
                                <li
                                    class="caracteristicas-extras <?= ($imovel->portaria24horas) ? 'extras-active' : 'extras-none' ?>">
                                    <img class="lazyload" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/<?= ($imovel->portaria24horas) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" />
                                    Portaria 24 horas
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row margin-bottom-20 section_caracteristicas_extras" style="display: none;">

                        <div class="col-12 margin-bottom-30">
                            <h2 class="titulo_secundario color_titulo_section_detalhes">Características extras</h2>
                        </div>

                        <div class="col-12 margin-bottom-20 color_texto">
                            <ul class="lista-caracteristicas-extras caracteristicas-extras">
                                <?php foreach ($imovel->extras2 as $key => $extras): ?>
                                    <li class="caracteristicas-extras extras-active">
                                        <img class="lazyload" loading="lazy"
                                            data-src="<?= $base ?>assets/icons/icon-check.svg" />
                                        <?= $extras['nome'] ?>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END COL LEFT -->

                <!-- LADO DIRETIO DA TELA -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 container-direito">

                    <div class="row d-flex  justify-content-end container-direito-nivel-1 ">
                        <div class="cont-call-to-action ">
                            <div class="call-to-action back_secundario">
                                <div class="espacamento">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="titulo-card color_texto">imóvel</p>
                                        <p class=""><b id="cod-principal">Cód. imóvel: <?= $imovel->codigo ?></b>
                                        </p>
                                    </div>
                                </div>
                                <!-- linha divisoria -->
                                <div class="linha-divisoria"></div>

                                <div class="espacamento">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="titulo-card color_texto">Valor</p>
                                        <h6 class="preco-imovel color_texto"><?= $imovel->valor ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center color_texto">
                                        <p class="p-cinza">Condomínio</p>
                                        <h6 class="p-cinza"><?= $imovel->valorcondominio ?></h6>
                                    </div>
                                    <?php if ($imovel->valoriptu != '0,00' && $imovel->valoriptu != 'R$ 0,00'): ?>
                                        <div class="d-flex justify-content-between align-items-center color_texto">
                                            <p class="p-cinza">IPTU</p>
                                            <h6 class="p-cinza"><?= $imovel->valoriptu ?></h6>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($imovel->codigofinalidade == 1): ?>
                                        <div class="d-flex justify-content-between align-items-center color_texto">
                                            <p class="p-cinza">Total</p>
                                            <h6 class="preco-total"><?php echo $imovel->valormaiscondominiomaisiptu ?>
                                            </h6>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="linha-divisoria"></div>


                                <?php if (EXIBIR_CAPTADOR): ?>
                                    <!-- CAPTADOR_SITE -->
                                    <div class="espacamento">
                                        <?php
                                        foreach ($imovel->captadores as $key => $captador): ?>

                                            <div class="row d-flex justify-content-start align-items-center">
                                                <div class="col-5">
                                                    <img src="<?= ($captador->foto != '' ? $captador->foto : $base . 'assets/img/logo-mini.png') ?>"
                                                        class="img-captador" alt="Imagem do Captador" />
                                                </div>
                                                <div class="col-7">
                                                    <div class="row container-corretor">
                                                        <div class="col-12">
                                                            <span class=""><?= $captador->nome; ?></span></br>
                                                            <?php if ($captador->creci != ""):
                                                            ?>
                                                                <span class="">CRECI <?= $captador->creci ?></span>
                                                            <?php endif
                                                            ?>
                                                        </div>
                                                        <div class="col-12">
                                                            <a
                                                                href="tel:<?= preg_replace('/[^0-9]/', '', $captador->telefone) ?>">
                                                                <span class=""><?= $captador->telefone ?></span><br>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>

                                <div class="espacamento">
                                    <div class="row">
                                        <div class="col-12">
                                            <form class="formulario-lead" name="leadimovel">
                                                <div class="row">
                                                    <input id="form-corretor-finalidade" hidden name="finalidade"
                                                        type="text" class="form-control form-text"
                                                        value="<?= $imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?>" />
                                                    <input id="form-corretor-codimovel" hidden name="codimovel"
                                                        type="text" class="form-control form-text"
                                                        value="<?= $imovel->codigo ?>" />
                                                    <div class="col-12">
                                                        <label class="label-form">SEU nome <span
                                                                class="asterisco-valiacao">*</span></label>
                                                        <input id="form-corretor-nome" name="nome" type="text"
                                                            class="form-control form-text"
                                                            placeholder="EX: José da silva" required />
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="label-form">SEU E-mail <span
                                                                class="asterisco-valiacao">*</span></label>
                                                        <input id="form-corretor-email" name="email" type="email"
                                                            class="form-control form-text"
                                                            placeholder="EX: email@email.com" required />
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="label-form">Celular <span
                                                                class="asterisco-valiacao">*</span></label>
                                                        <input id="form-corretor-celular" name="telefone" type="text"
                                                            class="form-control form-text"
                                                            placeholder="EX: (XX) X XXXX-XXXX" required />
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="label-form">Mensagem (Não obrigatrio)</label>
                                                        <textarea id="form-corretor-msg" name="mensagem"
                                                            class="form-control" id="exampleFormControlTextarea1"
                                                            rows="4">Olá, gostaria de mais informações sobre o imóvel: <?= $imovel->codigo ?>.
                                                        </textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <?php if ($imovel->configuracoes['captcha_ativo']) { ?>
                                                            <div id="captcha-tenho-interesse"
                                                                class="margin-bottom-20 margin-top-20"
                                                                data-sitekey="<?php echo $imovel->configuracoes['captcha_site_key']; ?>">
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="alerta-corretor">
                                                            <p class="msg-retorno-agenda"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12">
                                                        <p style="font-size:13px;" class="my-2 color_texto">Ao
                                                            informar meus
                                                            dados, eu concordo com a <a
                                                                class="text-primary fs-1 text-decoration-underline "
                                                                href="<?= $base ?>politica-privacidade"
                                                                target="_blank">Política de
                                                                Privacidade</a>.
                                                        </p>
                                                        <button id="btn-enviar-lead-imovel" type="submit"
                                                            class="btn btn-block btn-primario">TENHO
                                                            INTERESSE</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <button class="btn btn-block btn-primario-light agendar-visita">Agendar
                                                uma visita</button>
                                            <?php if (TEM_ESTEIRA_DIGITAL == 1) { ?>
                                                <script type="text/javascript">
                                                    IMOVIEW.Exec({
                                                        "htmlPersonalizado": '<a id="button-agenda-visita" class="btn btn-block btn-primario-light" style="margin-top:5px;max-width:100%">Agendar Visita esteira</a>', //Opcional - caso queira personalizar o botão(recomendado).
                                                        "textoBotaoOriginal": "", //Assume o texo a seguir como padrão se não html personalizado preenchido. - "Agende sua visita e alugue online"
                                                        "clienteConvenio": "<?= CODIGO_CONVENIO ?>", //Código convênio do cliente no Imoview.
                                                        "clienteRota": "<?= ROTA ?>", //Rota do cliente no Imoview.
                                                        "imovelId": "<?= $imovel->codigo ?>", //ID do imóvel
                                                        "acaoBotao": "visita", //proposta ou visita
                                                        "urlImovelnoSite": window.location.href
                                                    });
                                                </script>
                                                <script type="text/javascript">
                                                    IMOVIEW.Exec({
                                                        "htmlPersonalizado": '<a id="button-agenda-visita" class="btn btn-block btn-primario-light" style="margin-top:5px;max-width:100%;" >Fazer proposta esteira</a>', //Opcional - caso queira personalizar o botão(recomendado).
                                                        "textoBotaoOriginal": "", //Assume o texo a seguir como padrão se não html personalizado preenchido. - "Agende sua visita e alugue online"
                                                        "clienteConvenio": "<?= CODIGO_CONVENIO ?>", //Código convênio do cliente no Imoview.
                                                        "clienteRota": "<?= ROTA ?>", //Rota do cliente no Imoview.
                                                        "imovelId": "<?= $imovel->codigo ?>", //ID do imóvel
                                                        "acaoBotao": "proposta", //proposta ou visita
                                                        "urlImovelnoSite": window.location.href
                                                    });
                                                </script>
                                            <?php } ?>

                                            <div class="btn-compartilhamento-wpp mt-2" title="Abrir no WhatsApp">
                                                <a target="_blank"
                                                    href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', $imovel->configuracoes['tel_celular']) ?>&text=Olá, gostaria de mais informações sobre o imóvel:%0A<?= $imovel->codigo ?>.">
                                                    <i class="fa-brands fa-whatsapp" style="height: 1.2rem;"></i>
                                                    CHAMAR NO WHATSAPP
                                                </a>
                                            </div>

                                            <div class="container-share mt-4">
                                                <span class="color_titulo">Compartilhar nas redes sociais</span>
                                                <div class="icons-rede">
                                                    <a target="_black" class="botao_wpp"
                                                        href="https://api.whatsapp.com/send?text=Olá, encontrei este imóvel e decidi compartilhar com você: https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>.">
                                                        <i class="fa-brands fa-whatsapp" style="height: 1.9rem;"></i>
                                                    </a>

                                                    <a target="_black" id="facebook-share-btt" target="_blank"
                                                        href="https://www.facebook.com/sharer/sharer.php?u=https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>">
                                                        <i class="fa-brands fa-facebook ico-rede-social"
                                                            style="height: 1.7rem;"></i>
                                                    </a>

                                                    <a target="_black"
                                                        href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>&title=<?= $imovel->titulo ?>&summary=&source=">
                                                        <i class="fa-brands fa-linkedin ico-rede-social"
                                                            style="height: 1.7rem;"></i>
                                                    </a>
                                                    <!-- <a target="_black"
                                                        href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>&title=<?= $imovel->titulo ?>&summary=&source=">
                                                        <img loading="lazy"
                                                            src="<?= $base ?>assets/icons/redes-sociais/tiktok-preto.png"
                                                            alt="TikTok" />
                                                    </a> -->
                                                    <a target="_black"
                                                        href="https://twitter.com/intent/tweet?text=!&url=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>&title=<?= $imovel->titulo ?>&summary=&source=">
                                                        <i class="fa-brands fa-twitter ico-rede-social"
                                                            style="height: 1.7rem;"></i>
                                                    </a>
                                                </div>



                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- END LADO DIRETIO DA TELA -->

            </div>
        </div>
    </div>
    <!-- END CONTEUDO PRINCIPAL -->

    <div id="secao-empreendimentos-filho" class="container-fluid">
        <?php if (EXIBIR_LACAMENTO_EM_MODAL == 0): ?>
            <div class="row margin-bottom-20 section_caracteristicas_externas">
                <div class="col-12 margin-bottom-30 margin-top-30">
                    <h2 class="titulo_secundario color_titulo_section_detalhes">Imóveis disponíveis para este lançamento
                    </h2>
                </div>
                <div class="col-12">
                    <div id="container-imoveis-filho" class="row">

                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>


    <!-- FORM ENCONTRAR IMOVEL -->
    <div id="call-imovel-ideal" class="form_section_detalhes_imovel">
        <div class="container-fluid">

            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                    <h2>Encontrar imóvel ideal?</h2>
                    <p>Não se preocupe. Deixe seu email e telefone que um especialista irá te ajudar.</p>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                    <form class="form-imovel-ideal" name="imovelideal">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="label-form">Seu Nome <span class="asterisco-valiacao">*</span></label>
                                <div class="input-group input-group-lg">
                                    <input id="nome-call" type="text" class="form-control form-text" placeholder="Nome"
                                        name="nome" required>

                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="label-form">Seu E-mail <span class="asterisco-valiacao">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <input id="email-call" type="email" class="form-control form-text"
                                        placeholder="E-mail" required>

                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="label-form">Seu Telefone <span class="asterisco-valiacao">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <input id="tel-call" type="text" class="form-control form-text"
                                        placeholder="DDD + Telefone" required>
                                </div>
                            </div>

                            <?php if ($imovel->configuracoes['captcha_ativo']) { ?>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div id="captcha-imovel-ideal" class="col-xs-12 margin-bottom-20 margin-top-20"
                                        data-sitekey="<?php echo $imovel->configuracoes['captcha_site_key']; ?>"></div>
                                </div>
                        </div>

                    <?php } ?>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <p style="font-size:13px;" class="my-4">Ao informar meus dados, eu concordo com a <a
                                class=" fs-1 text-decoration-underline politica-privaciade"
                                style="color: white; text-decoration: underline !important;"
                                href="<?= $base ?>politica-privacidade" target="_blank">Política de
                                Privacidade</a>.
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex align-items-end">
                        <button id="btn-call-to-action" type="submit"
                            class="btn btn-lg btn-light btn-primario btn-block">ENCONTRAR UM IMÓVEL</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>
    </div>
    <!-- END FORM ENCONTRAR IMOVEL -->


    <!-- CARROSSEL SIMILARES -->
    <div class="section_imoveis_similares" style="display: none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 margin-top-40 margin-bottom-20">
                    <h2 class="text-center">Imóveis Similares</h2>
                </div>
            </div>
            <div class="row margin-bottom-40">

                <div class="col-12 col-sm-12 col-md-12">
                    <div id="carrossel_imoveis_similares"></div>
                </div>

                <div class="col-12 col-sm-12 col-md-12">
                    <div class="d-flex justify-content-center align-item-center">
                        <img class="gif-silimares lazyload" style="width: 50px" loading="lazy"
                            data-src="<?= $base ?>assets/img/gif/ajax-loader.gif" border="0" alt="Loader" />
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12">
                    <div class="d-flex justify-content-center align-item-center margin-bottom-20 margin-top-20">
                        <div class="arrow-left-imovel arrow_circle">
                            <span class="carousel_setinha">‹</span>
                        </div>
                        <div class="arrow-right-imovel arrow_circle">
                            <span class="carousel_setinha">›</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- END CARROSSEL SIMILARES -->



    <!-- 
    ==============================================================
    ======= CARROSSEL MODAL GALERIA DE IMAGEM TELA CHEIA =========
    ==============================================================
    -->
    <div class="modal modal-carrossel" tabindex="-1" role="dialog" aria-label="Modal Carrossel">
        <buttom id="fechar-modal" class="btn btn-secondary">Fechar x </buttom>
        <div id="galeria-full"></div>

        <div class="arrow-left-modal">
            <img class="lazyload" src="<?= $base ?>assets/icons/seta-anterior-galeria.svg" alt="Anterior" border="0" />
        </div>
        <div class="arrow-right-modal">
            <img class="lazyload" src="<?= $base ?>assets/icons/seta-proximo-galeria.svg" alt="Próximo" border="0" />
        </div>

        <div id="galeria-mini"></div>
    </div>
    <!--FIM CARROSSEL MODAL-->


    <!--     
    ==============================================================
    =================== MODAL DE AGENDAMENTO DE =================
    ==============================================================
    -->
    <div id="staticBackdrop" class=" modal fade ">

        <!--CONTEUDO DO CALENDARIO-->
        <div id="ag-data-modal" class="modal-dialog modal-lg">
            <div class="modal-content back_primario color_texto">
                <div class="modal-header">
                    <p class="modal-title" id="staticBackdropLabel">Agendar Visita</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 corpo-tutulo-agenda">
                            <p class="titulo-agendamento text-center">Escolha a melhor data para agendarmos sua visita
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="load-horarios text-center">Carregando datas...</p>
                        </div>

                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-1">
                            <img class="seta-agenda-left lazyload" loading="lazy"
                                data-src="<?php echo $base ?>assets/icons/icon-seta-left.svg" border="0"
                                alt="Seta para esquerda" />
                        </div>
                        <div class="col-8">
                            <div id="carrossel-data-a">
                            </div>
                        </div>
                        <div class="col-1">
                            <img class="seta-agenda-right lazyload" loading="lazy"
                                data-src="<?php echo $base ?>assets/icons/icon-seta-right.svg" border="0"
                                alt="Seta para direita" />
                        </div>
                    </div>

                    <div class="row corpo-tutulo-agenda">
                        <div class="col-12">
                            <p id="text-horarios" class="titulo-agendamento text-center">agora qual o melhor horário?
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">

                        <div class="col-1">
                            <img class="seta-agenda-hora-left lazyload" loading="lazy"
                                data-src="<?php echo $base ?>assets/icons/icon-seta-left.svg" border="0"
                                alt="Seta para esquerda" />
                        </div>
                        <div class="col-8">
                            <div id="carrossel-horaio">
                                <!--                                    
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        08:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        10:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        11:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        12:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        13:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        14:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        15:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        09:00
                                    </div>
                                    <div class="card-hora d-flex flex-column justify-content-center align-items-center">
                                        09:00
                                    </div>
                                -->
                            </div>
                        </div>
                        <div class="col-1">
                            <img class="seta-agenda-hora-right lazyload" loading="lazy"
                                data-src="<?php echo $base ?>assets/icons/icon-seta-right.svg" border="0"
                                alt="Seta para direita" />
                        </div>
                    </div>
                    <div class="footer-modal">
                        <div class="row d-flex justify-content-center align-items-center">
                            <!--                                
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                    <button type="button" class="btn btn-block btn-primario-light ">Voltar</button>
                                </div>
                            -->
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                <button disabled="false" id="btn-ag-data-avancar" type="button"
                                    class="btn btn-block btn-primario">Avançar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--FORMULARIO-->
        <div id="ag-horario-modal" class="modal-dialog modal-lg">
            <div class="modal-content back_primario color_texto">
                <div class="modal-header">
                    <p class="modal-title" id="staticBackdropLabel">Agendar Visita</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="visitaimovel" name="visitaimovel">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 corpo-tutulo-agenda">

                                <p class="titulo-agendamento-form text-center">
                                    <img class="lazyload" data-style="margin-top: -5px;" loading="lazy"
                                        data-src="<?= $base ?>assets/icons/icon-calendario.svg" border="0"
                                        alt="Agenda" /> <span id="txt-data-agenda">Segunda, 20 de Abril ás 11:00</span>
                                    <input id="form-ag-finalidade" hidden name="finalidade" type="text"
                                        class="form-control"
                                        value="<?= $imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?>" />
                                    <input id="form-ag-codimovel" hidden name="codimovel" type="text"
                                        class="form-control" value="<?= $imovel->codigo ?>" />
                                    <input id="form-ag-data" hidden name="dataagendamento" type="text"
                                        class="form-control" value="" />
                                </p>
                            </div>
                            <div class="col-12 corpo-tutulo-agenda">
                                <p class="text-center descricao-ag-form">Agora só faltam os seus dados para receber a
                                    confirmação da visita.</p>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center" style="padding:5px">
                            <div class="row">
                                <div class="col-12">
                                    <label class="label-form">SEU nome <span class="asterisco-valiacao">*</span></label>
                                    <input id="form-ag-nome" name="nome" type="text" class="form-control"
                                        placeholder="EX: José da silva" required />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">SEU E-mail <span class="asterisco-valiacao">*</span>
                                    </label>
                                    <input id="form-ag-email" name="email" type="email" class="form-control"
                                        placeholder="EX: jose@gmail.com" required />
                                </div>

                                <div class="col-12">
                                    <label class="label-form">Celular <span class="asterisco-valiacao">*</span></label>
                                    <input id="form-ag-celular" name="celular" type="text" class="form-control"
                                        placeholder="EX:(31) 9 9191-9191" required />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">Mensagem (Não obrigatrio)</label>
                                    <textarea id="form-ag-msg" name="mensagem" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <p class="msg-retorno-agenda"></p>
                                </div>
                                <div class="col-12">
                                    <p style="font-size:13px;" class="my-4">Ao informar meus dados, eu concordo com a <a
                                            class="text-primary fs-1 text-decoration-underline"
                                            href="<?= $base ?>politica-privacidade" target="_blank">Política de
                                            Privacidade</a>.
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div id="captcha-agendar-visita"
                                        data-sitekey="<?php echo $imovel->configuracoes['captcha_site_key']; ?>">
                                    </div>
                                </div>

                            </div>
                            <!-- <div class="row">
                                <div class="col-12">
                                    <p class="msg-retorno-agenda"></p>
                                </div>
                            </div> -->

                        </div>
                        <div class="footer-modal back_primario color_texto" style="background:#FFF">
                            <div class="row d-flex justify-content-center align-items-center" style="background:#FFF">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                    <button id="voltar-agenda" type="button"
                                        class="btn btn-block btn-primario-light ">VOLTAR</button>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                    <button id="btn-agendar-visita" type="submit"
                                        class="btn btn-block btn-primario">AGENDAR VISITA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--MSG LEAD ENVIADO COM SUCESSO-->
        <div id="ag-horario-success-modal" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="staticBackdropLabel">Agendar Visita</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 corpo-tutulo-agenda">

                            <p class="titulo-agendamento-form text-center">
                        </div>
                        <div class="col-12 corpo-tutulo-agenda">
                            <p class="cod-detalhes-card text-center">Cód. Imóvel <span
                                    id="cod-principal-form"><?= $imovel->codigo ?></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-center">Obrigado!</h6>
                            <p class="text-center">Agendamento Feito com sucesso.</p>
                            <p class="text-center">Nosso corretor irá entrar em contato minutos antes para lembrar da
                                visita</p>
                        </div>
                    </div>

                    <div class="footer-modal">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                <button id="fecher-agenda" type="button"
                                    class="btn btn-block btn-primario-light ">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--FORMULARIO DE LEAD-->
        <div id="for-lead-modal" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="staticBackdropLabel">Fale conosco</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="leadimovel">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 corpo-tutulo-agenda">

                                <p class="titulo-agendamento-form text-center">
                                    <span id="txt-data-agenda">Fale conosco </span>
                                </p>
                            </div>
                            <div class="col-12 corpo-tutulo-agenda">
                                <p class="text-center descricao-ag-form">Saiba mais sobre este imóvel</p>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="row" style="padding: 0 60px;">
                                <input id="form-corretor-finalidade" hidden name="finalidade" type="text"
                                    class="form-control"
                                    value="<?= $imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?>" />
                                <input id="form-corretor-codimovel" hidden name="codimovel" type="text"
                                    class="form-control" value="<?= $imovel->codigo ?>" />
                                <div class="col-12">
                                    <p>Código: <span class="cod-id-form"><?= $imovel->codigo ?></span></p>

                                </div>
                                <div class="col-12">
                                    <label class="label-form">SEU nome</label>
                                    <input id="form-corretor-nome" name="nome" type="text" class="form-control"
                                        placeholder="EX: José da silva" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">SEU E-mail</label>
                                    <input id="form-corretor-email" name="email" type="email" class="form-control"
                                        placeholder="EX: jose@gmail.com" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">celular</label>
                                    <input id="form-corretor-celular" name="telefone" type="text" class="form-control"
                                        placeholder="EX:(28) 9 9191-9191" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">Mensagem (Não obrigatrio)</label>
                                    <textarea id="form-corretor-msg" name="mensagem" class="form-control"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="alerta-corretor">
                                        <p class="msg-retorno-agenda"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="footer-modal">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                    <p class="text-politica-privaciade my-4">Ao informar meus dados, eu concordo com a
                                        <a class="text-primary fs-1 text-decoration-underline"
                                            href="<?= $base ?>politica-privacidade" target="_blank"> <span>Política de
                                                Privacidade.</span> </a>
                                    </p>
                                    <button id="btn-fale-corretor" type="submit"
                                        class="btn btn-block btn-primario">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FIM MODAL PARA AGENDAMENTO -->
    <div id="btn-call-mobile">
        <img class="" src="<?= $base ?>assets/icons/icon-calendario-white.svg" alt="Calendário" />
    </div>


    <!-- HIDDENS DA PAGINA -->
    <input type="hidden" id="codigoimovel" value="<?= $imovel->codigo ?>" />

    <?php $render('footer/footer', $imovel->configuracoes) //html do footer 
    ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):

    ?>

        <?php

        $mensagem_whatsapp = ['mensagem_whatsapp' => 'Olá, encontrei vocês através do '. ($_COOKIE['utm_source'] ? $_COOKIE['utm_source'] : 'site' ) . ', gostaria de mais informações sobre o imóvel:  ' . $imovel->codigo];

        $render('comum/whatsapp',  $mensagem_whatsapp); //inclui o botão do whatsapp 
        ?>

        <?php $render('scripts/scripts-footer', $imovel->script) //scripts do banco do cms 
        ?>
        <?php $render('footer/footer-import', $imovel->script) //comum do footer 
        ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>

        <script src="https://apis.google.com/js/api.js?v=<?= VERSAO ?>" type="text/javascript"></script>
        <script src="https://www.google.com/jsapi"></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onLoadCallback&render=explicit" async defer></script>
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?= APIGOOLGE ?>"></script>
        <!-- <script src="<?= $base ?>assets/js/detalhe-imovel/favoritos.js?v=<?= VERSAO ?>"></script> -->
        <script src="<?= $base ?>assets/js/detalhe-imovel/agenda.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/galeria-vs2.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.js?v=<?= VERSAO ?>"></script>

        <script src="<?= $base ?>assets/js/detalhe-imovel/config-multiplos-captcha.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/fotos360.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/form-tenho-interesse.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/form-call-to-action.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/index.js?v=<?= VERSAO ?>"></script>


    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>


</body>

</html>