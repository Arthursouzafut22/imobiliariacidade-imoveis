<!doctype html>
<html lang="pt-br">

<head>

    <?php if (PAGE_SPEED_100) : ?>
    <?php $render('scripts-header', $script) ?>
    <?php endif ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>" />
    <meta name="robots" content="index" />

    <!-- CONFIGURAÇÕES DE COMPARTILHAMENTO DE LINK -->
    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:url" content="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>" />
    <meta property="og:image" content="<?= $base ?>assets/images/logo-link.png?v=<?=VERSAO?>" />
    <meta property="og:image:width" content="135" />
    <meta property="og:image:height" content="135" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>" />
    <meta property="twitter:title" content="<?= $title ?>" />
    <meta property="twitter:description" content="<?= $description ?>" />
    <meta property="twitter:image" content="<?= $base ?>assets/images/logo-link.png?v=<?=VERSAO?>" />

    <?php echo (isset($canonical) ? $canonical : '') ?>

    <?php if (PAGE_SPEED_100) : ?>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?= $base ?>assets/img/favico.ico" type="image/x-icon?v=1.0">

    <!-- IMPORTAÇAO DO CARROSSEL -->
    <link rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?=VERSAO?>" />
    <link rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?=VERSAO?>" />

    <!--IMPORT BOOSTRAP-->
    <link rel="stylesheet" href="<?= $base ?>assets/lib/bootstrap450/css/bootstrap.min.css?v=<?=VERSAO?>" />

    <script src="https://raw.githubusercontent.com/k4fer74/pluralize-ptbr/master/pluralize-ptbr.browser.js?v=<?=VERSAO?>"></script>

    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css?v=<?=VERSAO?>" />
    <link rel="stylesheet" href="<?= $base ?>assets/css/busca/busca.css?v=<?=VERSAO?>" />

    <?php $render('scripts-pos-header', $script); ?>

    <?php endif ?>

</head>

<body>

    <?php if (PAGE_SPEED_100) : ?>
    <?php $render('scripts-body-inicial', $script); ?>
    <?php endif ?>

    <!-- IMPORTAÇÃO DO HEADER -->
    <?php $render('menu-modal', $configuracoes);?>
    <?php $render('header', $configuracoes);?>

    <!--FILTRO LATERAL--
    <div id="container-header-desktop">
        <div class="container-fluid">
            <div class="row  margin-top-20">
                
                </!--
                <button id="abrir-filtro" class="btn btn-primario">
                    <span>Mais Filtros</span><span class="material-symbols-outlined">add</span>
                </button>

                <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 d-flex justify-content-end">
                    <div id="button_check_mapa" style="<?= MAPA_LISTAGEM_IMOVEL == 0 ? 'display: none;' : '' ?>">
                        <span>Exibir mapa</span> <span class="material-symbols-outlined">map</span>
                    </div>
                </div>
                --/>

            </div>
            <div id="container-parametros">
                <div>
                </div>
            </div>
        </div>
    </div>
    </!--FIM FILTRO LATERAL-->


    <!-- WRAP CONTAINER LISTAGEM DE IMOVEIS -->
    <div id="wrap_container_lista_imoveis">

        <!-- CONTAINER LEFT LISTAGEM -->
        <div id="container_lista_imoveis_left">
            <div class="modal-form">
                <div>
                    <div id="corpo-filtro">
                        <div class="row justify-content-end align-item-end">
                            <div clas="col-4">
                                <div class="buttom-x-menu">
                                    <span class="botao_fechar_modal">✖</s>
                                </div>
                            </div>
                        </div>

                        <div class="row row-container">
                            <div class="col-12 col-sm-12 col-md-12 ">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="buttom_finalidade_busca_home  btn-venda ">
                                        <div class="d-flex justify-content-center">
                                            <span class="finalidade-busca">Comprar</span>
                                        </div>
                                    </div>
                                    <div class="buttom_finalidade_busca_home  btn-aluguel">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="finalidade-busca">Alugar</span>
                                        </div>
                                    </div>
                                    <div class="buttom_finalidade_busca_home btn-lancamento">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span class="finalidade-busca">Novos</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        /*
                        <div class="row row-container" hidden>
                            <div class="col-12">
                                <h6 class="">Opções de Lançamentos</h6>
                            </div>
                            <div id="container-cond" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="input-group-lg">
                                    <select class="custom-select mr-sm-2 form-select" id="opcaoimovel">
                                        <option url="todas-as-opcoes" value="0">Todas as opções</option>
                                        <option url="apenas-imoveis-avulso" value="0">Apenas imóveis avulso</option>
                                        <option url="apenas-lancamentos" value="2">Apenas lançamentos</option>
                                        <!-- <option url="apenas-unidades-de-lancamentos" value="3">Apenas unidades de lançamentos</option> -->
                                        <!-- <option url="apenas-avulsos-e-lancamentos-mae" value="4">Apenas avulsos e lançamentos mãe</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        */
                        ?>

                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">Cidades</h6>
                            </div>
                            <div id="container-cond" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <!--<label class="label-form">Condomínios</label>-->
                                <div class="input-group-lg">
                                    <select class="custom-select mr-sm-2 form-select" id="cidade">
                                        <option url="todas-as-opcoes" value="0">Todas as opções</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">Bairros</h6>
                            </div>
                            <div id="container-cond" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <!--<label class="label-form">Condomínios</label>-->
                                <div class="input-group-lg" style="position:relative;">
                                    <div class="custom-select mr-sm-2 form-select btn-toggle">
                                        <span><b class="cont-bairro">0</b> Selecionados</option>
                                    </div>
                                    <div class="lista-bairros">
                                        <ul>
                                            <!-- CONTEÚDO INSERDO NO JAVASCRIPT -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 
                        <div class="row row-container">
                            <div id="container-iput-top" class="input-group">
                                <input id="endereco" type="text" class="form-control form-text"
                                    placeholder="Digite aqui a Rua, Bairro, Cidade">
                                <img class="icon-lupa lazyload" src="<?= $base ?>assets/icons/icon-lupa.svg">
                                <ul id="lista-endereco" class="list-group">

                                </ul>
                            </div>
                        </div> -->

                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">TIPO de IMÒVEL</h6>
                            </div>
                            <div class="col-12">
                                <div id="container-btn" class="d-flex flex-wrap">
                                    <!--                                <span class="card-tipo-filter text-center justify-content-between align-items-center">Apartamento</span>
                                <span class="card-tipo-filter text-center justify-content-between align-items-center">Casa</span>
                                <span class="card-tipo-filter text-center justify-content-between align-items-center">Cobertura</span>
                                <span class="card-tipo-filter text-center justify-content-between align-items-center">Sítio</span>
                                <span class="card-tipo-filter text-center justify-content-between align-items-center">Chacara</span>
                                <span class="card-tipo-filter text-center justify-content-between align-items-center">Lote</span>
                                <span class="card-tipo-filter text-center justify-content-between align-items-center">Apartamento</span>-->
                                </div>
                                <div id="container-btn-hide">
                                    <div id="sub-btn-hide" class="d-flex flex-wrap">

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                    <p id="btn-tipo-toggle" class="text-cinza">Ver mais tipos <img class="icon-arrow-down lazyload" style="width:35px" data-src="<?= $base ?>assets/icons/icon-arrow-down.svg" /></p>
                </div> -->
                        </div>

                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">Condomínios</h6>
                            </div>
                            <div id="container-cond" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <!--<label class="label-form">Condomínios</label>-->
                                <div class="input-group-lg">
                                    <select class="custom-select mr-sm-2 form-select" id="condominio">
                                        <option>Condomínio 1</option>
                                        <option>Condomínio 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="row row-container fild-hide">
                            <div class="col-12">
                                <h6 class="">QUARTOS</h6>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-start align-items-center active-lancamentos">
                                    <!--quar-active-->
                                    <button id="btn-q-1" type="button"
                                        class="btn btn-light btn-circle btn-quartos">1</button>
                                    <button id="btn-q-2" type="button"
                                        class="btn btn-light btn-circle btn-quartos">2</button>
                                    <button id="btn-q-3" type="button"
                                        class="btn btn-light btn-circle btn-quartos">3</button>
                                    <button id="btn-q-4" type="button"
                                        class="btn btn-light btn-circle btn-quartos">4+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row row-container fild-hide">
                            <div class="col-12">
                                <h6 class="">banheiros</h6>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-start align-items-center active-lancamentos ">
                                    <!--ban-active-->
                                    <button id="btn-b-1" type="button"
                                        class="btn btn-light btn-circle btn-banheiro">1</button>
                                    <button id="btn-b-2" type="button"
                                        class="btn btn-light btn-circle btn-banheiro">2</button>
                                    <button id="btn-b-3" type="button"
                                        class="btn btn-light btn-circle btn-banheiro">3</button>
                                    <button id="btn-b-4" type="button"
                                        class="btn btn-light btn-circle btn-banheiro">4+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row row-container fild-hide">
                            <div class="col-12">
                                <h6 class="">VAGAS</h6>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-start align-items-center active-lancamentos">
                                    <!--vagas-active-->
                                    <button id="btn-vaga-1" type="button"
                                        class="btn btn-light btn-circle btn-vagas">1</button>
                                    <button id="btn-vaga-2" type="button"
                                        class="btn btn-light btn-circle btn-vagas">2</button>
                                    <button id="btn-vaga-3" type="button"
                                        class="btn btn-light btn-circle btn-vagas">3</button>
                                    <button id="btn-vaga-4" type="button"
                                        class="btn btn-light btn-circle btn-vagas">4+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row row-container fild-hide">
                            <div class="col-12">
                                <h6 class="">SUITES</h6>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-start align-items-center active-lancamentos">
                                    <!--suite-active;-->
                                    <button id="btn-s-1" type="button"
                                        class="btn btn-light btn-circle btn-suite ">1</button>
                                    <button id="btn-s-2" type="button"
                                        class="btn btn-light btn-circle btn-suite">2</button>
                                    <button id="btn-s-3" type="button"
                                        class="btn btn-light btn-circle btn-suite">3</button>
                                    <button id="btn-s-4" type="button"
                                        class="btn btn-light btn-circle btn-suite">4+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row row-container fild-hide">
                            <div class="col-12">
                                <h6 class="">VALOR</h6>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-around align-items-center">
                                    <span style="display: none" id="slider-margin-value-min">R$ 35.000</span>
                                    <input id="input_valor_min" class="form-control form-text" type="text"
                                        value="0,00" placeholder="0,00">
                                    <span> - </span>
                                    <input id="input_valor_max" class="form-control form-text" type="text"
                                        value="0,00" placeholder="0,00">
                                    <span style="display: none" id="slider-margin-value-max">R$ 90.000</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="slider-valor"></div>
                            </div>
                        </div>

                        <div class="row row-container fild-hide">
                            <div class="col-12">
                                <h6 class="">ÁREA</h6>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-around align-items-center">
                                    <span style="display: none" id="slider-area-value-min">R$ 35.000</span>
                                    <input id="input_area_min" class="form-control form-text" type="text"
                                        value="0,00" placeholder="0,00">
                                    <span> - </span>
                                    <span style="display: none" id="slider-area-value-max">R$ 90.000</span>
                                    <input id="input_area_max" class="form-control form-text" type="text"
                                        value="0,00" placeholder="0,00">
                                </div>
                            </div>

                            <div class="col-12">
                                <div id="slider-area"></div>
                            </div>
                        </div>

                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">CÓDIGO DO IMÓVEL</h6>
                            </div>
                            <div class="container-codigo">
                                <input id="input_codigo" placeholder="Digite o código do imóvel" type="text"
                                    class="form-control form-text" /> <span
                                    class="material-symbols-outlined">search</span>
                            </div>
                            <!-- <div class="container-result-codigo">
                            </div> -->
                        </div>


                        <!-- FILTRO CHECKBOX IMOVEL -->
                        <div class="row row-container">
                            <div class="col-12 margin-top-10">
                                <h6 class="">IMOVEL</h6>
                            </div>
                            <div id="container-caracteristicas" class="col-12">
                                <div id="aceita-permuta" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Aceita Permuta
                                </div>

                                <div id="area-privativa" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Area Privativa
                                </div>
                                <div id="churrasqueira" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Churrasqueira
                                </div>
                                <div id="closet" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Closet
                                </div>
                                <div id="dce" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> DCE
                                </div>
                                <div id="exclusivo" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Exclusivo
                                </div>
                                <div id="lavabo" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Lavabo
                                </div>
                                <div id="mobiliado" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Mobiliado
                                </div>
                                <div id="na-planta" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Na planta
                                </div>
                                <div id="alugado" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Alugado
                                </div>
                            </div>
                        </div>
                        <!-- END FILTRO CHECKBOX IMOVEL -->
                        

                        <!-- FILTRO CHECKBOX EDIFICIO -->
                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">EDIFÍCIO</h6>
                            </div>
                            <div class="col-12">

                                <div id="academia" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Academia
                                </div>
                                <div id="playground" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Playground
                                </div>

                                <div id="portaria-24-horas" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Portaria 24 horas
                                </div>
                                <div id="quadra-esportiva" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Quadra Esportiva
                                </div>
                                <div id="salao-jogos" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Salão de Jogos
                                </div>

                                <div id="sauna" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Sauna
                                </div>
                                <div id="portao-eletronico" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload"
                                            data-src="<?= $base ?>assets/icons/icon-check-white.svg" />
                                    </div> Portão Eletrônico
                                </div>
                            </div>
                        </div>
                        <!-- END FILTRO CHECKBOX EDIFICIO -->
                        

                        <!-- CARACTERISTICAS EXTRAS -->
                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">CARACTERISTICAS EXTRAS</h6>
                            </div>
                            <div id="container-caracterisicas-extas" class="col-12"></div>
                        </div>
                        <!-- END CARACTERISTICAS EXTRAS -->
                        

                        <div class="row row-container">
                            <div class="col-12">
                                <button class="btn btn-primario btn-buscar">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTAINER LEFT LISTAGEM -->

        <!-- CONTAINER RIGHT LISTAGEM -->
        <div id="container_lista_imoveis_right">

            <div class="menu_header_listagem_imoveis">                
                <div class="row ml-0 mr-0 margin-bottom-20">

                    <!-- titulo da pagina -->
                    <div class="col-9 col-sm-8 col-md-9 col-lg-9 col-xl-9">
                        <h1 class="texto-topo-busca"> <?= $tituloPagina ?></h1>
                    </div>
                    <!-- end titulo da pagina -->

                    
                    <div id="container-cond" class="col-3 col-sm-4 col-md-4 col-lg-6 col-xl-6">

                        <!-- Botao do mapa -->
                        <button id="abrir-filtro" class="btn btn-primario">
                            <span>Mais Filtros</span>
                        </button>

                        <div id="button_check_mapa" style="<?= MAPA_LISTAGEM_IMOVEL == 0 ? 'display: none;' : '' ?>">
                            <span>Exibir mapa</span> <span class="material-symbols-outlined">map</span>
                        </div>
                        <!-- End Botao do mapa -->

                        <!-- Select de ordenacao -->
                        <div class="input-group-lg input_group_ordenacao">
                            <select class="custom-select mr-sm-2 form-select" id="ordenacao">
                                <option>Mais Relevantes</option>
                                <option value="asc">Menor Preço</option>
                                <option value="desc">Maior Preço</option>
                            </select>
                        </div>
                        <!-- End select de ordenacao -->
                        
                    </div>

                </div>
            </div>
            
            <div id="container_resultado_listagem_imoveis" class="row"></div>
            
            <div id="container_geral_paginacao">
                <div id="primeiraPagina" class="btn-paginacao">
                    <span class="material-symbols-outlined">
                        arrow_back_ios_new
                    </span>
                </div>
                
                <div class="container-paginacao"></div>
                <div id="btn-end">
                </div>
            </div>

        </div>
        <!-- END CONTAINER RIGHT LISTAGEM -->

        <!--RESULTADO DA BUSCA  POR MAPA-->
        <div id="container_lista_imoveis_right_mapa" style="display:none;">
            <div id="display_busca_mapa" class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                        <div id="result-busca-map" class="row"></div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            
        </div>
        <!--END RESULTADO DA BUSCA  POR MAPA-->
        
    </div>
    <!-- END WRAP CONTAINER LISTAGEM DE IMOVEIS -->

    
    <!--
    <div id="display_busca" class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">

                

            </div>
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">

                
            </div>
        </div>
    </div>
    -->


    

    <!-- </div> -->

    <!--BOTOES DE FLUTUANTES DO MOBILE-->
    <!-- <div id="btn-mapa-mobile" class="">
        <img class="icon-filter" src="<?= $base ?>assets/icons/icon-marker-cinza.svg">
        <span>Ver Mapa</span>
    </div> -->


    <div class="modal-loader">
        <img src="<?= $base ?>assets/img/gif/loading-buffering.gif" />
    </div>


    <!-- mensagem para cliente -->
    <span class="alert-busca">Você pode buscar por mais de um bairro, digite outro bairro e confira!</span>

    <!-- <select id="ordenacao-mobile" class="custom-select form-select">
        <option value="venda">Ordenar Por</option>
        <option value="codigoasc">Código</option>
        <option value="valorasc">Menor Valor</option>
        <option value="valordesc">Maior Valor </option>
    </select> -->
    <!-- IMPORTAÇÃO DO FOOTER -->

    <?php $render('alerts', $script) ?>

    <?php if (PAGE_SPEED_100) : ?>

    <script src="<?= $base ?>assets/lib/jquery.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/lib/bootstrap450/js/bootstrap.min.js?v=<?= VERSAO ?>"></script>
    <script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js?v=<?= VERSAO ?>">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= APIGOOLGE ?>"></script>
    <script src="<?= $base ?>assets/lib/lazysizes.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/lib/jquery.mask.min.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/lib/nouislider.min.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/utils.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/menu.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/busca/favoritos.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/busca/funcoesAuxiliaresBusca.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/busca/mapa.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/busca/busca.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/busca/index.js?v=<?= VERSAO ?>"></script>

    <?php $render('scripts-footer', $script) ?>

    <?php endif ?>

</body>

</html>