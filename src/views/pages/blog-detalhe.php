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

        <!-- ESTILOS DO SITE -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/partials/carrossel-blog.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/blog/index.css?v=<?= VERSAO ?>">
        <link rel="stylesheet" href="<?= $base ?>assets/css/blog/detalhe.css?v=<?= VERSAO ?>">

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


    <!-- DETALHE DO BLOG -->
    <section id="section_conteudo_detalhes" class="back_primario">
        <div class="container-fluid">
              <!-- BREADCRUMB -->
              <div class="row">
                <div class="margin-top-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base ?>">Home</a></li>
                            <li class="breadcrumb-item"><a onclick="window.history.back()">Blog</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- END BREADCRUMB -->

            <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <!-- <button class="btn-voltar" onclick=" window.history.back()"> 
                    <img src="<?= BASE_URL ?>assets/icons/arrow_back.svg" alt="seta para voltar" />
                    <span>Voltar</span> 
                </button>   -->
            </div>

                <!-- COL LEFT -->
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h1 class="container_titulo_blog">
                                <?= $conteudos[0]['titulo_pagina'] ?>
                            </h1>
                        </div>

                        <?php foreach ($conteudos as $conteudo): ?>
                            <!-- SE FOR CONTEUDO DE IMAGEM -->
                            <?php if ($conteudo['cod_pagina_tipo_conteudo'] == 2): ?>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-bottom-30">
                                    <img class="banner-detalhe" src="<?= $conteudo['caminho_imagem_conteudo'] ?>"
                                        alt="<?= $conteudo['alt_imagem_conteudo'] ?>">
                                </div>
                            <?php endif ?>

                            <!-- SE FOR CONTEUDO DE TEXTO -->
                            <?php if ($conteudo['cod_pagina_tipo_conteudo'] == 1): ?>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-bottom-30">
                                    <div class="container_texto">
                                        <p><?= nl2br($conteudo['descricao_conteudo']) ?></p>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            if (PAGE_SPEED_100) {
                                if ($conteudo['cod_pagina_tipo_conteudo'] == 3) {
                                    ?>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                                        <iframe width="100%" height="400" src="<?= $conteudo['url_video_conteudo'] ?>" title=""
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        <?php endforeach ?>
                    </div>

                    <?php if (count($anexos) > 0): ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <h6 class="container_titulo_blog">Anexos</h6>
                            </div>
                            <div class="col-12 ">
                                <div class="row">
                                    <?php foreach ($anexos as $key => $anexo): ?>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                            <a href="">
                                                <div class="card-anexo">
                                                    <span><?= $anexo['titulo_anexo_conteudo'] ?></span>
                                                    <img src="<?= $base ?>assets/icons/download.svg" alt="icons anexo">
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <?php if (count($perguntas_respostas) > 0): ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <h6 class="container_titulo_blog">Perguntas Frequentes</h6>
                            </div>
                            <div class="col-12 ">
                                <div class="accordion" id="accordionExample">
                                    <?php foreach ($perguntas_respostas as $key => $item): ?>
                                        <div class="card">
                                            <div class="card-header" id="headingOne<?=  $key ?>">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button"
                                                        data-toggle="collapse" data-target="#collapseOne<?=  $key ?>" aria-expanded="true"
                                                        aria-controls="collapseOne<?=  $key ?>">
                                                       <?= $item['titulo_pergunta'] ?>
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="collapseOne<?=  $key ?>" class="collapse" aria-labelledby="headingOne<?=  $key ?>"
                                                data-parent="#accordionExample">
                                                <div class="card-body">
                                                <?= $item['descricao_resposta'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                </div>
                <!-- END COL LEFT -->





                <!-- COL RIGHT -->
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                    <!-- BARRA DE PESQUISA -->
                    <div class="row">
                        <div class="col-12 margin-top-20">
                            <form action="<?= $base ?>blog?pagina=1" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="buscar"
                                        value="<?= isset($buscar) ? $buscar : "" ?>"
                                        placeholder="Buscar por palavra chave" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn-search" type="submit">
                                            <img src="<?= BASE_URL ?>assets/icons/search.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END BARRA DE PESQUISA -->


                    <?php $render('blog/populares-recentes', [
                        'cms_pagina_categoria' => $cms_pagina_categoria,
                        'posts_recentes' => $posts_recentes,
                        'posts_destaques' => $posts_destaques,
                        'categoria_selecionada' => $categoria_selecionada
                    ]);
                    ?>
                </div>
                <!-- END COL RIGHT -->
            </div>

            <div class="row">
                <div class="col-12 margin-top-40 margin-bottom-40"></div>
            </div>
        </div>
    </section>
    <!-- END DETALHE DO BLOG -->

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