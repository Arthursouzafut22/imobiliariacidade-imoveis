<!doctype html>
<html lang="pt-br">

<head>
    <?php $render('header/header-tags', $cms_pagina) //meta tags padroes 
    ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
    ?>
        <?php $render('scripts/scripts-header', $script) //scripts do banco do cms 
        ?>

        <?php $render('header/header-import', $cms_pagina) //conteudo comum header 
        ?>

        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/home/home.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/home/carrossel-busca-rapida.css?v=<?= VERSAO ?>">

        <link rel="stylesheet" href="<?= $base ?>assets/lib/chosen/chosen.css?v=<?= VERSAO ?>">

        <!-- IMPORTACAO DE PARTIALS -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/partials/carrossel-empreendimentos.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/partials/carrossel-blog.css?v=<?= VERSAO ?>">

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms 
        ?>

    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body>
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms 
    ?>

    <?php $render('header/menu-modal', $configuracoes); // 
    ?>

    <?php $render('header/top-header', $configuracoes)  //carrega o header contato 
    ?>
    <?php $render('header/header', $configuracoes); //carrega o header 
    ?>

    <?php
    if (isset($banner) && !empty($banner)): ?>
        <!-- BANNER HOME -->
        <section id="container_banner_home">
            <div id="banner_home" class="justify-content-center align-items-center"
                style="background-image: url(<?= $banner['caminho_imagem_conteudo'] ?>?v=<?= VERSAO ?>)">
                <div class="container-fluid">

                    <div class="container_box_busca_home">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="titulo_principal color_titulo text-center texto_animado_banner titulo-principal">
                                    <?= $cms_pagina['titulo_pagina'] ?>
                                </h1>
                                <div class="busca_home d-flex justify-content-around align-items-center">
                                    <div class="form-row home-row-form">
                                        <div class="col-12 col-sm-12 col-md-12 wrap_botoes_busca">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="buttom_finalidade_busca_home btn-active-busca">
                                                    <div class="d-flex justify-content-center">
                                                        <span data-campofinalidade="comprar"
                                                            class="finalidade-busca">Comprar</span>
                                                    </div>
                                                </div>
                                                <div class="buttom_finalidade_busca_home">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <span data-campofinalidade="alugar"
                                                            class="finalidade-busca">Alugar</span>
                                                    </div>
                                                </div>
                                                <div class="buttom_finalidade_busca_home">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <span data-campofinalidade="lancamentos"
                                                            class="finalidade-busca">Lançamentos</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 container-campos-home">
                                            <label class="label-form">Tipo</label>

                                            <div class="input-group input-group-lg" style="position:relative;">
                                                <div class="custom-select form-select btn-toggle-tipo">
                                                    <span><b class="cont-tipos">0</b> Selecionados</option>
                                                </div>
                                                <div class="lista-tipos">
                                                    <ul>
                                                        <!-- CONTEÚDO INSERDO NO JAVASCRIPT -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-inptut">
                                            <label class="label-form">Cidade</label>
                                            <div class="input-group input-group-lg">
                                                <select class="custom-select form-select" id="cidade" aria-label="cidade">
                                                    <option>Todas</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-inptut">
                                            <label class="label-form">Bairros</label>
                                            <div id="input-bairro" class="input-group input-group-lg"
                                                style="position:relative;">
                                                <div class="custom-select form-select btn-toggle">
                                                    <span><b class="cont-bairro">0</b> Selecionados</option>
                                                </div>
                                                <div class="lista-bairros">
                                                    <ul>
                                                        <!-- CONTEÚDO INSERDO NO JAVASCRIPT -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 fild-hide">
                                            <label class="label-form">Quartos</label>
                                            <div class="input-group input-group-lg active-lancamentos">
                                                <select class="custom-select form-select fild-hide" id="quartos"
                                                    aria-label="quartos">

                                                    <option value="0">Quartos</option>
                                                    <option value="1-quartos">1 Quarto</option>
                                                    <option value="2-quartos">2 Quartos</option>
                                                    <option value="3-quartos">3 Quartos</option>
                                                    <option value="4-quartos">4+ Quartos</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 fild-hide">
                                            <label class="label-form">Valor</label>
                                            <div class="input-group input-group-lg active-lancamentos">
                                                <input id="input_valor_min" type="text" class="form-control form-text"
                                                    placeholder="Min">
                                                <input id="input_valor_max" type="text" class="form-control form-text"
                                                    placeholder="Max">
                                            </div>
                                        </div>

                                        <div id="container-cond" class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <label class="label-form">Condomínios</label>
                                            <div class="input-group input-group-lg ">
                                                <select class="custom-select  form-select chosen" id="condominio"
                                                    aria-label="condominio">
                                                    <option selected value="0">Condomínio</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-end">
                                            <button id="submit-busca" type="submit"
                                                class="btn btn-light btn-lg btn-primario btn-block">BUSCAR IMÓVEIS</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 text-center margin-top-20">
                                    <div class="container-codigo">
                                        <!-- <button id="show-search-cod" class="btn btn-primario">Buscar por código</button> -->
                                        <div class="container_busca_codigo">
                                            <input id="codigo" class="form-text input_codigo" value=""
                                                placeholder="Digite o Código" />
                                            <div id="btn_codigo" class="container-icon">
                                                <span>BUSCAR POR CÓDIGO</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END BANNER HOME -->

    <?php endif ?>

    <?php if (count($carrossel_busca_rapida) > 0): ?>

        <section id="section_imoveis_destaque" class="back_primario">
            <div class="container-fluid container-carrossel">

                <div class="row text-center">
                    <div class="col-12 margin-top-30">
                        <h2 class="titulo_section color_titulo barra_bottom_center text-center">
                            <?= $carrossel_busca_rapida_conteudo['titulo_conteudo'] ?>
                        </h2>
                    </div>
                    <div class="col-12 margin-top-10 margin-bottom-20 <?= $carrossel_busca_rapida_conteudo['subtitulo_conteudo'] == "" ? "hide" : "" ?>">
                        <?= $carrossel_busca_rapida_conteudo['subtitulo_conteudo'] ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 margin-top-10">
                        <div id="carrossel_busca_rapida">
                            <?php foreach ($carrossel_busca_rapida as $key => $post): ?>
                                <a href="<?= $post['url_imagem_conteudo'] ?>">
                                    <div class="text-center">
                                        <img class="img_carrossel_busca_rapida" src="<?= $post['caminho_imagem_conteudo'] ?>"
                                            alt="Busca rápida" width="150px" height="150px" loading="lazy" border="0" />
                                        <span class="text-center"><?= $post['campo_custom1'] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 margin-top-20 margin-bottom-20">
                        <div class="marcadores-blog">
                            <div class="slick-slider-dots slick-slider-dots-busca-rapida"></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    <?php endif ?>


    <?php if (isset($destaques) && !empty($destaques)): ?>
        <!-- IMOVEIS EM DESTAQUE -->
        <section id="section_imoveis_destaque" class="back_primario">
            <div class="container-fluid container-carrossel">

                <div class="row">
                    <div class="col-12">
                        <h2
                            class="titulo_section color_titulo barra_bottom_center text-center margin-top-20 margin-bottom-10">
                            <?= $destaques['titulo_conteudo'] ?>
                        </h2>
                    </div>
                    <div class="col-12 text-center margin-bottom-20 <?= $destaques['subtitulo_conteudo'] == "" ? "hide" : "" ?>">
                        <?= $destaques['subtitulo_conteudo'] ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 margin-top-10 margin-bottom-20">
                        <div class="d-flex justify-content-center align-items-center">

                            <button class="botao_destaque_home buttom-destaque btn-active" data-finalidade="comprar">
                                <div class="d-flex justify-content-center">
                                    <span>Comprar</span>
                                </div>
                            </button>
                            <button class="botao_destaque_home buttom-destaque" data-finalidade="alugar">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span>Alugar</span>
                                </div>
                            </button>
                            <button class="botao_destaque_home buttom-destaque" data-finalidade="super_destaque">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span>Super Destaque</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <!-- carrossel de destaques -->
                        <div id="carrossel_destaques_imoveis"></div>
                        <!-- end carrossel de destaques -->
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="d-flex justify-content-center align-item-center ">
                                <img src="<?= $base ?>assets/images/loading-buffering.gif" id="id-gif"
                                    class="lazyload margin-top-40 margin-bottom-60" loading="lazy" width="32" height="32"
                                    border="0" alt="Loading" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-item-center">
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
        </section>
        <!-- END IMOVEIS EM DESTAQUE -->
    <?php endif ?>


    <?php if (count($banners_carrossel) > 0): ?>
        <!-- EMPREENDIMENTOS -->
        <section id="section_banner_empreendimentos">
            <div class="back_div_transition back_div_transition_top"></div>
            <div class="back_secundario">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="titulo_section color_titulo barra_bottom_center margin-top-20 margin-bottom-20">
                                <?= $banners_carrossel[0]['titulo_conteudo'] ?>
                            </h2>
                        </div>
                        <div class="col-12 text-center margin-top-0 margin-bottom-20 <?= $banners_carrossel[0]['subtitulo_conteudo'] == "" ? "hide" : "" ?>">
                            <span class="">
                                <?= $banners_carrossel[0]['subtitulo_conteudo'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 margin-bottom-20" style="position: relative;">
                            <?php
                            //chamo os empreendimentos
                            $render('sections/carrossel-empreendimentos', ['banners_carrossel' => $banners_carrossel])
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="back_div_transition back_div_transition_bottom"></div>
            <!-- style="background-image: url(<?= $base ?>assets/images/back_transition_down.png);" -->
        </section>
        <!-- END EMPREENDIMENTOS -->
    <?php endif ?>



    <?php if (isset($conteudo_textos_buscas_prontas)  && BAIRROS_HOME_BANCO == true) : ?>
        <!-- MAIS FILTROS -->
        <section id="container_mais_filtros" class="back_primario">
            <div class="container-fluid">

                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="titulo_section color_titulo barra_bottom_center text-center margin-top-10">
                            <?= $conteudo_textos_buscas_prontas['titulo_pagina'] ?>
                        </h2>
                    </div>
                    <div class="col-12 margin-top-10 margin-bottom-10 <?= $conteudo_textos_buscas_prontas['subtitulo_pagina'] == "" ? "hide" : "" ?>">
                        <?= $conteudo_textos_buscas_prontas['subtitulo_pagina'] ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 margin-top-30 margin-bottom-40">

                        <!-- Nav tabs -->
                        <ul class="botoes_lista_imoveis_home nav nav-pills text-center">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab_home_lista_comprar">Quero
                                    Comprar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_home_lista_alugar">Quero Alugar</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content margin-top-20">
                            <!-- tab lista comprar -->
                            <div class="tab-pane active" id="tab_home_lista_comprar">
                                <div class="row">

                                    <!-- bairro 1 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro1[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro1 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 1 -->

                                    <!-- bairro 2 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro2[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro2 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 2 -->

                                    <!-- bairro 3 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro3[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro3 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 3 -->

                                    <!-- bairro 4 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro4[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro4 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 4 -->

                                    <!-- bairro 5 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro5[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro5 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 5 -->

                                    <!-- bairro 6 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro6[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro6 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 6 -->

                                    <!-- bairro 7 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro7[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro7 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 7 -->

                                    <!-- bairro 8 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro8[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro8 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 8 -->

                                    <!-- bairro 9 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro9[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro9 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 9 -->

                                    <!-- bairro 10 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro10[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro10 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 10 -->

                                    <!-- bairro 11 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro11[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro11 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 11 -->

                                    <!-- bairro 12 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_venda_bairro12[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_venda_bairro12 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 12 -->

                                </div>
                            </div>
                            <!-- end tab lista comprar -->

                            <!-- tab lista comprar -->
                            <div class="tab-pane fade" id="tab_home_lista_alugar">
                                <div class="row">

                                    <!-- bairro 1 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro1[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro1 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 1 -->

                                    <!-- bairro 2 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro2[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro2 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 2 -->

                                    <!-- bairro 3 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro3[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro3 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 3 -->

                                    <!-- bairro 4 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro4[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro4 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 4 -->

                                    <!-- bairro 5 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro5[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro5 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 5 -->

                                    <!-- bairro 6 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro6[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro6 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 6 -->

                                    <!-- bairro 7 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro7[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro7 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 7 -->

                                    <!-- bairro 8 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro8[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro8 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 8 -->

                                    <!-- bairro 9 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro9[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro9 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 9 -->

                                    <!-- bairro 10 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro10[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro10 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 10 -->

                                    <!-- bairro 11 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro11[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro11 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- end bairro 11 -->

                                    <!-- bairro 12 -->
                                    <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="titulo_site color_titulo titulo-bairros margin-bottom-20">
                                                    <?= $lista_buscas_locacao_bairro12[0]['titulo_conteudo'] ?>
                                                </h2>
                                            </div>
                                            <?php foreach ($lista_buscas_locacao_bairro12 as $key => $filtro): ?>
                                                <div class="col-12">
                                                    <a class="box_link_mais_filtros"
                                                        href="<?= $filtro['descricao_resposta'] ?>">
                                                        <?= $filtro['titulo_pergunta'] ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <!-- bairro col 12 -->

                                </div>
                            </div>
                            <!-- end tab lista comprar -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- END MAIS FILTROS -->
    <?php endif ?>
    <?php if (BAIRROS_HOME_BANCO == false): ?>
        <!-- MAIS FILTROS -->
        <section id="container_mais_filtros" class="back_primario">
            <div class="container-fluid">

                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="titulo_section color_titulo barra_bottom_center text-center margin-top-10">
                            <?= $conteudo_textos_buscas_prontas['titulo_pagina'] ?>
                        </h2>
                    </div>
                    <div class="col-12 margin-top-10 margin-bottom-10 <?= $conteudo_textos_buscas_prontas['subtitulo_pagina'] == "" ? "hide" : "" ?>">
                        <?= $conteudo_textos_buscas_prontas['subtitulo_pagina'] ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 margin-top-30 margin-bottom-40">

                        <!-- Nav tabs -->
                        <ul class="botoes_lista_imoveis_home nav nav-pills text-center">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab_home_lista_comprar">Quero
                                    Comprar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_home_lista_alugar">Quero Alugar</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content margin-top-20">
                            <!-- tab lista comprar -->
                            <div class="tab-pane active" id="tab_home_lista_comprar">
                                <div class="row">

                                    <?php if (!empty($principais_pesquisas_venda) && isset($principais_pesquisas_venda[0])): ?>
                                        <!-- bairro 1 -->
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_venda[0]['bairro']['nome'] ?>

                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_venda[0]['filtros'] as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- end bairro 1 -->
                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>

                                    <?php if (!empty($principais_pesquisas_venda) && isset($principais_pesquisas_venda[1])): ?>
                                        <!-- bairro 2 -->
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_venda[1]['bairro']['nome'] ?>
                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_venda[1]['filtros'] as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- end bairro 2 -->

                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>

                                    <?php if (!empty($principais_pesquisas_venda) && isset($principais_pesquisas_venda[2])): ?>
                                        <!-- bairro 3 -->
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_venda[2]['bairro']['nome'] ?>
                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_venda[2]['filtros']  as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- end bairro 3 -->
                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>
                                    <!-- bairro 4 -->

                                    <?php if (!empty($principais_pesquisas_venda) && isset($principais_pesquisas_venda[3])): ?>
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_venda[3]['bairro']['nome'] ?>
                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_venda[3]['filtros'] as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- bairro col 4 -->
                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <!-- end tab lista comprar -->

                            <!-- tab lista comprar -->
                            <div class="tab-pane fade" id="tab_home_lista_alugar">
                                <div class="row">

                                    <?php if (!empty($principais_pesquisas_aluguel) && isset($principais_pesquisas_aluguel[0])): ?>
                                        <!-- bairro 1 -->
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_aluguel[0]['bairro']['nome'] ?>
                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_aluguel[0]['filtros'] as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- end bairro 1 -->
                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>

                                    <?php if (!empty($principais_pesquisas_aluguel) && isset($principais_pesquisas_aluguel[1])): ?>
                                        <!-- bairro 2 -->
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_aluguel[1]['bairro']['nome'] ?>
                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_aluguel[1]['filtros'] as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- end bairro 2 -->
                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>

                                    <?php if (!empty($principais_pesquisas_aluguel) && isset($principais_pesquisas_aluguel[2])): ?>
                                        <!-- bairro 3 -->
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_aluguel[2]['bairro']['nome'] ?>
                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_aluguel[2]['filtros'] as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- end bairro 3 -->

                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>

                                    <?php if (!empty($principais_pesquisas_aluguel) && isset($principais_pesquisas_aluguel[3])): ?>
                                        <!-- bairro 4 -->
                                        <div class="col-12 col-sm-6 col-md-3 margin-top-30">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="titulo_site color_titulo margin-bottom-20">
                                                        <?= $principais_pesquisas_aluguel[3]['bairro']['nome'] ?>
                                                    </h2>
                                                </div>
                                                <?php foreach ($principais_pesquisas_aluguel[3]['filtros'] as $filtro): ?>
                                                    <div class="col-12">
                                                        <a class="box_link_mais_filtros"
                                                            href="<?= $filtro['url'] ?>">
                                                            <?= $filtro['titulo'] ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <!-- bairro col 4 -->

                                    <?php else: ?>
                                        <h5> Bairro ou tipo não encontrado &nbsp &nbsp</h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- end tab lista comprar -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- END MAIS FILTROS -->
    <?php endif ?>


    <?php /* if (count($carrossel_blog) > 0): ?>
<!-- BLOG -->
<section id="container_mais_filtros" class="">
  <div class="container-fluid">

      <div class="row">
          <div class="col-12 margin-top-40">
              <h2 class="titulo_section barra_bottom_center text-center">
                  <?= $carrossel_blog_pagina['titulo_conteudo'] ?>
              </h2>
              <p class="text-center margin-top-20"><?= $carrossel_blog_pagina['subtitulo_conteudo'] ?></p>
          </div>
      </div>

      <div class="row">
          <div class="col-12 margin-bottom-20">
              <?php
              //chamo o carrossel blog
              $render('sections/carrossel-blog', ['carrossel_blog' => $carrossel_blog])
                  ?>
          </div>
      </div>
  </div>
</section>
<!-- END BLOG -->
<?php endif */ ?>

    <?php $render('footer/footer', $configuracoes) //html do footer 
    ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp 
    ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
    ?>

        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms 
        ?>
        <?php $render('footer/footer-import', $script) //comum do footer 
        ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/lib/chosen/chosen.jquery.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/home/carrossel-imoveis.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/home/carrossel-busca-rapida.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/home/index.js?v=<?= VERSAO ?>"></script>

        <!-- IMPORTACAO DE PARTIALS -->
        <script src="<?= $base ?>assets/js/partials/carrossel-empreendimentos.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/partials/carrossel-depoimentos.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/partials/carrossel-blog.js?v=<?= VERSAO ?>"></script>

    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>