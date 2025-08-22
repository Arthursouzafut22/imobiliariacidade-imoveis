<footer id="footer" class="back_footer_imovel footer_color <?= (isset($ocultar_footer) && $ocultar_footer == true) ? "d-none" : "" ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2" hidden>
                <img class="logo-footer lazyload" loading="lazy" src="<?= $logo_monocromatica ?>" alt="<?= $nome_imobiliaria ?> - Sua imobiliária <?= $nome_imobiliaria ?>" />
                <p><?= $txt_footer ?></p>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-3">
                <div class="row">
                    <div class="col-12">
                        <span class="titulo_footer">A <?= $nome_imobiliaria ?></span>
                    </div>
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="<?= $base ?>sobre">Quem Somos</a></li>
                            <li class="list-group-item"><a href="<?= $base ?>contato">Fale Conosco</a></li>
                            <!--<li class="list-group-item"><a href="<?= $base ?>nossa-equipe">Equipe</a></li>-->
                            <li class="list-group-item"><a href="<?= $base ?>nossa-equipe">Nossa equipe</a></li>
                            <li class="list-group-item"><a href="<?= $base ?>documentos">Documentos</a></li>
                            <li class="list-group-item"><a href="<?= $base ?>politica-privacidade">Política de Privacidade </a></li>


                            <?php if ($blog != '') { ?>
                                <li class="list-group-item"><a href="<?= $blog ?>" >Blog </a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
                <div class="row">
                    <div class="col-12">
                        <span class="titulo_footer">IMÓVEIS</span>
                    </div>
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="<?= $base ?>venda">Imóveis para comprar</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?= $base ?>aluguel">Imóveis para alugar</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?= URL_BUSCA_LANCAMENTOS ?>">Lançamentos</a>
                            </li>
                            <li class="list-group-item"><a href="<?= $base ?>condominios">Condomínios</a></li>
                            <li class="list-group-item"><a href="<?= $base ?>anuncie-seu-imovel">Anunciar seu imóvel</a></li>
                            <li class="list-group-item"><a href="<?= $base ?>imoveis-favoritos">Favoritos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
                <div class="row">
                    <div class="col-12">
                        <span class="titulo_footer">Cliente</span>
                    </div>
                    <div class="col-12">
                        <ul class="list-group list-group-flush">

                            <?php if (AREA_CLIENTE != '') { ?>
                                <li class="list-group-item"><a target="_blank" href="<?= AREA_CLIENTE ?>">Área do cliente</a></li>
                            <?php } ?>

                            <!--<li class="list-group-item"><a href="<?= $base ?>documentos">Documentos</a></li>-->
                            <li class="list-group-item"><a href="<?= $base ?>ouvidoria">Ouvidoria</a></li>
                            <li class="list-group-item"><a href="<?= $base ?>trabalhe-conosco">Trabalhe conosco</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <span class="titulo_footer">Baixe o App</span>
                        <div class="container-link-lojas">
                            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.imoviewareacliente&hl=pt_BR&gl=US"><img src="<?= $base ?>assets/images/home/google-play.png" /></a>
                            <a target="_blank"  href="https://apps.apple.com/br/app/imoview-cliente/id1542073604"><img src="<?= $base ?>assets/images/home/play_store.png" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
                <div class="row">
                    <div class="col-12">
                        <span class="titulo_footer">Trabalhe conosco</span>
                    </div>
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSfpoabBqZX3mHsksvaFbYOHbWBRZlXU9VLQr8szUEhXqOCzFQ/viewform">Corretor de Imóveis</a></li>
                            <li class="list-group-item"><a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSdCx8DguUgQi6h9tGhQ2ThGi96kaScSUClBBcP2Shapk9zdHg/viewform">Administrativo</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-3">
                <div class="row d-flex junstify-content-center align-item-center">
                    <div class="col-12">
                        <span class="titulo_footer">ATENDIMENTO</span>
                    </div>
                    <div class="col-12">
                        <a class="links-footer" href="mailto:<?= $email ?>">
                            <p><?= $email ?></p>
                        </a>
                        <p><?= $endereco ?></p>
                    </div>
                    <?php if ($tel_fixo != '') { ?>
                        <div class="col-12" style="padding: 0px">
                            <a class="links-footer" target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo) ?>">
                                <img class="lazyload mini_icon_rodape" loading="lazy" src="<?= $base ?>assets/icons/icon-phone-branco.svg" width="39" height="39" border="0" alt="Telefone" />
                                <span><?= $tel_fixo ?></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($tel_fixo_aluguel != '') { ?>
                        <div class="col-12" style="padding: 0px">
                            <a class="links-footer" target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_celular) ?>">
                                <img class="lazyload mini_icon_rodape" loading="lazy" src="<?= $base ?>assets/icons/icon-phone-branco.svg" width="39" height="39" border="0" alt="Telefone" />
                                <span><?= $tel_fixo_aluguel ?></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($tel_fixo_venda != '') { ?>
                        <div class="col-12" style="padding: 0px">
                            <a class="links-footer" target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo_venda) ?>">
                                <img class="lazyload mini_icon_rodape" loading="lazy" src="<?= $base ?>assets/icons/icon-phone-branco.svg" width="39" height="39" border="0" alt="Telefone" />
                                <span><?= $tel_fixo_venda ?></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($tel_celular != '') { ?>
                        <div class="col-12" style="padding: 0px">
                            <a class="links-footer" target="_blank" href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', $tel_celular) ?>&text=Olá.">
                                <img class="lazyload mini_icon_rodape" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" border="0" />
                                <span> <?= $tel_celular ?></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($tel_cel_aluguel != '') { ?>
                        <div class="col-12" style="padding: 0px">
                            <a class="links-footer" target="_blank" href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', $tel_cel_aluguel) ?>&text=Olá.">
                                <img class="lazyload mini_icon_rodape" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" border="0" />
                                <span> <?= $tel_cel_aluguel ?></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($tel_cel_venda != '') { ?>
                        <div class="col-12" style="padding: 0px">
                            <a class="links-footer" target="_blank" href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', $tel_cel_venda) ?>&text=Olá.">
                                <img class="lazyload mini_icon_rodape" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" border="0" />
                                <span> <?= $tel_cel_venda ?></span>
                            </a>
                        </div>
                    <?php } ?>

                </div>
                <div class="row">
                    <div class="col-12 margin-top-10 margin-bottom-10">
                        <span class="titulo_footer">redes sociais</span>
                    </div>
                    <div class="col-12">
                        <?php foreach ($redes_social as $item): ?>
                            <a <?= ($item['url_imagem_conteudo'] != 'blog' ? 'target="_blank"' : ''  )?>  href="<?= $item['url_imagem_conteudo'] ?>">
                                <img class="lazyload" loading="lazy" src="<?= $item['caminho_imagem_conteudo'] ?>" width="39" height="39" border="0" alt="<?= $item['caminho_imagem_conteudo'] != null ? $item['caminho_imagem_conteudo'] : "" ?>" />
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="text-copyright" class="row justify-content-between align-items-center">
            <p>© <?= date('Y') ?> | <?= $nome_imobiliaria ?> | CRECI: <?= $creci ?> | Desenvolvido por <a href="https://www.universalsoftware.com.br/" target="_blank"><b>Universal Software.</b></a></p>
            <!-- <span>Dev. responstavel: <?= NOME_DEV ?></span> -->
        </div>
    </div>

</footer>

<div class="container-mansagem">
    <span class="mensagem-alert">
        <!-- Mensagem de alerta -->
    </span>
</div>

<div class="container-mensagem-error">
    <span class="mensagem-alert-error">
        <!-- Mensagem de alerta -->
    </span>
</div>

<input type="hidden" name="captchaAtivo" id="captchaAtivo" value="<?= $captcha_ativo ?>">