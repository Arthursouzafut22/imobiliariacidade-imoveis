<div class="modal-desktop">
    <div class="header">
        <button id="close-menu-modal">
            <span class="botao_fechar_modal">✖</span>
        </button>
    </div>
    <div class="container-lista-menu">
        <ul>
            <li class="list-titulo"><strong>Imóveis</strong></li>
            <li><a href="<?= $base ?>venda">Imóveis à venda</a></li>
            <li><a href="<?= $base ?>aluguel">Imóveis para alugar</a></li>
            <li><a href="<?= $base ?>condominios">Condomínios</a></li>
            <li><a href="<?= $base ?>anuncie-seu-imovel">Anunciar seu imóvel</a></li>
            <li><a href="<?= $base ?>imoveis-favoritos">Favoritos</a></li>
        </ul>

        <ul>
            <li class="list-titulo"><strong>Cliente</strong></li>
            <?php if (AREA_CLIENTE != '') { ?>
                <li><a target="_blank" href="<?= AREA_CLIENTE ?>">Área do locatário</a></li>
                <li><a target="_blank" href="<?= AREA_CLIENTE ?>">Área do proprietário</a></li>
            <?php } ?>
            <!--<li><a href="<?= $base ?>documentos">Documentos</a></li>-->
            <li><a href="<?= $base ?>ouvidoria">Ouvidoria</a></li>
        </ul>

        <ul>
            <li class="list-titulo"><strong>A <?= $nome_imobiliaria ?></strong></li>
            <li><a href="<?= $base ?>sobre">Quem Somos</a></li>
            <li><a href="<?= $base ?>contato">Fale Conosco</a></li>
            <li><a href="<?= LINK_TRABALHE_CONOSCO ?>">Trabalhe Conosco</a></li>
            <li><a href="<?= $base ?>nossa-equipe">Nossa equipe</a></li>
            <li><a href="<?= $base ?>documentos">Documentos</a></li>
            <?php if ($blog != '') { ?>
                <li><a href="<?= $blog ?>" target="_blank">Blog </a></li>
            <?php } ?>
            <li><a href="<?= $base ?>politica-privacidade">Política de Privacidade</a></li>
        </ul>

        <ul>
            <li class="list-titulo"><strong>Contatos</strong></li>
            <?php if ($tel_fixo != '') { ?>
                <li>
                    <a target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo) ?>">
                        <img class="" target="_blank" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" />
                        <span><?= $tel_fixo ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($tel_fixo_aluguel != '') { ?>
                <li>
                    <a target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo_aluguel) ?>">
                        <img class="" target="_blank" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" />
                        <span><?= $tel_fixo_aluguel ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($tel_fixo_venda != '') { ?>
                <li>
                    <a target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo_venda) ?>">
                        <img class="" target="_blank" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" />
                        <span><?= $tel_fixo_venda ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($tel_celular != '') { ?>
                <li>
                    <a target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_celular) ?>">
                        <img class="" target="_blank" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" />
                        <span><?= $tel_celular ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($tel_cel_aluguel != '') { ?>
                <li>
                    <a target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_cel_aluguel) ?>">
                        <img class="" target="_blank" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" />
                        <span><?= $tel_cel_aluguel ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($tel_cel_venda != '') { ?>
                <li>
                    <a target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_cel_venda) ?>">
                        <img class="" target="_blank" loading="lazy" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp" />
                        <span><?= $tel_cel_venda ?></span>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a target="_blank" href="mailto:<?= $email ?>">
                    <img class="" target="_blank" loading="lazy" src="<?= $base ?>assets/icons/icon-email-branco.svg" width="34" height="35" alt="E-mail" />
                    <span><?= $email ?></span>
                </a>
            </li>
        </ul>
    </div>

</div>