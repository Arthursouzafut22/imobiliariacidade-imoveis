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
        <link rel="stylesheet" href="<?= $base ?>assets/css/partials/carrossel-blog.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/blog/index.css?v=<?= VERSAO ?>">

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


    <!-- CONTEUDO BLOG -->
    <section id="conteudo_blog" class="back_primario">

        <!-- BREADCRUMB -->
        <div class="container-fluid">

            <!-- BREADCRUMB -->
            <div class="row">
                <div class="margin-top-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= $base ?>blog">Blog</a></li>
                            <?php foreach ($cms_pagina_categoria as $key => $categoria): ?>
                                <?= $categoria['cod_pagina_categoria'] == $categoria_selecionada ? '<li class="breadcrumb-item"><a href="#">'. $categoria['nome_pagina_categoria'] .'</a></li>' : '' ?>
                            <?php endforeach ?>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <!-- BARRA DE PESQUISA -->
            <div class="row">
                <div class="col-12 margin-bottom-10">
                    <form action="<?= $base ?>blog?pagina=1" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="buscar"
                                value="<?= isset($buscar) ? $buscar : "" ?>" placeholder="Buscar por palavra chave"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                             <div class="input-group-append">
                                <button class="btn-search" type="submit">
                                    <img src="<?= BASE_URL ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/search.svg" alt="">
                                </button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            <!-- END BARRA DE PESQUISA -->

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <div class="row">
                        <?php foreach ($posts as $key => $item_blog): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="container_card_blog">
                                    <?php if ($item_blog['data_extenso_blog']): ?>
                                        <div class="container_date">
                                            <div class="container_date_dia">
                                                <span><?= $item_blog['data_extenso_blog']['dia'] ?></span>
                                            </div>
                                            <div class="container_date_mes">
                                                <span><?= $item_blog['data_extenso_blog']['mes'] ?></span>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <a
                                        href="<?= $base ?>blog/<?= $item_blog['url_amigavel'] ?>/<?= $item_blog['cod_pagina'] ?>">
                                        <div class="card_blog">
                                            <img class="img_blog" src="<?= $item_blog['imagem_card'] ?>"
                                                alt="<?= $item_blog['alt_imagem_conteudo'] ?>" loading="lazy" />
                                            <div class="card_body_blog">
                                                <strong class="title_blog">
                                                    <?= $item_blog['nome_pagina'] ?>
                                                </strong>
                                                <p class="margin-top-10">
                                                    <?= (strlen($item_blog['subtitulo_pagina']) > 70 ? substr($item_blog['subtitulo_pagina'], 0, 70) . '...' : $item_blog['subtitulo_pagina']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($paginacao > 1): ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div id="container_resultado_listagem_imoveis" class="row">
                                </div>

                                <div id="container_geral_paginacao" class="row mb-4">
                                    <a href="<?= $base ?>blog?pagina=1">
                                        <div id="primeiraPagina" class="btn-paginacao">
                                            <span class="carousel_setinha_listagem">‹</span>
                                        </div>
                                    </a>

                                    <!-- PAGINAÇAO -->
                                    <div class="container-paginacao">
                                        <?php for ($i = 1; $i <= $paginacao; $i++): ?>
                                            <a href="<?= $base ?>blog?pagina=<?= $i ?>">
                                                <div class="btn-paginacao <?= ($pagina == $i ? 'active' : '') ?>">
                                                    <span><?= $i ?></span>
                                                </div>
                                            </a>
                                        <?php endfor ?>
                                    </div>
                                    <a href="<?= $base ?>blog?pagina=<?= $paginacao ?>">
                                        <div id="btn-end">
                                            <div id="ultimaPagina" class="btn-paginacao">
                                                <span class="carousel_setinha_listagem">›</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <!-- IMPORTAÇÃO DOS POSTS RECENTES E POPULARES -->
                    <?php $render('blog/populares-recentes', [
                        'cms_pagina_categoria' => $cms_pagina_categoria,
                        'posts_recentes' => $posts_recentes,
                        'posts_destaques' => $posts_destaques,
                        'categoria_selecionada' => $categoria_selecionada
                    ]);
                    ?>
                </div>

            </div>

            <div class="row">
                <div class="col-12 margin-bottom-60"></div>
            </div>

        </div>

    </section>
    <!-- END SOBRE EMPRESA -->

    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>

        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/js/blog/index.js?v=<?= VERSAO ?>"></script>

 
    <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>