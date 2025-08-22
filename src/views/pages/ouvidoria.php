<!doctype html>
<html lang="pt-br">

<head>
    <?php $render('header/header-tags', $cms_pagina) //meta tags padroes 
    ?>

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
        <link rel="stylesheet" href="<?= $base ?>assets/css/ouvidoria/ouvidoria.css?v=<?= VERSAO ?>" />

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms 
        ?>

    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>

<body class="back_primario">
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>

    <?php $render('header/menu-modal', $configuracoes); // ?>
    
    <?php $render('header/top-header', $configuracoes)  //carrega o header contato ?>    

    <?php $render('header/header', $configuracoes); //carrega o header ?>


    <?php if (isset($banner)): ?>
        <!-- BANNER HEADER -->
        <div id="banner_header" class="d-flex justify-content-around align-items-center"
            style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
            <h1 class="titulo_principal"> <?= $cms_pagina['titulo_pagina'] ?> </h1>
        </div>
        <!-- END BANNER HEADER -->
    <?php endif ?>

    <!-- CONTEUDO -->
    <section id="conteudo_section" class="">
        <div class="container-fluid ">

            <div class="row margin-top-40 margin-bottom-60">
                <?php if (isset($cms_pagina) && !empty($cms_pagina)): ?>
                    <?php if (isset($cms_pagina['titulo_pagina'])): ?>
                        <h2 class="col-12 text-center color_titulo">
                            <?= $cms_pagina['subtitulo_pagina'] ?>
                        </h2>
                    <?php endif ?>
                <?php endif ?>

                <!-- COL LEFT -->
                <div class="col-12 col-sm-12 col-md-6 margin-top-40">
                    <form class="form-ouvidoria back_secundario" name="ouvidoria">
                        <div class="form-row">
                            <div class="col-12 margin-bottom-10 ">
                                <h6>Dados Pessoais</h6>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">Nome <strong>*</strong></label>
                                <input id="nome" type="text" class="form-control form-text" placeholder="Nome"
                                    name="nome" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">Sobrenome <strong>*</strong></label>
                                <input id="sobrenome" type="text" class="form-control form-text" placeholder="Sobrenome"
                                    name="sobrenome" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">Telefone <strong>*</strong></label>
                                <input id="telefone" type="text" class="form-control form-text" placeholder="Telefone"
                                    name="telefone" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">E-mail <strong>*</strong></label>
                                <input id="email" type="text" class="form-control form-text" placeholder="E-mail"
                                    name="email" required>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12 margin-bottom-10">
                                <h6>Endereço</h6>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="label-form">Endereço completo</label>
                                <div class="input-group">
                                    <input id="endereco" type="text" class="form-control form-text"
                                        placeholder="Rua/Av, número, complemento, bairro, cidade" name="endereco">
                                </div>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 10px;">
                                <div class="input-group">
                                    <label class="label-form">Motivo do contato <strong>*</strong></label>
                                    <div class="input-group">
                                        <select class="custom-select mr-sm-2 form-select padraoTexto" id="motivo"
                                            name="motivo" aria-label="Motivo do contato" required>
                                            <option>Selecione a opção</option>
                                            <option value="Elogio">Elogio</option>
                                            <option value="Reclamação">Reclamação</option>
                                            <option value="Sugestão">Sugestão</option>
                                            <option value="Denúncia">Denúncia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 10px;">
                                <div class="input-group">
                                    <label class="label-form">Mensagem <strong>*</strong></label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="" placeholder="Digite aqui sua mensagem"
                                            id="mensagem" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
                                <h6>Você pode também enviar um arquivo como fotos, documentos e outros para ajudar o
                                    entendimento do seu problema.</h6>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-bottom: 10px;">
                                <label class="label-form"> Anexe seu arquivo</label>
                                <div class="input-group">
                                    <input id="arquivo" type="file" aria-label="Arquivo" />
                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12" style="padding-top: 10px;">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div id="alert-form" class="alert alert-success" role="alert">
                                        <p>Obrigado pelo contato, nossa equipe vai orientar nos próximos passos.</p>
                                        <p>Aguarde contato!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <?php if ($configuracoes['captcha_ativo']) { ?>
                                <div class="col-xs-12 margin-bottom-20">
                                    <div class="g-recaptcha"
                                        data-sitekey="<?php echo $configuracoes['captcha_site_key']; ?>"></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <button id="submit-ouvidoria" type="submit"
                                    class="btn btn-light btn-lg btn-primario btn-block padraoTexto">Enviar</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- END COL LEFT -->

                <?php if (isset($texto_ouvidoria) && !empty($texto_ouvidoria)): ?>
                    <!-- COL RIGHT -->
                    <div class="col-12 col-sm-12 col-md-6 margin-top-30 color_texto">
                        <?php if (isset($cms_pagina['subtitulo_pagina'])): ?>
                            <div class="col-12 margin-top-10 wrap_conteudo_texto">
                                <?= $cms_pagina['subtitulo_pagina'] ?>
                            </div>
                        <?php endif ?>
                        <?php if (isset($texto_ouvidoria['descricao_conteudo'])): ?>
                            <div class="col-12 margin-top-10 wrap_conteudo_texto">
                                <?= $texto_ouvidoria['descricao_conteudo'] ?>
                            </div>
                        <?php endif ?>

                    </div>
                    <!-- END COL RIGHT -->
                <?php endif ?>
            </div>

        </div>
    </section>
    <!-- END CONTEUDO -->

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
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/ouvidoria/ouvidoria.js?v=<?= VERSAO ?>"></script>

        <!-- IMPORTACAO PARTIALS -->
        <script src="<?= $base ?>assets/js/partials/carrossel-depoimentos.js?v=<?= VERSAO ?>"></script>


    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>