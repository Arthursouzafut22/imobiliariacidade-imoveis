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


        <link rel="stylesheet" href="<?= $base ?>assets/lib/chosen/chosen.css?v=<?= VERSAO ?>">
        
        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/busca/busca.css?v=<?= VERSAO ?>" />

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
                                    <span class="botao_fechar_modal">✖</span>
                                </div>
                            </div>
                        </div>

                        <div class="row row-container">
                            <div class="col-12 col-sm-12 col-md-12 ">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="buttom_finalidade_busca_home  btn-venda ">
                                        <div class="d-flex justify-content-center">
                                            <span data-campofinalidade="comprar" class="finalidade-busca">Comprar</span>
                                        </div>
                                    </div>
                                    <div class="buttom_finalidade_busca_home  btn-aluguel">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span data-campofinalidade="alugar" class="finalidade-busca">Alugar</span>
                                        </div>
                                    </div>
                                    <div class="buttom_finalidade_busca_home btn-lancamento">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span data-campofinalidade="lancamentos"
                                                class="finalidade-busca">Lançamentos</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">Cidades</h6>
                            </div>
                            <div id="container-cond" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <!--<label class="label-form">Condomínios</label>-->
                                <div class="input-group-lg">
                                    <select aria-label="Cidade" class="custom-select mr-sm-2 form-select" id="cidade">
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
                                    <select aria-label="Condomínio" class="custom-select mr-sm-2 form-select chosen"
                                        id="condominio">
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
                                        class="btn btn-light btn-circle botao_tipo_busca btn-quartos">1</button>
                                    <button id="btn-q-2" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-quartos">2</button>
                                    <button id="btn-q-3" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-quartos">3</button>
                                    <button id="btn-q-4" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-quartos">4+</button>
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
                                        class="btn btn-light btn-circle botao_tipo_busca btn-banheiro">1</button>
                                    <button id="btn-b-2" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-banheiro">2</button>
                                    <button id="btn-b-3" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-banheiro">3</button>
                                    <button id="btn-b-4" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-banheiro">4+</button>
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
                                        class="btn btn-light btn-circle botao_tipo_busca btn-vagas">1</button>
                                    <button id="btn-vaga-2" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-vagas">2</button>
                                    <button id="btn-vaga-3" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-vagas">3</button>
                                    <button id="btn-vaga-4" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-vagas">4+</button>
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
                                        class="btn btn-light btn-circle botao_tipo_busca btn-suite ">1</button>
                                    <button id="btn-s-2" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-suite">2</button>
                                    <button id="btn-s-3" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-suite">3</button>
                                    <button id="btn-s-4" type="button"
                                        class="btn btn-light btn-circle botao_tipo_busca btn-suite">4+</button>
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
                                    <input id="input_valor_min" class="form-control form-text" type="text" value="0,00"
                                        placeholder="0,00">
                                    <span> - </span>
                                    <input id="input_valor_max" class="form-control form-text" type="text" value="0,00"
                                        placeholder="0,00">
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
                                    <input id="input_area_min" class="form-control form-text" type="text" value="0,00"
                                        placeholder="0,00">
                                    <span> - </span>
                                    <span style="display: none" id="slider-area-value-max">R$ 90.000</span>
                                    <input id="input_area_max" class="form-control form-text" type="text" value="0,00"
                                        placeholder="0,00">
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
                                    class="form-control form-text" />
                                <img src="<?= $base ?>assets/icons/lupa-arredondada.svg" alt="">

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
                                <div id="aceita-financiamento" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Aceita Financiamento
                                </div>
                                <div id="aceita-permuta" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Aceita Permuta
                                </div>
                                <div id="area-privativa" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Area Privativa
                                </div>
                                <div id="area-servico" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Área serviço
                                </div>

                                <div id="box" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Box banheiro
                                </div>
                                <div id="closet" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Closet
                                </div>

                                <div id="dce" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> DCE
                                </div>
                                <div id="lavabo" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Lavabo
                                </div>
                                <div id="mobiliado" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Mobiliado
                                </div>

                                <!-- VARANDA ESTÁ PENDENTE -->


                                <div id="varanda-gourmet" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Varanda gourmet 
                                </div>

                                <div id="alarme" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Alarme 
                                </div>

                                <div id="box-despejo" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Box Despejo  
                                </div>

                                <div id="circuito-tv" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Circuito TV  
                                </div>

                                <div id="interfone" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Interfone  
                                </div>

                                <div id="jardim" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Jardim   
                                </div>

                                <div id="portao-eletronico" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Portão Eletrônico
                                </div>

                                <div id="portaria-24-horas" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Portaria 24 horas
                                </div>

                                <div id="exclusivo" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Exclusivo
                                </div>

                                <div id="na-planta" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Na planta
                                </div>
                                <div id="alugado" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Alugado
                                </div>
                            </div>
                        </div>
                        <!-- END FILTRO CHECKBOX IMOVEL -->


                        <!-- FILTRO CHECKBOX EDIFICIO -->
                        <div class="row row-container">
                            <div class="col-12">
                                <h6 class="">LAZER</h6>
                            </div>
                            <div class="col-12">

                                <div id="academia" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Academia
                                </div>
                                <div id="churrasqueira" class="corpo-check d-flex">
                                    <div class="imovel-check  d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Churrasqueira
                                </div>

                                <div id="piscina" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Piscina
                                </div>

                                <div id="playground" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Playground
                                </div>

                                <div id="quadra-esportiva" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Quadra Esportiva
                                </div>
                                <div id="quadra-tenis" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Quadra tênis
                                </div>
                                <div id="salao-festas" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Salão de festas
                                </div>

                                <div id="salao-jogos" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Salão de Jogos
                                </div>

                                <div id="sauna" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Sauna
                                </div>

                                <div id="hidromassagem" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Hidromassagem  
                                </div>
                                <div id="wifi" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Wifi 
                                </div>
                                <div id="home-cinema" class="corpo-check d-flex">
                                    <div class="imovel-check d-flex justify-content-center align-items-center">
                                        <img class="lazyload" data-src="<?= $base ?>assets/icons/icon-check-white.svg"
                                            alt="Icon Check" />
                                    </div> Home cinema
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

            <!-- CABECALHO DA BUSCA -->
            <div class="wrap_cabecalho_busca">
                <div class="row d-flex justify-content-between ml-0 mr-0 margin-bottom-20">
                    <!-- titulo da pagina -->
                    <div class="col-12 col-sm-8 col-md-8 col-lg-6 col-xl-8">
                        <h1 class="texto-topo-busca"> <?= $tituloPagina ?></h1>
                    </div>
                    <!-- end titulo da pagina -->

                    <div class="col-12 col-sm-4 col-md-4 col-lg-6 col-xl-4" id="container-cond">

                        <!-- Botao do mapa -->
                        <button id="abrir-filtro" class="btn btn-primario">
                            <span>Mais Filtros</span>
                        </button>

                        <div id="button_check_mapa" style="<?= MAPA_LISTAGEM_IMOVEL == 0 ? 'display: none;' : '' ?>">
                            <span>Exibir mapa</span>
                        </div>
                        <!-- End Botao do mapa -->

                        <!-- Select de ordenacao -->
                        <div class="input-group-lg input_group_ordenacao">
                            <select aria-label="Ordenação" class="custom-select mr-sm-2 form-select" id="ordenacao">
                                <option value="">Mais Relevantes</option>
                                <option <?= $ordenacao == 'asc' ? 'selected' : '' ?> value="asc">Menor Preço</option>
                                <option <?= $ordenacao == 'desc' ? 'selected' : '' ?> value="desc">Maior Preço</option>
                            </select>
                        </div>
                        <!-- End select de ordenacao -->

                    </div>
                </div>
            </div>
            <!-- END CABECALHO DA BUSCA -->

            <!-- RESULTADO LISTAGEM IMOVEIS -->
            <div id="wrap_listagem_imoveis">
                <div id="container_resultado_listagem_imoveis" clas="row"></div>
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
            <!-- END RESULTADO LISTAGEM IMOVEIS -->

            <!--RESULTADO DA BUSCA  POR MAPA-->
            <div id="container_lista_imoveis_right_mapa" style="display:none;">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div id="map"></div>
                </div>
            </div>
            <!--END RESULTADO DA BUSCA  POR MAPA-->

        </div>
    </div>
    <!-- END WRAP CONTAINER LISTAGEM DE IMOVEIS -->


    <!-- 
    
    <!/-- END CONTAINER RIGHT LISTAGEM -->


    <div class="modal-cards-mapa">
        <button class="close-modal-card-mapa">
            <img src="<?= $base ?>assets/images/mapa/close.svg" alt="botão close" />
        </button>
        <div class="row container-cards-mapa">

        </div>
    </div>


    <!-- MODAL DE EMPREENDIMENTOS -->
    <div class="modal-cards-empreenimentos-filho">
        <button class="close-modal-card-empreendimento">
            <img src="<?= $base ?>assets/images/mapa/close.svg" alt="botão close" />
        </button>
        <div class="row">
            <div class="col-12 wrap_card_imovel">
                <div class="container-titulo-modal-empreenimento">
                    <h4 class="nome-empreendimento-modal-lancamentos">Imóveis do empreendimento</h4>
                </div>
            </div>
        </div>
        <div class="row container-cards-empreenimentos">

        </div>
    </div>



    <div class="modal-loader">
        <img src="<?= $base ?>assets/images/loading-buffering.gif" border="0" alt="Carregando..." />
    </div>

    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>


    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>
        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/lib/markcluster/index.js?v=<?= VERSAO ?>"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=<?= APIGOOLGE ?>"></script>
        <script src="<?= $base ?>assets/lib/lazysizes.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/nouislider.min.js?v=<?= VERSAO ?>"></script>

        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/chosen/chosen.jquery.js?v=<?= VERSAO ?>"></script>

        <script src="<?= $base ?>assets/js/busca/funcoesAuxiliaresBusca.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/busca/mapa.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/busca/busca.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/busca/index.js?v=<?= VERSAO ?>"></script>


        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>