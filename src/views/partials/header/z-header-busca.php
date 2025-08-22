<nav id="header" class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a href="<?= $base ?>" id="corpo-logo-principal" class="navbar-brand">
            <img class="logo-principal float-left img-webp" src="<?= $logo ?>" alt="<?= $nome_imobiliaria ?> - Sua imobiliária <?= CIDADE  ?>" />
        </a>
        <a href="<?= $base ?>" id="corpo-logo-principal-mini" class="navbar-brand">
            <img class="logo-principal float-left lazyload" src="<?= $base ?>assets/img/logo-mini.png" alt="<?= $nome_imobiliaria ?> - Sua imobiliária <?= CIDADE  ?>" />
        </a>
        <div id="corpo-filtro-top" >
            <input id="input-top" type="text" class="form-control form-text" placeholder="Rua, Bairro ou Cidade">
            <img class="icon-lupa-topo lazyload" src="<?= $base ?>assets/icons/icon-lupa.svg">
        </div>
        <div class="container-list-endereco">
            <div class="header">
                <span>Localização</span> 
                <div id="close-list-endereco">
                    <span class="botao_fechar_modal">✖</span>
                </div>
            </div>
            <ul id="lista-endereco-top" class="list-group"></ul>
        </div>
        <div class="justify-content-end" id="navbarSupportedContent">
            <ul class="nav align-content-end">
                <li class="nav-item">
                    <div class="btn-group">
                        <buttom class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">COMPRAR
                        </buttom>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= $base ?>venda/apartamento">Apartamentos</a>
                            <a class="dropdown-item" href="<?= $base ?>venda/casa">Casa</a>
                            <a class="dropdown-item" href="<?= $base ?>venda/terreno">Terreno</a>
                            <a class="dropdown-item" href="<?= $base ?>venda/loja">Lojas</a>
                            <a class="dropdown-item" href="<?= $base ?>venda">Todos os imóveis</a>
                        </div>
                    </div>

                </li>
                <li class="nav-item">
                    <div class="btn-group">
                        <buttom class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ALUGAR
                        </buttom>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= $base ?>aluguel/apartamento">Apartamentos</a>
                            <a class="dropdown-item" href="<?= $base ?>aluguel/casa">Casa</a>
                            <a class="dropdown-item" href="<?= $base ?>aluguel/terreno">Terreno</a>
                            <a class="dropdown-item" href="<?= $base ?>aluguel/loja">Lojas</a>
                            <a class="dropdown-item" href="<?= $base ?>aluguel/imovel">Todos os imóveis</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>anuncie-seu-imovel">
                        ANUNCIAR MEU IMÓVEL
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <div class="btn-group">
                        <buttom class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ANUNCIAR SEU IMÓVEIS
                        </buttom>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= $base ?>anuncie-seu-imovel">Apartamentos</a>
                            <a class="dropdown-item" href="<?= $base ?>anuncie-seu-imovel">Na Planta</a>
                            <a class="dropdown-item" href="<?= $base ?>anuncie-seu-imovel">Casa</a>
                            <a class="dropdown-item" href="<?= $base ?>anuncie-seu-imovel">Terreno</a>
                            <a class="dropdown-item" href="<?= $base ?>anuncie-seu-imovel">Todos os imóveis</a>
                        </div>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>anuncie-seu-imovel">ANUNCIAR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>contato">CONTATO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>sobre">SOBRE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>imoveis-favoritos">
                        <span class="span-favoritos">
                            <img id="icon-favoritos" class="lazyload" src="<?= $base ?>assets/icons/icon-favorito.svg" alt="" />
                        </span> 
                        FAVORITOS <span class="cont-fav">0</span>
                    </a>
                </li>
                <?php if (AREA_CLIENTE != '') { ?>
                    <a  target="_blank"  href="<?= AREA_CLIENTE ?>" target="_blank" class="btn btn-area-cliente">ÁREA DO CLIENTE</a>
                <?php } ?>
            </ul>
        </div>
        <button class="btn-menu-m" type="button">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</nav>

<div class="linha-divisoria-menu"></div>

<!-- MENU PARA MOBILE -->
<div id="header_mobile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php if (AREA_CLIENTE != '') { ?>
                    <a href="<?= AREA_CLIENTE ?>" class="btn btn-primario-light">ÁREA DO CLIENTE</a>
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
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>aluguel">Alugar</a></li>
                            <!-- <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>anuncie-seu-imovel">Cadastrar imóvel</a></li> -->
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>anuncie-seu-imovel">Cadastrar seu imóvel</a></li>
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>condominios">Condomínios</a></li>
                            <li class="list-group-item">
                                <a href="<?= $base ?>imoveis-favoritos">Favoritos <span class="cont-fav">0</span>
                                    <img id="icon-favoritos" class="lazyload" loading="lazy" src="<?= $base ?>assets/icons/icon-favorito-ativo.svg" alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="row body-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>sobre">Quem somos</a></li>
                            <!--<li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>nossa-equipe">Nosso time</a></li>-->
                            <?php if (AREA_CLIENTE != '') { ?>
                                <li class="list-group-item"><a class="link-menu-m" href="<?= AREA_CLIENTE ?>">Área do cliente</a></li>
                            <?php } ?>
                            <li class="list-group-item"><a class="link-menu-m" href="<?= BLOG ?>">Blog</a></li>
                            <li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>contato">Contato</a></li>
                            <!--<li class="list-group-item"><a class="link-menu-m" href="<?= $base ?>documentos">Documentos</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row">
                        <?php if ($configuracoes['email'] != '') : ?>
                            <div class="col-12 padding">
                                <a href="mailto:<?= $configuracoes['email'] ?>">
                                    <img class="lazyload img-menu" src="<?= $base ?>assets/icons/icon-email-preto.png" loading="lazy" />
                                    <span class='s-ddd'></span> <span class="s-tell"><?= $configuracoes['email'] ?></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ("<?= $tel_fixo ?>" != '') : ?>
                            <div class="col-12  padding">
                                <a href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo) ?>">
                                    <img class="lazyload img-menu" src="<?= $base ?>assets/icons/icon-phone.svg" loading="lazy" />
                                    <span class='s-ddd'></span> <span class="s-tell"><?= $tel_fixo ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>