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

<body class="body-detyalhe-condominio">
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>
    <?php $render('header/menu-modal', $configuracoes); // ?>
    <?php $render('header/top-header', $configuracoes)  //carrega o header contato ?>
    <?php $render('header/header', $configuracoes); //carrega o header ?>

    <div class="container-banner" style="background-image: url(<?= $imovel->urlfotoprincipal ?>);">
        <div class="filtro-sobre-imagem">
            <h1><?= $imovel->nomecondominio ?></h1>
            <h2><?= $imovel->endereco . ', ' . $imovel->bairro . ', ' . $imovel->cidade . ' - ' . $imovel->estado ?>
            </h2>
        </div>
    </div>

    <!-- CONTEUDO PRINCIPAL -->
    <div class="container">
        <div class="row margin-top-20">

            <!-- COL LEFT -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="container-buttons-action  margin-bottom-20">
                            <button id="btn-descricao" data-link-id="#descricao" class="btn-acao-rolagem btn btn-ligth">
                                <span class="material-symbols-outlined">description</span>
                                <span>Descrição geral</span>
                            </button>
                            <button data-link-id="#container-imagems" class="btn-acao-rolagem btn btn-ligth">
                                <span class="material-symbols-outlined">image</span>
                                <span>Imagens</span>
                            </button>
                            <button data-link-id="#container-imoveis" class="btn-acao-rolagem btn btn-ligth">
                                <span class="material-symbols-outlined">real_estate_agent</span>
                                <span>Imóveis</span>
                            </button>
                            <button data-link-id="#container-diferenciais" class="btn-acao-rolagem btn btn-ligth">
                                <span class="material-symbols-outlined">star</span>
                                <span>Diferenciais</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="container-info-icons">
                            <div class="card-info-empreendimento <?= $imovel->areaprincipal == "0,00" ? "hide" : "" ?>">
                                <img src="<?= $base ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-area.svg"
                                    alt="Área" />
                                <span><?= $imovel->areaprincipal ?> m²</span>
                                <span>Área Principal</span>
                            </div>

                            <div class="card-info-empreendimento <?= $imovel->arealote == "0,00" ? "hide" : "" ?>">
                                <img src="<?= $base ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-cerca.svg"
                                    alt="Área" />
                                <span><?= $imovel->arealote ?> m²</span>
                                <span>Área Lote</span>
                            </div>

                            <div class="card-info-empreendimento <?= $imovel->numeroquartos == "0,00" ? "hide" : "" ?>">
                                <img src="<?= $base ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-bed.svg"
                                    alt="Área" />
                                <span><?= $imovel->numeroquartos ?></span>
                                <span>Quartos</span>
                            </div>

                            <div class="card-info-empreendimento <?= $imovel->numerobanhos == "0,00" ? "hide" : "" ?>">
                                <img src="<?= $base ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-shower.svg"
                                    alt="Área" />
                                <span><?= $imovel->numerobanhos ?></span>
                                <span>Banheiro</span>
                            </div>

                            <div class="card-info-empreendimento <?= $imovel->numerovagas == "0,00" ? "hide" : "" ?>">
                                <img src="<?= $base ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-garage.svg"
                                    alt="Área" />
                                <span><?= $imovel->numerovagas ?></span>
                                <span>Vagas</span>
                            </div>

                            <div class="card-info-empreendimento <?= $imovel->numerosuites == "0,00" ? "hide" : "" ?>">
                                <img src="<?= $base ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/icon-suites.svg"
                                    alt="Área" />
                                <span><?= $imovel->numerosuites ?></span>
                                <span>Suite</span>
                            </div>


                        </div>
                    </div>
                </div>

                <div id="descricao" class="row margin-top-20 <?= $imovel->descricao == "" ? "hide" : "" ?>">
                    <div class="col-12 margin-bottom-10">
                        <h3 class="titulo_secundario">Descrição do imóvel</h3>
                    </div>
                    <div class="col-12">
                        <p class="descricao"><?= nl2br($imovel->descricao) ?> </p>
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
                            <li class="caracteristicas-extras <?= ($imovel->box) ? 'extras-active' : 'extras-none' ?>">
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
                            <li class="caracteristicas-extras <?= ($imovel->dce) ? 'extras-active' : 'extras-none' ?>">
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

                <section id="container-imagems">
                    <div class="row">
                        <div class="col-12">
                            <h3>Galeria de imagens</h3>
                        </div>
                        <div class="col-12">
                            <div id="galeria-imagens">
                                <?php foreach ($imovel->fotos as $key => $foto): ?>
                                    <img class="img-galeria" data-fancybox="gallery" data-src="<?= $foto->url ?>"
                                        src="<?= $foto->url ?>" />
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="container-actions">
                            <div class="btn-arrow arrow-left-imovel">
                                <span class="material-symbols-outlined">arrow_back_ios_new</span>
                            </div>
                            <div class="btn-arrow  arrow-right-imovel">
                                <span class="material-symbols-outlined">arrow_forward_ios</span>
                            </div>
                        </div>
                    </div>
                </section>


                <div class="row" id="container-imoveis">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <!-- <div class="container-link-busca"> -->
                        <?php if ((count($imovel->unidadesvenda->disponiveis) > 0)): ?>
                            <a
                                href="<?= $base ?>venda/imovel/regiao-do-barreiro/todos-os-bairros/<?= $imovel->url_amigavel ?>/?&pagina=1">
                                <button class="btn-ver-imoveis">
                                    <img src="<?= BASE_URL ?>assets/icons/icons-tema-clean/search-cor-principal.svg" alt="">
                                    <span>Ver imóveis à Venda</span>
                                </button>
                            </a>
                        <?php endif ?>

                        <!-- </div> -->
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <?php if (count($imovel->unidadesaluguel->disponiveis) > 0): ?>
                            <a
                                href="<?= $base ?>aluguel/imovel/regiao-do-barreiro/todos-os-bairros/<?= $imovel->url_amigavel ?>/?&pagina=1">
                                <button class="btn-ver-imoveis">
                                    <img src="<?= BASE_URL ?>assets/icons/icons-tema-clean/search-cor-principal.svg" alt="">
                                    <span>Ver imóveis para Locação</span>
                                </button>
                            </a>
                        <?php endif ?>
                    </div>
                </div>

                <div id="container-diferenciais" class="row margin-bottom-20 section_caracteristicas_externas">
                    <div class="col-12 margin-bottom-30 margin-top-30">
                        <h3 class="titulo_secundario">Características</h3>
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


                <div class="row margin-bottom-20 section_caracteristicas_extras" style="">
                    <!-- <div class="col-12 margin-bottom-30">
                        <h3 class="titulo_secundario">Mais Opções</h3>
                    </div> -->
                    <div class="col-12 margin-bottom-20">
                        <div class="container-precos">
                            <h3 class="mb-3">Outras caracteristicas</h3>
                            <div class="line-info-card">
                                <span>Número de elevadores</span>
                                <strong><?= $imovel->numeroelevador ?></strong>
                            </div>
                            <div class="line-info-card">
                                <span>Número de torres</span>
                                <strong><?= $imovel->numerotorres ?></strong>
                            </div>
                            <div class="line-info-card"><span>Numero de andares</span>
                                <strong><?= $imovel->numeroandares ?></strong>
                            </div>
                            <div class="line-info-card"><span>Unidades por andar</span>
                                <strong><?= $imovel->unidadesporandar ?></strong>
                            </div>
                            <div class="line-info-card"><span>Total de unidade</span>
                                <strong><?= $imovel->totalunidades ?></strong>
                            </div>
                            <div class="line-info-card"><span>Vagas pra visitantes</span>
                                <strong><?= $imovel->numerovagavisitante ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END COL LEFT -->



            <!-- LADO DIRETIO DA TELA -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="container-mediana">
                    <div class="row">
                        <div class="col-12">
                            <strong>Preço médio dos imóveis</strong>
                        </div>
                    </div>
                    <hr />
                    <div class="row destaque-card">
                        <?php if ($imovel->valorvenda != 'R$ 0,00 até R$ 0,00'): ?>
                            <div class="col-12">
                                <div class="container-precos mb-5">
                                    <p>Mediana do preço de apartamentos anunciados para venda</p>
                                    <div class="line-info-card"><span>Valor</span>
                                        <strong
                                            class="valor-mediana"><?= ($imovel->valorvenda != 'R$ 0,00 até R$ 0,00' ? $imovel->valorvenda : 'Não informado') ?></strong>
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
                                    <p>Mediana do preço de apartamentos anunciados para aluguel</p>
                                    <div class="line-info-card"><span>Valor</span>
                                        <strong
                                            class="valor-mediana"><?= $imovel->valoraluguel != 'R$ 0,00 até R$ 0,00' ? $imovel->valoraluguel : 'Não Informado' ?></strong>
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
                            <div class="col-12">
                                <p>Tipos e quantidade de Imóveis para venda</p>
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
                            <div class="col-12">
                                <p class="">Tipos e quantidade de Imóveis para aluguel</p>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($imovel->unidadesaluguel->disponiveis as $imo): ?>
                                <div class="col-12 col-sm-12">
                                    <div class="line-info-card">
                                        <strong><?= $imo->tipo ?></strong>
                                        <span><?= $imo->quantidade ?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <!-- END LADO DIRETIO DA TELA -->
        </div>
    </div>
    <!-- END CONTEUDO PRINCIPAL -->



    <!-- HIDDENS DA PAGINA -->
    <input type="hidden" id="codigoimovel" value="<?= $imovel->codigo ?>" />

    <?php $render('footer/footer', $configuracoes) //html do footer ?>

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


    <script>
        //foca no botão
        $('#btn-descricao').focus();
    </script>
</body>

</html>