<nav id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">

                    <a class="navbar-brand" href="<?= $base ?>">
                        <img class="logo-principal float-left lazyload" src="<?= $logo ?>"
                            alt="<?= IMOBILIARIA ?> - Sua imobiliária <?= CIDADE ?>" width="150" height="34" border="0" />
                    </a>

                    <div id="navbarSupportedContent">
                        <ul class="nav p-2 ">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $base ?>venda/">COMPRAR</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $base ?>aluguel/">ALUGAR</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $base ?>anuncie-seu-imovel">
                                    ANUNCIAR MEU IMÓVEL
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $base ?>contato">CONTATO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $base ?>sobre">A ESTILO</a>
                            </li>
                            <li class="nav-item" hidden>
                                <a class="nav-link" href="<?= $base ?>blog">BLOG</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $base ?>nossa-equipe">NOSSO TIME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links-header" href="<?= $base ?>imoveis-favoritos">FAVORITOS <span class="cont-fav"></span>
                                    <span class="span-favoritos">
                                        <img id="icon-favoritos" class="lazyload" src="<?= $base ?>assets/icons/icon-favorito-ativo.svg" alt="" />
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links-header" target="_blank" href="<?= AREA_CLIENTE ?>">
                                ÁREA DO CLIENTE
                                </a>
                            </li>
                        </ul>
                        <button class="btn-menu-m" type="button" title="Menu">
                            <img src="<?= $base ?>assets/icons/icons-tema-<?= TEMA_STRING ?>/menu.svg" width="24" height="24" border="0" alt="Menu" />
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>


<!-- MENU PARA MOBILE -->
<div id="header_mobile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <?php if (AREA_CLIENTE != '') { ?>
                    <a target="_blank" href="<?= AREA_CLIENTE ?>" class="btn btn-primario-light">ÁREA DO CLIENTE</a>
                <?php } ?>
                <button id="header_mobile_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row body-1">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>">Home</a></li>
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>venda">Comprar</a></li>
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>aluguel">Alugar</a>
                            </li>
                            <li class="list-group-item"><a class="link-menu-m"
                                    href="<?= $base ?>anuncie-seu-imovel">Anunciar seu imóvel</a></li>
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>anuncie-seu-imovel">Cadastrar seu
                                    imóvel</a></li>
                            <li class="list-group-item"><a class="link-menu-m"
                                    href="<?= $base ?>condominios">Condomínios</a></li>
                            <li class="list-group-item"><a class="link-menu-m"
                                    href="<?= $base ?>ouvidoria">Ouvidoria</a></li>
                            <li class="list-group-item">
                                <a href="<?= $base ?>imoveis-favoritos">Favoritos <span class="cont-fav">0</span>
                                    <img src="<?= $base ?>assets/icons/icon-favorito-ativo.svg" id="icon-favoritos" class="lazyload" loading="lazy" alt="Favoritos" width="17" height="16" border="0" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="row body-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>sobre">Quem somos</a>
                            </li>
                            <!--<li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>nossa-equipe">Corretores</a></li>-->
                            <?php if (AREA_CLIENTE != '') { ?>
                                <li class="list-group-item"><a target="_blank" class="link-menu-m"
                                        href="<?= AREA_CLIENTE ?>">Área do cliente</a></li>

                                <li class="list-group-item"><a target="_blank" class="link-menu-m" href="#">Área do
                                        locatário</a></li>
                                <li class="list-group-item"><a target="_blank" class="link-menu-m" href="#">Área do
                                        proprietário</a></li>
                            <?php } ?>
                            <?php if ($blog != '') { ?>
                                <li class="list-group-item"><a target="_blank" class="link-menu-m" href="<?= $blog ?>" target="_blank">Blog</a></li>
                            <?php } ?>
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>contato">Contato</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <?php if ($email != '') : ?>
                            <div class="col-12 padding">
                                <a href="mailto:<?= $email ?>">
                                    <img class="lazyload img-menu" src="<?= $base ?>assets/icons/icon-email-preto.png" loading="lazy" width="70" height="70" border="0" />
                                    <span class='s-ddd'></span> <span class="s-tell"><?= $email ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($tel_fixo  != '') : ?>
                            <div class="col-12  padding">
                                <a href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo) ?>">
                                    <img class="lazyload img-menu" src="<?= $base ?>assets/icons/icon-phone.svg" loading="lazy" width="52" height="52" border="0" />
                                    <span class='s-ddd'></span> <span class="s-tell"><?= $tel_fixo ?></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($tel_celular != '') : ?>
                            <div class="col-12 padding">
                                <a href="https://api.whatsapp.com/send?phone=<?= preg_replace('/[^0-9]/', '', $tel_celular) ?>&text=Olá.">
                                    <img class="lazyload img-menu" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-dark.svg" loading="lazy" width="52" height="52" border="0" alt="WhatsApp" />
                                    <span class='s-ddd'></span> <span class="s-tell"><?= $tel_celular ?></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($tel_fixo_aluguel != '') : ?>
                            <div class="col-12  padding">
                                <a href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo_aluguel) ?>">
                                    <img class="lazyload img-menu" src="<?= $base ?>assets/icons/icon-phone.svg" loading="lazy" width="52" height="52" border="0" />
                                    <span class='s-ddd'></span>
                                    <span class="s-tell">
                                        <?= $tel_fixo_aluguel ?>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>