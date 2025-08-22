<!doctype html>
<html lang="pt-br">
<head>

    <?php if (PAGE_SPEED_100) : ?>

    <?php endif ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title><?= $imovel->titulo ?></title>

    <meta name="title" content="<?= $imovel->titulo ?>" />
    <meta name="description" content="<?= $imovel->metadescription ?>" />
    <link rel="canonical" href="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>" />
    <meta name="robots" content="index" />

    <!-- CONFIGURAÇÕES DE COMPARTILHAMENTO DE LINK -->
    <meta property="og:title" content="<?= $imovel->titulo ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?= $imovel->metadescription ?>" />
    <meta property="og:url" content="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>" />
    <meta property="og:image" content="<?= $imovel->urlfotoprincipalpp ?>" />

    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="135">
    <meta property="og:image:height" content="135">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>">
    <meta property="twitter:title" content="<?php echo $imovel->titulo ?>">
    <meta property="twitter:description" content="<?= $imovel->metadescription ?>">
    <meta property="twitter:image" content="<?php echo  $imovel->urlfotoprincipalpp ?>">
    <!--Indica aos mecanismos de busca se deseja mostrar sua página nos resultados da pesquisa ou não -->

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?= $base ?>assets/img/favico.ico" type="image/x-icon?v=1.0">

    <?php if (PAGE_SPEED_100) : ?>

        <!-- IMPORTAÇAO DO CARROSSEL -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?= VERSAO ?>" />

        <!--IMPORT BOOSTRAP-->
        <link rel="stylesheet" href="<?= $base ?>assets/lib/bootstrap450/css/bootstrap.min.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.css?v=<?= VERSAO ?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/detalhe-imovel/detalhe-imovel.css?v=<?= VERSAO ?>" />

        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <script src="https://app.imoview.com.br/scripts/esteira.js?v=<?= VERSAO ?>" type="text/javascript"></script>

        <script src="https://storage.googleapis.com/vrview/2.0/build/vrview.min.js?v=<?= VERSAO ?>"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <?php endif ?>
</head>
<body>
    <?php if (PAGE_SPEED_100) : ?>
    <?php endif ?>

    <!-- IMPORTAÇÃO DO HEADER -->
    <?php $render('menu-modal', $imovel->configuracoes);?>
    <?php $render('header', $imovel->configuracoes); ?>

    <!-- CONTEUDO GALERIA, MAPA, STREET VIEW -->
    <div class="">
        <?php echo $imovel->tag ?>

        <span id="fovoritos-principal" codigo="<?= $imovel->codigo ?>" class="icon-favoritos d-flex justify-content-center align-items-center">
            <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-favorito-cinza.svg" />
        </span>

        <!-- GALERIA DE FOTOS -->
        <?php
        $limitFotos             = DISPOSITIVO_MOBILE == 0 ? 7 : 3;
        $classBotaoMobile       = DISPOSITIVO_MOBILE == 0 ? "open_foto_sel" : "";
        $totalFotosApi          = count($imovel->fotos); //total de fotos do imovel
        $numeroFotos            = $totalFotosApi >= $limitFotos ? $limitFotos : $totalFotosApi; //maximo de fotos do for é 7
        $totalFotosFaltantes    = $limitFotos - $totalFotosApi;
        ?>
        <div id="cont-fotos" class="container-exibicao" data-totalfotos="<?php echo $totalFotosApi; ?>">
            <ul class="galeria-vs2">
                <?php
                //aqui eu tiro 1 porque o for começa com zero
                $numeroForeach          = $numeroFotos - 1;

                //faço o for nas fotos
                for ($index = 0; $index <= $numeroForeach; $index++) {
                    $tamanhoFoto    = $index == 0 ? "urlm" : "urlp";
                    $urlImagem      = $imovel->fotos[$index]->$tamanhoFoto;
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
                    ?>
                        <li class="item_imagem_galeria <?= $classBotaoMobile ?>" data-index="<?= $index ?>" style="<?= $style_foto ?>" data-foto="faltante">
                            <img src="<?= $base ?>assets/img/busca/imagem-nao-disponivel-<?=TEMA_STRING?>.webp" border="0" alt="<?= $imovel->fotos[$index]->descricao ?>" />
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
                ?>
                    <a data-fancybox="gallery" data-index="<?= $key ?>" href="<?= $itemFoto->url ?>">
                        <img class="loadimage" data-src="<?= $itemFoto->url ?>" title="<?= $itemFoto->fotos[$index]->descricao ?>" alt="<?= $itemFoto->fotos[$index]->descricao ?>">
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
                <iframe id="ifram-stree" width="100%" height="400px" src=""></iframe>
            </div>
        </div>
        <!-- END CONTAINER EXIBICAO STREET VIEW -->

        <!-- CONTAINER TOUR VIRTUAL -->
        <div id="tour-virtual" class="row container-exibicao">
            <div class="col-12">
                <iframe id="ifram-tour" width="100%" height="400px" src="" allowfullscreen></iframe>
            </div>
        </div>
        <!-- END CONTAINER TOUR VIRTUAL -->


        <!-- CONTAINER VIDEO -->
        <div id="video" class="row container-exibicao">
            <div class="col-12">
                <iframe id="ifram-video" width="100%" height="400px" src="#" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <!-- CONTAINER VIDEO -->
        <div id="imagens360" class="row container-exibicao">
        </div>
    </div>
    <!-- END CONTEUDO GALERIA, MAPA, STREET VIEW -->



    <!-- SETAS DO CARROSSEL DE FOTOS 360 -->
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

    <!-- BOTOES GALERIA, MAPA, STREET VIEW -->
    <div class="container">
        <div class="row margin-top-10">
            <div class="col-12">
                <div id="container-buttom" class="wrap_botoes_detalhes_imovel">
                    <?php
                    if (MAPA_DETALHES_IMOVEL_LOCALIZACAO != 0 || $imovel->urlvideo != '' || $imovel->urlpublica != '' || MAPA_DETALHES_IMOVEL_RUA != 0) {
                    ?>
                        <button id="btn-fotos" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" src="<?= $base ?>assets/icons/icon-foto-cinza.svg" /> <span class="text-botao-cinza">FOTOS</span>
                        </button>
                    <?php
                    }
                    ?>
                    <?php if (MAPA_DETALHES_IMOVEL_LOCALIZACAO != 0) : ?>
                        <button id="btn-mapa" class="btn  btn-cinza-light">
                            <img class="icon-botao lazyload" src="<?= $base ?>assets/icons/icon-mapa-cinza.svg" /> <span class="text-botao-cinza">MAPA</span>
                        </button>
                    <?php endif; ?>

                    <?php if ($imovel->urlvideo != '') : ?>
                        <button id="btn-video" class="btn  btn-cinza-light">
                            <img class="icon-botao lazyload" data-src="<?= $base ?>assets/icons/icon-camera-cinza.svg" /> <span class="text-botao-cinza">VÍDEO</span>
                        </button>
                    <?php endif; ?>

                    <?php if ($imovel->urlpublica != '') : ?>
                        <button id="btn-tour" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" data-src="<?= $base ?>assets/icons/icon-cubo-cinza.svg" /> <span class="text-botao-cinza">TOUR VIRTUAL</span>
                        </button>
                    <?php endif; ?>

                    <?php if (MAPA_DETALHES_IMOVEL_RUA != 0) : ?>
                        <button id="btn-rua" class="btn btn-cinza-light">
                            <img class="icon-botao lazyload" src="<?= $base ?>assets/icons/icon-street-cinza.svg" /> <span class="text-botao-cinza">RUA</span>
                        </button>
                    <?php endif; ?>

                    <?php if ((APIGOOLGE != '' ||  APIGOOLGE != '#') && count($imovel->fotos360) > 0) : ?>
                        <button id="btn-foto-360" class="btn btn-cinza-light">
                            <span class="icon-botao material-symbols-outlined">360</span> <span class="text-botao-cinza">360°</span>
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
                        <img class="icon-botao lazyload" width="22px" data-src="<?= $base ?>assets/icons/icon-email-branco.svg" src=""> &nbsp;&nbsp;FALE CONOSCO
                    </button>
                </div>
                <div class="col-6">
                    <button class="open_modal_agendar_visita botao_header_mobile agendar-visita">
                        <img class="icon-botao lazyload" data-src="<?= $base ?>assets/icons/icon-calendario-white.svg" src=""> &nbsp;&nbsp;AGENDAR VISITA
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
                            <li class="breadcrumb-item"><a href="<?= $base ?><?= strtolower($imovel->codigofinalidade == 2 ? 'venda' : 'aluguel') ?>"><?=$imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?></a></li>
                            <li class="breadcrumb-item"><a href="<?= $base ?><?= strtolower($imovel->codigofinalidade == 2 ? 'venda' : 'aluguel') ?>/imovel/<?= $imovel->url_cidade ?>/<?= $imovel->url_bairro ?>/0-banheiros+0-quartos+0-suites+0-vagas"><?= $imovel->bairro ?></a></li>
                            <li id="breadcrumb-endereco" class="breadcrumb-item active" aria-current="page"><?= $imovel->endereco ?></li>
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
                            <h1 class="titulo_principal"><?= $imovel->titulo ?></h1>
                            <p class="sub-titulo"><?= $imovel->bairro ?>, <?= $imovel->cidade ?> - <?= $imovel->estado ?></p>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-end ">

                        <div class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->areaprincipal == "0,00" ? "hide" : "" ?>">
                            <i style="height: 1.3rem;" class="fa-solid fa-house-chimney-window"></i>
                            <p><?= $imovel->areaprincipal ?> m²</p>
                        </div>

                        <div class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->arealote == "0,00" ? "hide" : "" ?>">
                            <i style="height: 1.3rem;" class="fa-solid fa-vector-square"></i>
                            <p><?= $imovel->arealote ?> m²</p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numeroquartos == "0" ? "hide" : "" ?>">
                            <i style="height: 1.3rem;" class="fa-solid fa-bed"></i>
                            <p><?= $imovel->numeroquartos ?> quarto(s)</p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numerobanhos == "0" ? "hide" : "" ?>">
                            <i style="height: 1.3rem;" class="fa-solid fa-shower"></i>
                            <p><?= $imovel->numerobanhos ?> banheiro(s) </p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numerovagas == "0" ? "hide" : "" ?>">
                            <i style="height: 1.3rem;" class="fa-solid fa-warehouse"></i>
                            <p><?= $imovel->numerovagas ?> Vaga(s) </p>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center icon_detalhes <?= $imovel->numerosuites == "0" ? "hide" : "" ?>">
                            <i style="height: 1.3rem;" class="fa-solid fa-bath"></i>
                            <p><?= $imovel->numerosuites ?> Suíte(s)</p>
                        </div>
                    </div>

                    <div class="row margin-top-20 <?= $imovel->descricao == "" ? "hide" : "" ?>">
                        <div class="col-12 margin-bottom-10">
                            <h2 class="titulo_secundario">Descricao do imóvel</h2>
                        </div>
                        <div class="col-12">
                            <p class="descricao"><?= nl2br($imovel->descricao) ?> </p>
                        </div>
                    </div>

                    <?php if ($imovel->nomecondominio != '') : ?>
                        <div class="row" style="padding-top: 20px">
                            <div class="col-12">
                                <h2 class="titulo_secundario">Nome do condomínio</h2>
                            </div>
                            <div class="col-12">
                                <p class="descricao"><?= $imovel->nomecondominio ?> </p>
                            </div>
                            <div class="col-12">
                                <a target="_blank" href="<?= $base ?>condominio/<?= $imovel->url_condominio ?>/<?= $imovel->codigocondominio ?>" class="link">
                                    Saber mais sobre o condomínio<img class="icon-link lazyload" data-src="<?= $base ?>assets/icons/icon-arrow-right.svg">
                                </a><br>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row margin-top-20 section_caracteristicas_internas" style="display: none;">

                        <div class="col-12">
                            <h2 class="titulo_secundario">Características internas</h2>
                        </div>

                        <div class="col-12">
                            <ul class="lista-caracteristicas-extras caracteristicas-internas">
                                <li class="caracteristicas-extras <?= ($imovel->arcondicionado) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->arcondicionado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Ar condicionado</li>
                                <li class="caracteristicas-extras <?= ($imovel->armariobanheiro) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->armariobanheiro) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Armário banheiro</li>
                                <li class="caracteristicas-extras <?= ($imovel->box) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->box) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Box banheiro</li>
                                <li class="caracteristicas-extras <?= ($imovel->despensa) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->despensa) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Despensa</li>
                                <li class="caracteristicas-extras <?= ($imovel->vistamar) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->vistamar) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Vista para o mar</li>
                                <li class="caracteristicas-extras <?= ($imovel->areaservico) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->areaservico) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Área serviço</li>
                                <li class="caracteristicas-extras <?= ($imovel->lavabo) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->lavabo) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Lavabo</li>
                                <li class="caracteristicas-extras <?= ($imovel->conexaointernet) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->conexaointernet) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Conexão internet</li>

                                <li class="caracteristicas-extras <?= ($imovel->cabeamentoestruturado) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->cabeamentoestruturado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Cabeamento estruturado</li>
                                <li class="caracteristicas-extras <?= ($imovel->vistamontanha) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->vistamontanha) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Vista para montanha</li>
                                <li class="caracteristicas-extras <?= ($imovel->areaprivativa) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->areaprivativa) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Área privativa</li>
                                <li class="caracteristicas-extras <?= ($imovel->armariocozinha) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->armariocozinha) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Armário cozinha</li>
                                <li class="caracteristicas-extras <?= ($imovel->closet) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->closet) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Closet</li>
                                <li class="caracteristicas-extras <?= ($imovel->armarioquarto) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->armarioquarto) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Armário quarto</li>
                                <li class="caracteristicas-extras <?= ($imovel->solmanha) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->solmanha) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Sol da manhã</li>

                                <li class="caracteristicas-extras <?= ($imovel->escritorio) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->escritorio) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Escritório</li>
                                <li class="caracteristicas-extras <?= ($imovel->rouparia) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->rouparia) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Rouparia</li>
                                <li class="caracteristicas-extras <?= ($imovel->varandagourmet) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->varandagourmet) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Varanda gourmet</li>
                                <li class="caracteristicas-extras <?= ($imovel->tvacabo) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->tvacabo) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> TV a cabo</li>
                                <li class="caracteristicas-extras <?= ($imovel->vistalago) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->vistalago) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Vista para lago</li>
                                <li class="caracteristicas-extras <?= ($imovel->dce) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->dce) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> DCE</li>
                                <li class="caracteristicas-extras <?= ($imovel->lareira) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->lareira) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Lareira</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row margin-bottom-20 section_caracteristicas_externas" style="display: none;">

                        <div class="col-12 margin-bottom-10 margin-top-20">
                            <h2 class="titulo_secundario">Características externas</h2>
                        </div>

                        <div class="col-12">
                            <ul class="lista-caracteristicas-extras caracteristicas-externas">
                                <li class="caracteristicas-extras <?= ($imovel->aguaindividual) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->aguaindividual) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Água individual</li>
                                <li class="caracteristicas-extras <?= ($imovel->aquecedoreletrico) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->aquecedoreletrico) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Aquec. elétrico</li>
                                <li class="caracteristicas-extras <?= ($imovel->aquecedorsolar) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->aquecedorsolar) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Aquec. solar</li>
                                <li class="caracteristicas-extras <?= ($imovel->cercaeletrica) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->cercaeletrica) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Cerca elétrica</li>
                                <li class="caracteristicas-extras <?= ($imovel->gascanalizado) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->gascanalizado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Gás canalizado</li>
                                <li class="caracteristicas-extras <?= ($imovel->jardim) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->jardim) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Jardim</li>
                                <li class="caracteristicas-extras <?= ($imovel->portaoeletronico) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->portaoeletronico) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Portão eletrônico</li>
                                <li class="caracteristicas-extras <?= ($imovel->seguranca24horas) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->seguranca24horas) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Segurança 24 horas</li>

                                <li class="caracteristicas-extras <?= ($imovel->gramado) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->gramado) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Gramado</li>
                                <li class="caracteristicas-extras <?= ($imovel->alarme) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->alarme) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Alarme</li>
                                <li class="caracteristicas-extras <?= ($imovel->aquecedorgas) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->aquecedorgas) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Aquec. gás</li>
                                <li class="caracteristicas-extras <?= ($imovel->boxdespejo) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->boxdespejo) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Box despejo</li>
                                <li class="caracteristicas-extras <?= ($imovel->circuitotv) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->circuitotv) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Circuito TV</li>
                                <li class="caracteristicas-extras <?= ($imovel->interfone) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->interfone) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Interfone</li>

                                <li class="caracteristicas-extras <?= ($imovel->quintal) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->quintal) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Quintal</li>
                                <li class="caracteristicas-extras <?= ($imovel->portaria24horas) ? 'extras-active' : 'extras-none' ?>"><img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($imovel->portaria24horas) ? 'icon-check.svg' : 'icon-x-mini.svg' ?>" /> Portaria 24 horas</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row margin-bottom-20 section_caracteristicas_extras" style="display: none;">

                        <div class="col-12 margin-bottom-10">
                            <h2 class="titulo_secundario">Características extras</h2>
                        </div>

                        <div class="col-12 margin-bottom-20">
                            <ul class="lista-caracteristicas-extras caracteristicas-extras">
                                <?php foreach ($imovel->extras2 as $key => $extras) : ?>
                                    <li class="caracteristicas-extras <?= ($extras->valor) ? 'extras-active' : 'extras-none' ?>">
                                        <img class="lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/<?= ($extras->valor) ? 'icon-check.svg' : 'icon-x-mini.svg' ?> " /> <?= $extras->nome ?>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END COL LEFT -->

                <!-- LADO DIRETIO DA TELA -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 container-direito">
                    <div class="row d-flex  justify-content-end container-direito-nivel-1">
                        <div class="cont-call-to-action">
                            <div class="call-to-action">
                                <div class="espacamento">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="titulo-card">imovel</p>
                                        <p class=""><b id="cod-principal">Cód. imóvel: <?= $imovel->codigo ?></b></p>
                                    </div>
                                </div>
                                <!-- linha divisoria -->
                                <div class="linha-divisoria"></div>

                                <div class="espacamento">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="titulo-card">Valor</p>
                                        <h6 class="preco-imovel"><?= $imovel->valor ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="p-cinza">Condomínio</p>
                                        <h6 class="p-cinza"><?= $imovel->valorcondominio ?></h6>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="p-cinza">IPTU</p>
                                        <h6 class="p-cinza"><?= $imovel->valoriptu ?></h6>
                                    </div>
                                    <?php if ($imovel->codigofinalidade == 1) : ?>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="p-cinza">Total</p>
                                            <h6 class="preco-total"><?php echo $imovel->valormaiscondominiomaisiptu ?></h6>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="linha-divisoria"></div>


                                <!-- CAPTADOR_SITE -->
                                <div class="espacamento">
                                    <?php
                                    foreach ($imovel->captadores as $key => $captador) : ?>

                                        <div class="row d-flex justify-content-start align-items-center">
                                            <div class="col-5">
                                                <img src="<?= ($captador->foto != '' ? $captador->foto  : $base . 'assets/img/logo-mini.png') ?>" class="img-captador" />
                                            </div>
                                            <div class="col-7">
                                                <div class="row container-corretor">
                                                    <div class="col-12">
                                                        <span class=""><?= $captador->nome; ?></span></br>
                                                        <?php if ($captador->creci != "") :
                                                        ?>
                                                            <span class="">CRECI <?= $captador->creci ?></span>
                                                        <?php endif
                                                        ?>
                                                    </div>
                                                    <div class="col-12">
                                                        <a href="tel:<?= preg_replace('/[^0-9]/', '', $captador->telefone) ?>">
                                                            <span class=""><?= $captador->telefone ?></span><br>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>


                                <div class="espacamento">
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-block btn-primario btn-fale-corretor">Tenho interesse</button>
                                            <button class="btn btn-block btn-primario-light agendar-visita">Agendar uma visita</button>


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

                                            <div class="container-share">
                                                <div class="btn-compartilhamento" title="Compartilhar imóvel">
                                                    <span class="material-symbols-outlined">share</span>
                                                    <!-- <span class="open-modal-compartilhamento">Compartilhar imóvel</span> -->
                                                </div>

                                                <a target="_blank" href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', $imovel->configuracoes['tel_celular'])  ?>&text=Olá.">
                                                    <img style="width: 20px;" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-dark.svg" width="34" height="35" alt="WhatsApp" border="0" />
                                                    <span class="span-ddd"> <span class="preco-total"><?= $imovel->configuracoes['tel_celular']  ?></span> </span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                        <div class="call-2">
                            <h2 class="text-center">Quero anunciar meu imóvel</h2>
                            <a href="<?= $base ?>anuncie-seu-imovel" class="btn btn-branco-light">Anunciar Agora</a>
                        </div>
                    </div>

                </div>
                <!-- END LADO DIRETIO DA TELA -->

            </div>
        </div>
    </div>
    <!-- END CONTEUDO PRINCIPAL -->

    <!-- FORM ENCONTRAR IMOVEL -->
    <div id="call-imovel-ideal" class="container-fluid form_section_detalhes_imovel">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                <h2>Encontrar imóvel ideal?</h2>
                <p>Não se preocupe. Deixe seu email e telefone que um especialista irá te ajudar.</p>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                <form name="imovelideal">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label class="label-form">Seu Nome</label>
                            <div class="input-group input-group-lg">
                                <input id="nome-call" type="text" class="form-control form-text" placeholder="Nome" name="nome">

                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label class="label-form">Seu E-mail</label>
                            <div class="input-group input-group-lg">
                                <input id="email-call" type="email" class="form-control form-text" placeholder="E-mail">

                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <label class="label-form">Seu Telefone</label>
                            <div class="input-group input-group-lg">
                                <input id="tel-call" type="text" class="form-control form-text" placeholder="DDD + Telefone">
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="alerta-imovel-ideal">
                                <p class="text-center" style="color:#FFF">Obrigado por entrar em contato!</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <p style="font-size:13px;" class="my-4">Ao informar meus dados, eu concordo com a <a class=" fs-1 text-decoration-underline" style="color: white; text-decoration: underline !important;" href="<?= $base ?>politica-privacidade" target="_blank">Política de Privacidade</a>.
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-flex align-items-end">

                            <button id="btn-call-to-action" type="submit" class="btn btn-lg btn-light btn-primario btn-block">BUSCAR IMOVEIS</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END FORM ENCONTRAR IMOVEL -->


    <!-- CARROSSEL SIMILARES -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="padding-bottom: 20px;">
                <h2 class="text-center">Imóveis Similares</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <div id="carrossel-imoveis-similares">
                    <!-- CARROSSEL DE IMOVEIS -->
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12">
                <div class="d-flex justify-content-center align-item-center">
                    <img class="gif-silimares lazyload" style="width: 50px" loading="lazy" data-src="<?= $base ?>assets/img/gif/ajax-loader.gif" />
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12">
                <div class="d-flex justify-content-center align-items-center" style="padding-top: 50px;">
                    <!--<button id="ver-mais-sililares" class="btn btn-light btn-lg btn-primario-light">ver mais</button>-->
                </div>
            </div>
        </div>
    </div>


    <!-- 
    ==============================================================
    ======= CARROSSEL MODAL GALERIA DE IMAGEM TELA CHEIA =========
    ==============================================================
    -->
    <div class="modal modal-carrossel" tabindex="-1" role="dialog">
        <buttom id="fechar-modal" class="btn btn-secondary">Fechar x </buttom>
        <div id="galeria-full">
            <!--                <div class="card card-modal d-flex align-items-center">
                                    <img class="img-modal" src="https://s3-us-west-2.amazonaws.com/imoview.com.br/sanxxxxx/Imoveis/22473/whatsapp-image-2020-06-10-at-090558.jpeg" alt="Card image cap" />
                                </div>
                -->
        </div>

        <div class="arrow-left-modal">
            <img class="lazyload"  src="<?= $base ?>assets/icons/seta-anterior-galeria.svg" />
        </div>
        <div class="arrow-right-modal">
            <img class="lazyload"  src="<?= $base ?>assets/icons/seta-proximo-galeria.svg" />
        </div>

        <div id="galeria-mini">
            <!--                <div class="card card-img-modal-mini d-flex align-items-center">
                                    <img class="img-model-mini" src="https://s3-us-west-2.amazonaws.com/imoview.com.br/sanxxxxx/Imoveis/22473/whatsapp-image-2020-06-10-at-090558.jpeg" alt="Card image cap" />
                                </div>-->
        </div>
    </div>
    <!--FIM CARROSSEL MODAL-->


    <!--     
    ==============================================================
    =================== MODAL DE AGENDAMENTO DE =================
    ==============================================================
    -->
    <div id="staticBackdrop" class=" modal fade">

        <!--CONTEUDO DO CALENDARIO-->
        <div id="ag-data-modal" class="modal-dialog modal-lg">
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
                            <p class="titulo-agendamento text-center">Escolha a melhor data para agendarmos sua visita</p>
                        </div>
                        <div class="col-12">
                            <p class="load-horarios text-center">Carregando datas...</p>
                        </div>

                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-1">
                            <img class="seta-agenda-left lazyload" loading="lazy" data-src="<?php echo $base ?>assets/icons/icon-seta-left.svg" />
                        </div>
                        <div class="col-8">
                            <div id="carrossel-data-a">
                            </div>
                        </div>
                        <div class="col-1">
                            <img class="seta-agenda-right lazyload" loading="lazy" data-src="<?php echo $base ?>assets/icons/icon-seta-right.svg" />
                        </div>
                    </div>

                    <div class="row corpo-tutulo-agenda">
                        <div class="col-12">
                            <p id="text-horarios" class="titulo-agendamento text-center">agora qual o melhor horário?</p>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="d-flex justify-content-center align-item-center">
                                <img class="lazyload id-gif" style="width: 50px" loading="lazy" data-src="<?= $base ?>assets/img/gif/ajax-loader.gif" />
                            </div>
                        </div>
                        <div class="col-1">
                            <img class="seta-agenda-hora-left lazyload" loading="lazy" data-src="<?php echo $base ?>assets/icons/icon-seta-left.svg" />
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
                            <img class="seta-agenda-hora-right lazyload" loading="lazy" data-src="<?php echo $base ?>assets/icons/icon-seta-right.svg" />
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
                                <button disabled="false" id="btn-ag-data-avancar" type="button" class="btn btn-block btn-primario">Avançar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--FORMULARIO-->
        <div id="ag-horario-modal" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="staticBackdropLabel">Agendar Visita</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="visitaimovel">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 corpo-tutulo-agenda">

                                <p class="titulo-agendamento-form text-center">
                                    <img class="lazyload" data-style="margin-top: -5px;" loading="lazy" data-src="<?= $base ?>assets/icons/icon-calendario.svg" /> <span id="txt-data-agenda">Segunda, 20 de Abril ás 11:00</span>
                                    <input id="form-ag-finalidade" hidden name="finalidade" type="text" class="form-control" value="<?= $imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?>" />
                                    <input id="form-ag-codimovel" hidden name="codimovel" type="text" class="form-control" value="<?= $imovel->codigo ?>" />
                                    <input id="form-ag-data" hidden name="dataagendamento" type="text" class="form-control" value="" />
                                </p>
                            </div>
                            <div class="col-12 corpo-tutulo-agenda">
                                <p class="text-center descricao-ag-form">Agora só faltam os seus dados para receber a confirmação da visita.</p>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center" style="padding:5px">
                            <div class="row">
                                <div class="col-12">
                                    <label class="label-form">SEU nome</label>
                                    <input id="form-ag-nome" name="nome" type="text" class="form-control" placeholder="EX: José da silva" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">SEU E-mail</label>
                                    <input id="form-ag-email" name="email" type="email" class="form-control" placeholder="EX: jose@gmail.com" />
                                </div>

                                <div class="col-12">
                                    <label class="label-form">celular</label>
                                    <input id="form-ag-celular" name="celular" type="text" class="form-control" placeholder="EX:(31) 9 9191-9191" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">Mensagem (Não obrigatrio)</label>
                                    <textarea id="form-ag-msg" name="mensagem" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <p class="msg-retorno-agenda"></p>
                                </div>
                                <div class="col-12">
                                    <p style="font-size:13px;" class="my-4">Ao informar meus dados, eu concordo com a <a class="text-primary fs-1 text-decoration-underline" href="<?= $base ?>politica-privacidade" target="_blank">Política de Privacidade</a>.
                                    </p>
                                </div>

                            </div>
                            <!-- <div class="row">
                                <div class="col-12">
                                    <p class="msg-retorno-agenda"></p>
                                </div>
                            </div> -->

                        </div>
                        <div class="footer-modal" style="background:#FFF">
                            <div class="row d-flex justify-content-center align-items-center" style="background:#FFF">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                    <button id="voltar-agenda" type="button" class="btn btn-block btn-primario-light ">VOLTAR</button>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                    <button id="btn-agendar-visita" type="submit" class="btn btn-block btn-primario">AGENDAR VISITA</button>
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
                                <!--<img style="margin-top: -5px;" class="lazyload" data-src="<?= $base ?>assets/icons/icon-calendario.svg" /> <span id="txt-data-agenda"> Segunda, 20 de Abril ás 11:00</span></p>-->
                        </div>
                        <div class="col-12 corpo-tutulo-agenda">
                            <!--<p class="text-center descricao-ag-form" >Cód. Imovel 212791</p>-->
                            <p class="cod-detalhes-card text-center">Cód. Imóvel <span id="cod-principal-form"><?= $imovel->codigo ?></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-center">Obrigado!</h6>
                            <p class="text-center">Agendamento Feito com sucesso.</p>
                            <p class="text-center">Nosso corretor irá entrar em contato minutos antes para lembrar da visita</p>
                        </div>
                    </div>

                    <div class="footer-modal">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="padding:5px">
                                <button id="fecher-agenda" type="button" class="btn btn-block btn-primario-light ">Fechar</button>
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
                                <input id="form-corretor-finalidade" hidden name="finalidade" type="text" class="form-control" value="<?= $imovel->codigofinalidade == 2 ? 'venda' : 'aluguel' ?>" />
                                <input id="form-corretor-codimovel" hidden name="codimovel" type="text" class="form-control" value="<?= $imovel->codigo ?>" />
                                <div class="col-12">
                                    <p>Código: <span class="cod-id-form"><?= $imovel->codigo ?></span></p>
                                </div>
                                <div class="col-12">
                                    <label class="label-form">SEU nome</label>
                                    <input id="form-corretor-nome" name="nome" type="text" class="form-control" placeholder="EX: José da silva" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">SEU E-mail</label>
                                    <input id="form-corretor-email" name="email" type="email" class="form-control" placeholder="EX: jose@gmail.com" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">celular</label>
                                    <input id="form-corretor-celular" name="telefone" type="text" class="form-control" placeholder="EX:(28) 9 9191-9191" />
                                </div>
                                <div class="col-12">
                                    <label class="label-form">Mensagem (Não obrigatrio)</label>
                                    <textarea id="form-corretor-msg" name="mensagem" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                                    <p style="font-size:13px;" class="my-4">Ao informar meus dados, eu concordo com a <a class="text-primary fs-1 text-decoration-underline" href="<?= $base ?>politica-privacidade" target="_blank">Política de Privacidade</a>.
                                    </p>
                                    <button id="btn-fale-corretor" type="submit" class="btn btn-block btn-primario">Enviar</button>
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
        <img class="fa fa-whatsapp my-float img-whats" src="<?= $base ?>assets/icons/icon-calendario-white.svg">
    </div>


    <div class="modal-compartilhamento">
        <div class="contain">
            <header>
                <span>Compartilhar</span>
                <div class="close-share">
                    <span class="botao_fechar_modal">✖</span>
                </div>
            </header>
            <div class="container-links">
                <a target="_black" href="https://api.whatsapp.com/send?text=<?php echo BASE_URL . $_SERVER["REQUEST_URI"] ?>">
                    <img loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-dark.svg"  width="34" height="35" alt="WhatsApp" border="0" />
                </a>
                <a target="_black" id="facebook-share-btt" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>">
                    <img loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-facebook.svg" />
                </a>
                <a target="_black" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>&title=<?= $imovel->titulo ?>&summary=&source=">
                    <img loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-linkin-dark.svg">
                </a>

            </div>
        </div>
    </div>


    <!-- HIDDENS DA PAGINA -->
    <input type="hidden" id="codigoimovel" value="<?= $imovel->codigo ?>" />

    <?php $render('footer',  $imovel->configuracoes); ?>
    <?php $render('whatsapp',  $imovel->configuracoes); ?>


    <?php if (PAGE_SPEED_100) : ?>

        <!-- IMPORTAÇÃO DO FOOTER -->
        <script src="https://apis.google.com/js/api.js?v=<?= VERSAO ?>" type="text/javascript"></script>
        <script src="https://www.google.com/jsapi"></script>

        <script src="<?= $base ?>assets/lib/jquery.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/bootstrap450/js/bootstrap.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/lazysizes.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/jquery.mask.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/utils.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?= APIGOOLGE ?>"></script>
        <script src="<?= $base ?>assets/js/menu.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/favoritos.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/agenda.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/galeria-vs2.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/fancybox/jquery.fancybox.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/fotos360.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/form-call-to-action.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/detalhe-imovel/index.js?v=<?= VERSAO ?>"></script>

    <?php endif ?>
</body>
</html>