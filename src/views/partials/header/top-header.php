<div class="container-contato-top-header" <?= EXIBIR_CONTATO_NO_TOPO ? '': 'hidden'?>>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 info-contatos">
                <span class="header_barra_topo_color">CRECI: <?= $creci ?></span>
                <?php if ($tel_fixo != '') { ?>
                    <a target="_blank" href="tel:<?= preg_replace('/[^0-9]/', '', $tel_fixo) ?>"
                        class="card-inf header_barra_topo_color">
                        <i class="fa-solid fa-phone" style="height: 15px !important;"></i>
                        <span><?= $tel_fixo ?></span>
                    </a>
                <?php }
                ?>
                <?php if ($tel_fixo_venda != '') { ?>
                    <a target="_blank"
                        href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', $tel_fixo_venda) ?>&text=Olá."
                        class="card-inf header_barra_topo_color">
                        <i class="fa-brands fa-whatsapp"></i><span><?= $tel_fixo_venda ?></span>
                    </a>
                <?php }
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-end align-itens-center">
                <div class="container-social-top-header">
                    <?php foreach ($redes_social as $item): ?>
                        <a target="_blank" href="<?= $item['url_imagem_conteudo'] ?>">
                            <img class="lazyload" loading="lazy" src="<?= $item['caminho_imagem_conteudo'] ?>" width="39"
                                height="39"
                                alt="<?= $item['caminho_imagem_conteudo'] != null ? $item['caminho_imagem_conteudo'] : "" ?>" />
                        </a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>