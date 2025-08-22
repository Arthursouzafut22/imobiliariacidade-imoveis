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
        <link rel="stylesheet" href="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/condominio-detalhe/index.css?v=<?= VERSAO ?>" />

        <!-- IMPORT BOOSTRAP -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <script src="https://storage.googleapis.com/vrview/2.0/build/vrview.min.js?v=<?= VERSAO ?>"></script>
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
            rel="stylesheet" />
        <script src="https://app.imoview.com.br/scripts/esteira.js?v=<?= VERSAO ?>" type="text/javascript"></script>

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms ?>

        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body>
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>
    <?php $render('header/menu-modal', $configuracoes); // ?>
    <?php $render('header/header', $configuracoes); //carrega o header ?>

    <!-- CONTEUDO GALERIA, MAPA, STREET VIEW -->
    <div id="section_conteuo_header" class="">

        <span id="fovoritos-principal" codigo="<?= $imovel->codigo ?>"
            class="icon-favoritos d-flex justify-content-center align-items-center">
            <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-favorito-cinza.svg" alt="Favoritos"
                border="0" />
        </span>

        <!-- GALERIA DE FOTOS -->
        <?php
        $limitFotos = DISPOSITIVO_MOBILE == 0 ? 7 : 3;
        $classBotaoMobile = DISPOSITIVO_MOBILE == 0 ? "open_foto_sel" : "";
        $totalFotosApi = count($imovel->fotos); //total de fotos do imovel
        $numeroFotos = $totalFotosApi >= $limitFotos ? $limitFotos : $totalFotosApi; //maximo de fotos do for é 7
        $totalFotosFaltantes = $limitFotos - $totalFotosApi;


        ?>

        <?php if ($totalFotosApi > 0): ?>

            <div id="cont-fotos" class="container-exibicao" data-totalfotos="<?php echo $totalFotosApi; ?>">
                <ul class="galeria-vs2">
                    <?php
                    //aqui eu tiro 1 porque o for começa com zero
                    $numeroForeach = $numeroFotos - 1;

                    //faço o for nas fotos
                    for ($index = 0; $index <= $numeroForeach; $index++) {
                        $tamanhoFoto = $index == 0 ? "urlm" : "urlp";
                        $urlImagem = $imovel->fotos[$index]->$tamanhoFoto;
                        ?>
                        <li class="item_imagem_galeria <?= $classBotaoMobile ?>" data-index="<?= $index ?>" data-foto="api">
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
                            $nome_foto = $imovel->fotos[$index]->descricao != "" ? $imovel->fotos[$index]->descricao : "Foto Imóvel";
                            ?>
                            <li class="item_imagem_galeria <?= $classBotaoMobile ?>" data-index="<?= $index ?>"
                                style="<?= $style_foto ?>" data-foto="faltante">
                                <img src="<?= $base ?>assets/img/busca/imagem-nao-disponivel-<?=TEMA_STRING?>.webp" border="0"
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

        <?php endif ?>


        <!-- END GALERIA DE FOTOS -->


        <!-- CONTAINER EXIBICAO DO MAPA -->
        <div class="row">
            <div class="col-12">
                <div id="map" data-latitude="<?= $imovel->longitude ?>" data-longitude="<?= $imovel->longitude ?>"
                    class="container-exibicao"></div>
            </div>
        </div>
        <!-- END CONTAINER EXIBICAO DO MAPA -->

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
                <iframe title="Container Vídeo" id="ifram-video" width="100%" height="400px"
                    src="<?= $imovel->urlvideo ?>" frameborder="0"
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
    <div class="container">
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

                    <!-- <?php if ($imovel->urlpublica != ''): ?>
                        <button id="btn-tour" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" data-src="<?= $base ?>assets/icons/icon-cubo-cinza.svg" alt="Tour Virtual" border="0" /> <span class="text-botao-cinza">TOUR VIRTUAL</span>
                        </button>
                    <?php endif; ?> -->

                    <?php if (0 != 0): ?>
                        <button id="btn-rua" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" src="<?= $base ?>assets/icons/icon-street-cinza.svg" alt="Rua"
                                border="0" /> <span class="text-botao-cinza">RUA</span>
                        </button>
                    <?php endif; ?>

                    <?php if ((APIGOOLGE != '' || APIGOOLGE != '#') && count($imovel->fotos360) > 0): ?>
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
    <div class="container">
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

            <div class="row">
            </div>

            <div class="row margin-top-20">
                <!-- COL LEFT -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 container-esquerda">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base ?>">Início</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= $base ?><?= strtolower($imovel->codigofinalidade == 2 ? 'venda' : 'aluguel') ?>"><?= $imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?></a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="<?= $base ?><?= strtolower($imovel->codigofinalidade == 2 ? 'venda' : 'aluguel') ?>/imovel/<?= $imovel->url_cidade ?>/<?= $imovel->url_bairro ?>/0-banheiros+0-quartos+0-suites+0-vagas"><?= $imovel->bairro ?></a>
                            </li>
                            <li id="breadcrumb-endereco" class="breadcrumb-item active" aria-current="page">
                                <?= $imovel->endereco ?>
                            </li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="preco-imovel-mobile">
                                    <?= $imovel->valor ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h1 class="titulo_principal"><?= $imovel->nome ?></h1>
                            <p class="sub-titulo"><?= $imovel->bairro ?>, <?= $imovel->cidade ?> -
                                <?= $imovel->estado ?>
                            </p>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-end">

                        <div
                            class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->areaprincipal == "0,00" ? "hide" : "" ?>">
                            <img class="lazyload icon_" style="width: 25px;"
                                src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-area.svg" alt="Área" border="0" />
                            <p><?= $imovel->areaprincipal ?> m²</p>
                        </div>

                        <div
                            class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->arealote == "0,00" ? "hide" : "" ?>">
                            <img class="lazyload" style="width: 25px;"
                                src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-cerca.svg" alt="Área" border="0" />
                            <p><?= $imovel->arealote ?> m²</p>
                        </div>
                        <div
                            class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numeroquartos == "0" ? "hide" : "" ?>">
                            <img class="lazyload" style="width: 25px;"
                                src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-bed.svg" alt="Cama" border="0" />
                            <p><?= $imovel->numeroquartos ?> quarto(s)</p>
                        </div>
                        <div
                            class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numerobanhos == "0" ? "hide" : "" ?>">
                            <img class="lazyload" style="width: 25px;"
                                src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-shower.svg" alt="Chuveiro" border="0" />
                            <p><?= $imovel->numerobanhos ?> banheiro(s)</p>
                        </div>
                        <div
                            class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numerovagas == "0" ? "hide" : "" ?>">
                            <img class="lazyload" style="width: 25px;"
                                src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-garage.svg" alt="Garagem" border="0" />
                            <p><?= $imovel->numerovagas ?> Vaga(s) </p>
                        </div>
                        <div
                            class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numerosuites == "0" ? "hide" : "" ?>">
                            <img class="lazyload" style="width: 25px;"
                                src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-suites.svg" alt="Suítes" border="0" />
                            <p><?= $imovel->numerosuites ?> Suite(s)</p>
                        </div>
                    </div>

                    <div class="row margin-top-20 <?= $imovel->descricao == "" ? "hide" : "" ?>">
                        <div class="col-12 margin-bottom-10">
                            <h2 class="titulo_secundario">Descrição do imóvel</h2>
                        </div>
                        <div class="col-12">
                            <p class="descricao"><?= nl2br($imovel->descricao) ?> </p>
                        </div>
                    </div>

                    <div class="row destaque-card">

                        <?php if ($imovel->valorvenda != 'R$ 0,00 até R$ 0,00'): ?>
                            <div class="col-12">
                                <div class="container-precos">
                                    <p class="mb-3">Mediana do preço de apartamentos anunciados para venda</p>
                                    <div class="line-info-card"><span>Valor</span>
                                        <strong><?= ($imovel->valorvenda != 'R$ 0,00 até R$ 0,00' ? $imovel->valorvenda : 'Não informado') ?></strong>
                                    </div>
                                    <div class="line-info-card"><span>1° Quartil </span>
                                        <strong><?= $imovel->primeiroquartilvenda != "R$ 0,00" ? $imovel->primeiroquartilvenda : 'Não Informado' ?></strong>
                                    </div>
                                    <div class="line-info-card"><span>Mediana </span>
                                        <strong><?= $imovel->medianaquartilvendido != "R$ 0,00" ? $imovel->medianaquartilvendido : 'Não Informado' ?></strong>
                                    </div>
                                    <div class="line-info-card"><span>3° Quartil </span>
                                        <strong><?= ($imovel->terceiroquartilvendido != "R$ 0,00" ? $imovel->terceiroquartilvendido : 'Não Informado') ?></strong>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if ($imovel->valoraluguel != 'R$ 0,00 até R$ 0,00'): ?>
                            <div class="col-12">
                                <div class="container-precos">
                                    <p class="mb-3">Mediana do preço de apartamentos anunciados para aluguel</p>
                                    <div class="line-info-card"><span>Valor</span>
                                        <strong><?= $imovel->valoraluguel != 'R$ 0,00 até R$ 0,00' ? $imovel->valoraluguel : 'Não Informado' ?></strong>
                                    </div>
                                    <div class="line-info-card"><span>1° Quartil </span>
                                        <strong><?= $imovel->primeiroquartilaluguel != "R$ 0,00" ? $imovel->primeiroquartilaluguel : 'Não Informado' ?></strong>
                                    </div>
                                    <div class="line-info-card"><span>Mediana </span>
                                        <strong><?= $imovel->medianaquartilaluguel != "R$ 0,00" ? $imovel->medianaquartilaluguel : 'Não Informado' ?></strong>
                                    </div>
                                    <div class="line-info-card"><span>3° Quartil </span>
                                        <strong><?= $imovel->terceiroquartilaluguel != "R$ 0,00" ? $imovel->terceiroquartilaluguel : 'Não Informado' ?></strong>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>


                    <?php if (count($imovel->unidadesvenda->disponiveis) > 0): ?>
                        <div class="row">
                            <div class="col-12 margin-bottom-30 margin-top-30">
                                <h6 class="titulo_secundario">Tipos e quantidade de Imóveis para venda</h6>
                            </div>
                            <?php foreach ($imovel->unidadesvenda->disponiveis as $imo): ?>
                                <div class="col-12 col-sm-12">
                                    <div class="line-info-card">
                                        <strong><?= $imo->tipo ?></strong>
                                        <span><?= $imo->quantidade ?> </span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>


                    <?php if (count($imovel->unidadesaluguel->disponiveis) > 0): ?>
                        <div class="row">
                            <div class="col-12 margin-bottom-30 margin-top-30">
                                <h2 class="titulo_secundario">Tipos e quantidade de Imóveis para aluguel</h2>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($imovel->unidadesaluguel->disponiveis as $imo): ?>
                                <div class="col-12 col-sm-12">
                                    <div class="line-info-card">
                                        <strong><?= $imo->tipo ?></strong>
                                        <span><?= $imo->quantidade ?> - unidade</span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>


                    <div class="row">
                        <!-- <div class="col-12margin-top-30">
                            <h2 class="titulo_secundario">VER IMÓVEIS DISPONÍVEIS</h2>
                        </div> -->
                        <div class="col-12">
                            <div class="container-link-busca">
                                <?php if ((count($imovel->unidadesvenda->disponiveis) > 0)): ?>
                                    <a
                                        href="<?= $base ?>venda/imovel/regiao-do-barreiro/todos-os-bairros/<?= $imovel->url_amigavel ?>/?&pagina=1">
                                        <button class="btn-ver-imoveis">
                                            <span>VER IMÓVEIS À VENDA</span>
                                        </button>
                                    </a>
                                <?php endif ?>
                                <?php if (count($imovel->unidadesaluguel->disponiveis) > 0): ?>
                                    <a
                                        href="<?= $base ?>aluguel/imovel/regiao-do-barreiro/todos-os-bairros/<?= $imovel->url_amigavel ?>/?&pagina=1">
                                        <button class="btn-ver-imoveis">
                                            <span>VER IMÓVEIS PARA LOCAÇÃO</span>
                                        </button>
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="row margin-top-20 section_caracteristicas_internas" style="display: none;">

                        <div class="col-12 margin-bottom-30">
                            <h2 class="titulo_secundario">Características internas</h2>
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
                            <h2 class="titulo_secundario">Características externas</h2>
                        </div>

                        <div class="col-12">
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




                    <?php if (count($imovel->extras2) > 0): ?>
                        <div class="row margin-bottom-20 section_caracteristicas_extras" style="">

                            <div class="col-12 margin-bottom-30">
                                <h2 class="titulo_secundario">Características extras</h2>
                            </div>
                            <div class="col-12 margin-bottom-20">
                                <ul class="lista-caracteristicas-extras caracteristicas-extras">
                                    <?php foreach ($imovel->extras2 as $key => $extra): ?>
                                        <li class="caracteristicas-extras extras-active">
                                            <img class="lazyload" loading="lazy"
                                                data-src="<?= $base ?>assets/icons/icon-check.svg" />
                                            <?= $extra->nome ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <!-- END COL LEFT -->

                <!-- LADO DIRETIO DA TELA -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 container-direito">
                    <div class="row d-flex  justify-content-end container-direito-nivel-1">
                        <div class="cont-call-to-action">
                            <form class="form-detalhe-condominio" name="detalhecondominio">
                                <input id="codigo-empreendimento" type="text" value="<?= $imovel->codigocondominio ?>"
                                    hidden>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label class="label-form">Nome Empreendimento</label>
                                        <div class="input-group input-group-lg">
                                            <input id="nome-empreendimento" type="text" value="<?= $imovel->nome ?>"
                                                class="form-control form-text" placeholder="Nome"
                                                name="nome-empreendimento" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label class="label-form"> Seu Nome <span
                                                class="asterisco-valiacao">*</span></label>
                                        <div class="input-group input-group-lg">
                                            <input id="nome-call" type="text" class="form-control form-text"
                                                placeholder="Nome" name="nome" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label class="label-form"> Seu E-mail <span
                                                class="asterisco-valiacao">*</span></label>
                                        <div class="input-group input-group-lg">
                                            <input id="email-call" type="email" class="form-control form-text"
                                                placeholder="E-mail" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label class="label-form"> Seu Telefone <span
                                                class="asterisco-valiacao">*</span></label>
                                        <div class="input-group input-group-lg">
                                            <input id="tel-call" type="text" class="form-control form-text"
                                                placeholder="DDD + Telefone" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label class="label-form">Mensagem</label>
                                        <div class="input-group input-group-lg">
                                            <textarea id="mensagem" type="text" class="form-control" rows="4"
                                                placeholder="">Olá gostaria de mais informações sobre o condomínio: <?= $imovel->nome ?>. Código do condomínio: <?= $imovel->codigo ?>.</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="alerta-imovel-ideal">
                                            <p class="text-center" style="color:#FFF">Obrigado por entrar em contato!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <p style="font-size:13px;" class="my-4">Ao informar meus dados, eu concordo com
                                            a <a class=" fs-1 text-decoration-underline"
                                                style="color: blue; text-decoration: underline !important;"
                                                href="<?= $base ?>politica-privacidade" target="_blank">Política de
                                                Privacidade</a>.
                                        </p>
                                    </div>

                                    <?php if ($configuracoes['captcha_ativo']) { ?>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-bottom-20">
                                            <div class="g-recaptcha"
                                                data-sitekey="<?php echo $configuracoes['captcha_site_key']; ?>"></div>
                                        </div>
                                    <?php } ?>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex align-items-end">
                                        <button id="btn-call-to-action" type="submit"
                                            class="btn btn-lg btn-light btn-primario btn-block">ENVIAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END LADO DIRETIO DA TELA -->
            </div>
        </div>
    </div>
    <!-- END CONTEUDO PRINCIPAL -->



    <!-- HIDDENS DA PAGINA -->
    <input type="hidden" id="codigoimovel" value="<?= $imovel->codigo ?>" />

    <?php $render('footer/footer', $configuracoes) //html do footer ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>

        <?php $render('footer/footer-import', $script) //comum do footer ?>
        <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>

        <script src="https://apis.google.com/js/api.js?v=<?= VERSAO ?>" type="text/javascript"></script>
        <script src="https://www.google.com/jsapi"></script>
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?= APIGOOLGE ?>"></script>
        <script src="<?= $base ?>assets/js/lib/jquery.mask.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-condominio/favoritos.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-condominio/galeria-vs2.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-condominio/fomulario.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-condominio/index.js?v=<?= VERSAO ?>"></script>



        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>