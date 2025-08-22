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
        <link rel="stylesheet" href="<?= $base ?>assets/css/trabalhe-conosco/index.css?v=<?= VERSAO ?>" />

        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms 
        ?>
    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</head>


<body>
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>

    <?php $render('header/menu-modal', $configuracoes); //  ?>

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


    <!-- CONTEUDO TRABALHE CONOSCO -->
    <section id="conteudo_trabalhe_conosco" class="back_primario">
        <div class="container-fluid">

            <div class="row">

                <!-- COL 6 -->
                <div class="col-12 col-sm-6 margin-top-40">

                    <h1 class="color_titulo"><?= $cms_pagina['titulo_conteudo'] ?></h1>

                    <div class="margin-top-20 color_texto">
                        <?= $cms_pagina['descricao_conteudo'] ?>
                    </div>

                </div>
                <!-- END COL 6 -->

                <!-- COL 6 -->
                <div class="col-12 col-sm-6 margin-top-40">

                    <form class="form-trabalhe-conosco back_secundario color_texto" name="trabalheconosco">
                        <div class="form-row">
                            <div class="col-12 titulo_form">
                                <?= $cms_pagina['subtitulo_conteudo'] ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <hr />
                                <h6 class="margin-bottom-20">Dados Pessoais</h6>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">Nome <strong>*</strong> </label>
                                <input id="nome" type="text" class="form-control form-text" placeholder="Nome"
                                    name="nome" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">Sobrenome <strong>*</strong> </label>
                                <input id="sobrenome" type="text" class="form-control form-text" placeholder="Sobrenome"
                                    name="sobrenome" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">Telefone <strong>*</strong> </label>
                                <input id="telefone" type="text" class="form-control form-text" placeholder="Telefone"
                                    name="telefone" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="margin-bottom: 10px;">
                                <label class="label-form">CPF <strong>*</strong> </label>
                                <input id="cpf" type="text" class="form-control form-text" placeholder="CPF" name="cpf" required>
                            </div>

                            <div class="col-12">
                                <hr />
                                <h6 class="margin-bottom-20">Oportunidades</h6>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="label-form">Vagas <strong>*</strong> </label>
                                <div class="input-group">
                                    <select class="custom-select mr-sm-2 form-select padraoTexto" id="vaga" name="vaga"
                                        aria-label="Vagas" required>
                                        <option value="">Selecione a vaga</option>
                                        <option>Vendas</option>
                                        <option>Locação</option>
                                        <option>Financeiro</option>
                                        <option>Jurídico</option>
                                        <option>Marketing</option>
                                        <option>Recursos Humanos</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 margin-top-10">
                                <label class="label-form">Anexe seu currículo <strong>*</strong> </label>
                                <div class="input-group">
                                    <input id="arquivo" type="file" aria-label="Arquivo" required />
                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="form-row">
                                <?php if ($configuracoes['captcha_ativo']) { ?>
                                    <div class="col-xs-12 margin-bottom-20">
                                        <div class="g-recaptcha"
                                            data-sitekey="<?php echo $configuracoes['captcha_site_key']; ?>"></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div id="alert-form" class="alert alert-success" role="alert">
                                        <p>Obrigado pelo contato, nossa equipe vai orientar nos próximos passos.</p>
                                        <p>Aguarde contato!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <button id="submit-trabalhe-conosco" type="submit"
                                    class="btn btn-light btn-lg btn-primario btn-block btn-enviar-curriculo">
                                    Enviar currículo
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- END COL 6 -->

            </div>

            <div class="row col-12 margin-top-60"></div>

        </div>
    </section>
    <!-- END CONTEUDO TRABALHE CONOSCO -->


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
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/trabalhe-conosco/index.js?v=<?= VERSAO ?>"></script>

    <?php
    //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>