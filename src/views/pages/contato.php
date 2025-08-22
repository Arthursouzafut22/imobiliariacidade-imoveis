<!doctype html>
<html lang="pt-br">
<head>

<?php $render('header/header-tags', $cms_pagina) //meta tags padroes ?>

    <?php
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100) : 
        ?>
        <?php $render('scripts/scripts-header', $script) //scripts do banco do cms ?>     
        
        <?php $render('header/header-import', $cms_pagina) //conteudo comum header ?>

        <!-- IMPORTAÇÃO DA PAGINA -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/contato/contato.css?v=<?=VERSAO?>" />

        <!-- IMPORTACAO PARTIALS -->
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick-theme.css?v=<?=VERSAO?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/slick.css?v=<?=VERSAO?>" />
        <link rel="stylesheet" href="<?= $base ?>assets/css/partials/carrossel-depoimentos.css?v=<?=VERSAO?>" />
        
        <?php $render('scripts/scripts-pos-header', $script); //scripts do banco do cms ?>
        <?php 
    //END - Se for pagespeed eu nao mostro os scripts
    endif 
    ?>
</head>
<body class="back_secundario">
    <?php $render('scripts/scripts-body-inicial', $script); //scripts do banco do cms ?>

    <?php $render('header/menu-modal', $configuracoes); // ?>

    <?php $render('header/top-header', $configuracoes)  //carrega o header contato ?>    
    <?php $render('header/header', $configuracoes); //carrega o header ?>

    
    <?php if(isset($banner)) : ?>
    <!-- BANNER HEADER -->
    <div id="banner_header" class="d-flex justify-content-around align-items-center" style="background-image: url('<?= $banner['caminho_imagem_conteudo'] ?>');">
        <h1 class="titulo_principal"> <?= $cms_pagina['titulo_pagina'] ?> </h1>
    </div>
    <!-- END BANNER HEADER -->
    <?php endif ?>


    <!-- SECTION FALE CONOSCO -->
    <section id="texto_sobre_empresa" class="back_primario">
        <div class="container-fluid">      
            
            <div class="row text-center">
                <div class="col-12 margin-top-20 margin-bottom-20">
                    <h3><?=$cms_pagina['subtitulo_pagina']?></h3>
                </div>
            </div>

            <div class="row">

                <!-- COL FORM -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 margin-top-20 margin-bottom-30 ">
                    <!-- FORM -->
                    <form class="form-contato box_contato back_secundario" name="faleconosco" >
                        <h4 class="titulo_form margin-bottom-10 color_titulo">
                            Fale conosco
                        </h4>
                        
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 margin-bottom-10">
                                <label class="label-form">Nome <span class="asterisco-valiacao">*</span></label>
                                <div class="input-group">
                                    <input id="nome" data-label="Nome" name="nome" type="text" class="form-control form-text" required placeholder="Seu nome" aria-label="nome" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 margin-bottom-10">
                                <label class="label-form">E-mail <span class="asterisco-valiacao">*</span></label>
                                <input id="email" data-label="E-mail" name="email" type="email" class="form-control form-text" required placeholder="E-mail" aria-label="email" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-10">
                                <label class="label-form">Telefone <span class="asterisco-valiacao">*</span></label>
                                <div class="">
                                    <input id="tel" data-label="Telefone" name="tel" type="text" class="form-control form-text" required placeholder="(31) 0 0000-0000" aria-label="telefone celular" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-10">
                                <label class="label-form">Fixo</label>
                                <div class="">
                                    <input id="fixo" data-label="Fixo" name="fixo" type="text" class="form-control form-text" placeholder="(31) 0000-0000" aria-label="telefone fixo" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-bottom-10">
                                <label class="label-form">Descrição</label>
                                <div class="input-group input-group-lg">
                                    <textarea  data-label="Descrição"  class="form-control" name="descricao" id="descricao" rows="3" aria-label="descrição"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row margin-top-10">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <p class="font_form margin-bottom-20 color_texto">Ao informar meus dados, eu concordo com a <a
                                        class="text-primary fs-1 text-decoration-underline"
                                        href="<?= $base ?>politica-privacidade" target="_blank">Política de
                                        Privacidade</a>.
                                </p>

                                <?php if($configuracoes['captcha_ativo']) { ?>
                                    <div class="col-xs-12 margin-top-10 margin-bottom-20">
                                        <div class="g-recaptcha" data-sitekey="<?php echo $configuracoes['captcha_site_key']; ?>"></div>
                                    </div>
                                <?php } ?>
                                
                            </div>

                            <button id="submit-contato" type="submit" class="btn btn-light btn-lg btn-primario btn-block">Enviar mensagem</button>
                        </div>

                    </form>
                    <!-- END FORM -->
                </div>
                <!-- END COL FORM -->

                <!-- COL CONTATOS -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 margin-top-20 margin-bottom-30 ">
                    <div class="box_contato box_color_tema">
                        <div class="row">
                            <div class="col-12 margin-bottom-20">
                                <h3 class="titulo_form">
                                    Canais de atendimento
                                </h3>
                            </div>

                            <?php if ($configuracoes['endereco'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <img src="<?= $base ?>assets/icons/icon-map-branco.svg" width="20" height="19" border="0" alt="Mapa" /> <?= $configuracoes['endereco'] ?>
                            </div>
                            <?php endif ?>

                            <?php if ($configuracoes['tel_fixo'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <a class="link_box_contato" href="tel:<?= preg_replace('/[^0-9]/', '', $configuracoes['tel_fixo']) ?>">
                                    <img src="<?= $base ?>assets/icons/icon-phone-branco.svg" width="21" height="21" alt="Telefone Fixo" border="0" /> <?= $configuracoes['tel_fixo'] ?>
                                </a>
                            </div>
                            <?php endif ?>

                            <?php if ($configuracoes['tel_fixo_aluguel'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <a class="link_box_contato" href="tel:<?= preg_replace('/[^0-9]/', '', $configuracoes['tel_fixo_aluguel']) ?>">
                                    <img src="<?= $base ?>assets/icons/icon-phone-branco.svg" width="21" height="21" alt="Telefone Fixo" border="0" /> <?= $configuracoes['tel_fixo_aluguel'] ?>
                                </a>
                            </div>
                            <?php endif ?>

                            <?php if ($configuracoes['tel_fixo_venda'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <a class="link_box_contato" href="tel:<?= preg_replace('/[^0-9]/', '', $configuracoes['tel_fixo_venda']) ?>">
                                    <img src="<?= $base ?>assets/icons/icon-phone-branco.svg" width="21" height="21" alt="Telefone Fixo" border="0" /> <?= $configuracoes['tel_fixo_venda'] ?>
                                </a>
                            </div>
                            <?php endif ?>

                            <?php if ($configuracoes['tel_celular'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <a class="link_box_contato" href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', $configuracoes['tel_celular']) ?>&text=Olá.">
                                    <img src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="21" height="22" alt="WhatsApp" border="0" /> <?= $configuracoes['tel_celular'] ?>
                                </a>
                            </div>
                            <?php endif ?>

                            <?php if ($configuracoes['tel_cel_venda'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <a class="link_box_contato" href="https://api.whatsapp.com/send?phone=<?= $configuracoes['tel_cel_venda'] ?>">
                                    <img src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="21" height="22" alt="WhatsApp" border="0" /> <?= $configuracoes['tel_cel_venda'] ?>
                                </a>
                            </div>
                            <?php endif ?>

                            <?php if ($configuracoes['tel_cel_aluguel'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <a class="link_box_contato" href="https://api.whatsapp.com/send?phone=<?= $configuracoes['tel_cel_aluguel'] ?>">
                                    <img src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="21" height="22" alt="WhatsApp" border="0" /> <?= $configuracoes['tel_cel_aluguel'] ?>
                                </a>
                            </div>
                            <?php endif ?>
                            
                            <?php if ($configuracoes['email'] != '') : ?>
                            <div class="col-12 margin-bottom-10">
                                <a class="link_box_contato" href="mailto:<?= $configuracoes['email'] ?>">
                                    <img src="<?= $base ?>assets/icons/icon-email-branco.png" width="21" height="21" alt="E-mail" border="0" /> <?= $configuracoes['email'] ?>
                                </a>
                            </div>
                            <?php endif ?>

                            <div class="col-12 margin-top-20 margin-bottom-10">
                                <h3 class="titulo_form">
                                    Redes Sociais
                                </h3>
                            </div>


                            <?php if ($configuracoes['redes_social'] != '') : ?>
                                <!-- redes sociais -->
                                <div class="col-12 margin-bottom-10">
                                    <div class="wrap_contato_redes_sociais">
                                        <h6> Nos acompanhe nas redes sociais</h6>

                                        <div class="container_rede_social">
                                            <?php 
                                            $title = "Rede Social";
                                            if(isset($configuracoes['campo_custom1'])) {
                                                $title = $configuracoes['campo_custom1'];
                                            }
                                            
                                            foreach($configuracoes['redes_social'] as $item):
                                            ?>
                                            <a aria-label="<?=$title?>" class="link-social" target="_blank" href="<?= $item['url_imagem_conteudo'] ?>">
                                                <img class="lazyload" loading="lazy" src="<?= $item['caminho_imagem_conteudo'] ?>" width="39" height="39" alt="<?=$title?>" border="0" />
                                            </a>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- redes sociais -->
                            <?php endif ?>

                        </div>

                    </div>
                </div>
                <!-- END COL CONTATOS -->
                
                
                <!-- COL CONTATOS -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 margin-top-20 margin-bottom-30">
                    <!-- FORM -->
                    <div class="box_contato back_secundario">

                        <h3 class="titulo_form margin-bottom-20 color_titulo">
                            Localização
                        </h3>
                        
                        <div class="wrap_mapa_iframe">
                            <?=IFRAMA_MAPA?>
                        </div>

                    </div>
                    <!-- END FORM -->
                </div>
                <!-- END COL CONTATOS -->
                
            </div>

            <div class="row">
                <div class="col-xs-12 margin-top-20">&nbsp;</div>
            </div>
            
        </div>
    </section>
    <!-- END SECTION FALE CONOSCO -->
    

    <!-- DEPOIMENTOS -->
    <?php if(!empty($depoimentos) && PAGE_SPEED_100 == true){ ?>
        <section id="partial_depoimentos" class="">
            <div class="container-fluid margin-bottom-60 ">

                <div class="row">
                    <div class="col-12 margin-top-40">
                        <h2 class="titulo-depoimentos text-center color_titulo"><?= $titulo_depoimentos ?></h2>
                    </div>
                </div>

                <?php $render('sections/carrossel-depoimentos', ['depoimentos' => $depoimentos]) //chamo os depoimentos ?>

            </div>
        </section>
    <?php } ?>
    <!-- END DEPOIMENTOS -->
    

    <?php $render('footer/footer', $configuracoes) //html do footer ?>
    <?php $render('comum/whatsapp', $configuracoes); //inclui o botão do whatsapp ?>
    
    <?php 
    // Se for pagespeed eu nao mostro os scripts
    if (PAGE_SPEED_100) : 
        ?>
        <?php $render('scripts/scripts-footer', $script) //scripts do banco do cms ?>
        <?php $render('footer/footer-import', $script) //comum do footer ?>

        <!-- IMPORTACAO PARTIALS -->
        <script src="<?= $base ?>assets/lib/slick-1.8.1/slick/slick.min.js?v=<?= VERSAO ?>"></script>   
        <script src='https://www.google.com/recaptcha/api.js'></script> 
        <script src="<?= $base ?>assets/js/partials/carrossel-depoimentos.js?v=<?= VERSAO ?>"></script>

        <!-- IMPORTACAO DA PAGINA -->
        <script src="<?= $base ?>assets/js/contato/contato.js?v=<?= VERSAO ?>"></script>
        
        <?php 
        //END - Se for pagespeed eu nao mostro os scripts
        endif 
    ?>
</body>
</html>