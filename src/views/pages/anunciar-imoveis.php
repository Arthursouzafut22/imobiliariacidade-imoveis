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
        <link rel="stylesheet" href="<?= $base ?>assets/css/anuncie-seu-imovel/index.css?v=<?= VERSAO ?>" />

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


    <?php if (isset($banner) && !empty($banner)): ?>
        <!-- BANNER HEADER -->
        <div id="banner_header" class="d-flex justify-content-around align-items-center"
            style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
            <span class="titulo_principal"> <?= $cms_pagina['titulo_pagina'] ?> </span>
        </div>
        <!-- END BANNER HEADER -->
    <?php endif ?>

    <!-- ANUNCIE SEU IMOVEL -->
    <section id="anuncie_seu_imovel" class="back_primario">
        <div class="container-fluid">
            <div class="row">
                <!-- COL LEFT -->
                <div class="col-12 col-sm-6 margin-top-40">
                    <div class="row">
                        <div class="col-12">
                            <h2><?= $cms_pagina['subtitulo_pagina'] ?></h2>
                        </div>
                    </div>

                    <?php if (isset($texto_lateral) && !empty($texto_lateral)): ?>
                        <div class="row section_content_passo_a_passo">
                            <?php foreach ($texto_lateral as $lista): ?>
                                <div class="col-12">
                                    <h6 class="titulo-num"><?= $lista['titulo_pergunta'] ?></h6>
                                    <p class="text-passos"><?= $lista['descricao_resposta'] ?>.</p>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($beneficios) && !empty($beneficios)): ?>
                        <div class="row" id="container-icons-banner">
                            <div class="col-12  margin-top-30">
                                <h2 class="text-center"><?= $beneficios_titulos['titulo_conteudo'] ?></h2>
                            </div>
                            <?php foreach ($beneficios as $item): ?>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 card-icon">
                                    <img src="<?= $item['caminho_imagem_conteudo'] ?>" alt="Benefício" border="0" />
                                    <p class="margin-top-20"><?= $item['campo_custom1'] ?></p>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                </div>
                <!-- END COL LEFT -->

                <!-- COL RIGHT -->
                <div class="col-12 col-sm-6 margin-top-40">
                    <form class="form-anuncie-seu-imovel" name="anuncieseuimovel">
                        <div class="form-row">
                            <div class="col-12 titulo_form">
                                Preencha o formulário abaixo e anuncie seu imóvel conosco!
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">

                                <hr />
                                <h6>Dados Pessoais</h6>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="label-form">Nome <strong>*</strong></label>
                                <input id="nome" type="text" class="form-control form-text" required placeholder="Nome" data-label="Nome"
                                    name="nome">

                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Telefone <strong>*</strong></label>
                                <input id="telefone" type="text" class="form-control form-text" required placeholder="Telefone" data-label="Telefone"
                                    name="telefone">
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">E-mail</label>
                                <input id="email" type="text" class="form-control form-text" placeholder="E-mail"
                                    name="email">
                            </div>
                            <div class="col-12">
                                <hr />
                                <h6>Dados do imóvel</h6>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="label-form">Finalidade <strong>*</strong> </label>
                                <div class="input-group">
                                    <select class="custom-select mr-sm-2 form-select" required id="finalidade" name="finalidade" data-label="Finalidade">
                                        <option value="">Selecione a finalidade</option>
                                        <option value="2">Vender</option>
                                        <option value="1">Alugar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Qual o tipo do seu imóvel ?</label>
                                <div class="">
                                    <select class="custom-select mr-sm-2 form-select" id="tipo" name="tipo">
                                    </select>
                                </div>
                            </div>
                            <div id="container-text-tipo" class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Escreva o tipo do seu imóvel</label>
                                <div class="input-group">
                                    <input id="tipoimovel" type="text" class="form-control form-text"
                                        placeholder="Casa, Apartamento, Lote..." name="tipoimovel">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Destinação</label>
                                <div class="">
                                    <select class="custom-select mr-sm-2 form-select" id="destinacao" name="destinacao">
                                        <option value="">Qual a destinação</option>
                                        <option value="1">Residencial</option>
                                        <option value="2">Comercial</option>
                                        <option value="3">RESIDENCIAL E COMERCIAL</option>
                                        <option value="4">INDUSTRIAL</option>
                                        <option value="5">RURAL</option>
                                        <option value="6">TEMPORADA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Valor</label>
                                <div class="input-group">
                                    <input id="valorimovel" type="text" class="form-control form-text mask-valor"
                                        placeholder="Digite o valor" name="valorimovel">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Valor do Condomínio</label>
                                <div class="input-group">
                                    <input id="valorcondominio" type="text" class="form-control form-text mask-valor"
                                        placeholder="Digite o valor" name="valorcondominio">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Valor do IPTU</label>
                                <div class="input-group">
                                    <input id="valoriptu" type="text" class="form-control form-text mask-valor"
                                        placeholder="Valor IPTU" name="valoriptu">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Área interna</label>
                                <div class="input-group">
                                    <input id="areainterna" type="number" class="form-control form-text mask-area"
                                        placeholder="Área interna" name="areainterna">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Área externa</label>
                                <div class="input-group">
                                    <input id="areaexterna" type="number" class="form-control form-text  mask-area"
                                        placeholder="Área externa" name="areaexterna">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Área Lote</label>
                                <div class="input-group">
                                    <input id="arealote" type="text" class="form-control form-text mask-area"
                                        placeholder="Área Lote" name="arealote">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Andar</label>
                                <div class="input-group">
                                    <input id="andar" type="number" class="form-control form-text  mask-area"
                                        placeholder="Andar" name="andar">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Quantidade de Quartos</label>
                                <div class="input-group">
                                    <input id="numeroquarto" type="text" class="form-control form-text  mask-area"
                                        placeholder="Número Quartos" name="numeroquarto">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Quatidade de suite</label>
                                <div class="input-group">
                                    <input id="numerosuite" type="text" class="form-control form-text  mask-area"
                                        placeholder="Número Suite" name="numerosuite">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Quatidade de Banheiros</label>
                                <div class="input-group">
                                    <input id="numerobanho" type="text" class="form-control form-text  mask-area"
                                        placeholder="Número Banheiros" name="numerobanho">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <label class="label-form">Quatidade de Vagas</label>
                                <div class="input-group">
                                    <input id="numerovaga" type="text" class="form-control form-text  mask-area"
                                        placeholder="Número Vagas" name="numerovaga">
                                </div>
                            </div>


                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="input-group container-check">
                                    <input id="aceitapermuta" type="checkbox"
                                        aria-label="Checkbox for following text input">
                                    <span class="label-form">Aceita permuta</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="input-group container-check">
                                    <input id="aceitafinanciamento" type="checkbox"
                                        aria-label="Checkbox for following text input">
                                    <span class="label-form">Aceita Financiamento</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="input-group container-check">
                                    <input id="ocupado" type="checkbox" aria-label="Checkbox for following text input">
                                    <span class="label-form">Ocupado</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">

                                <hr />
                                <h6>Endereço</h6>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12">
                                <label class="label-form">CEP</label>
                                <div class="input-group">
                                    <input id="cep" type="text" class="form-control form-text" placeholder="CEP"
                                        name="cep">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                                <label class="label-form">ENDEREÇO</label>
                                <div class="input-group">
                                    <input id="endereco" type="text" class="form-control form-text" placeholder="Rua/Av"
                                        name="endereco">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <label class="label-form">NÚMERO</label>
                                <input id="numeroendereco" type="text" class="form-control form-text" placeholder="N°"
                                    name="numeroendereco">
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <label class="label-form">CIDADE</label>
                                <div class="input-group">
                                    <input id="cidade" type="text" class="form-control form-text" placeholder="Cidade"
                                        name="cidade">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                                <label class="label-form">COMPLEMENTO</label>
                                <div class="">
                                    <input id="complemento" type="text" class="form-control form-text"
                                        placeholder="Complemento" name="complemento">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                <label class="label-form">BAIRRO</label>
                                <div class="input-group">
                                    <input id="bairro" type="text" class="form-control form-text" placeholder="Bairro"
                                        name="bairro">
                                </div>
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
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <p style="font-size:13px;" class="my-4">Ao informar meus dados, eu concordo com a <a
                                        class="text-primary fs-1 text-decoration-underline"
                                        href="<?= $base ?>politica-privacidade" target="_blank">Política de
                                        Privacidade</a>.
                                </p>

                                <?php if ($configuracoes['captcha_ativo']) { ?>
                                    <div class="col-xs-12 margin-top-10 margin-bottom-20">
                                        <div class="g-recaptcha"
                                            data-sitekey="<?php echo $configuracoes['captcha_site_key']; ?>"></div>
                                    </div>
                                <?php } ?>

                                <button id="submit-anunciar" type="submit"
                                    class="btn btn-light btn-lg btn-primario btn-block">ANUNCIAR IMÓVEL</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- END COL RIGHT -->

                <div class="row col-12 margin-top-40 margin-bottom-40"></div>
            </div>

        </div>
    </section>


    <!-- <section id="anuncie_seu_imovel">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  margin-top-40 margin-bottom-40">
                    <div class="row">
                        <div class="card-regulamento col-12">
                            //conteudo
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <!-- END ANUNCIE SEU IMOVEL -->

    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>
    
    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100):
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>
        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <!-- IMPORTACAO DA PAGINA -->
        <script src='https://www.google.com/recaptcha/api.js'></script> 
        <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
        <script src="<?= $base ?>assets/js/anunciar-imovel/index.js?v=<?= VERSAO ?>"></script>

        <?php
        //END - Se for pagespeed eu nao mostro os scripts
    endif
    ?>
</body>

</html>