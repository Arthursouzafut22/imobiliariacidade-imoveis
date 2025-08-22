<?php
$mensagem_whatsapp =  isset($mensagem_whatsapp) ? $mensagem_whatsapp : MENSAGEM_WHATSAPP_PADRAO;

if (MULTIPLOS_WHATSAPP == false) {
    $telefone_tratado = preg_replace('/[^0-9]/', '', TELEFONE_WHATSAPP);
    $hrefWhatsApp = 'https://api.whatsapp.com/send?phone=55' . $telefone_tratado . '&text=' . $mensagem_whatsapp . '';
} else {
    $hrefWhatsApp = "";
}
?>
<?php if (MULTIPLOS_WHATSAPP == false) { ?>
    <a id="btn-whats" href="<?= $hrefWhatsApp ?>" target="_blank" class="float">
        <img class=" my-float img-whats" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp">
    </a>
<?php } ?>

<?php if (MULTIPLOS_WHATSAPP == true) { ?>
    <a id="btn-whats" target="_blank" class="float">
        <img class=" my-float img-whats" src="<?= $base ?>assets/icons/redes-sociais/icon-whatsapp-branco.svg" width="34" height="35" alt="WhatsApp">
    </a>
    <div class="container-whatsapp">
        <div class="header">
            <span>WhatsApp</span>
            <button class="close-modal-whats">
                <img src="<?= $base ?>assets/images/mapa/close.svg" alt="botão close" />
            </button>
        </div>
        <div class="container-modal">
            <a target="_blank"
                href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', TELEFONE_WHATSAPP) ?>&text=<?= isset($mensagem_whatsapp) ? $mensagem_whatsapp  : MENSAGEM_WHATSAPP_PADRAO ?>">
                <button class="btn-modal-whats">
                    <span><?= TELEFONE_WHATSAPP ?> - Venda</span>
                </button>
            </a>
            <a target="_blank"
                href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', TELEFONE_WHATSAPP) ?>&text=<?= isset($mensagem_whatsapp) ? $mensagem_whatsapp  : MENSAGEM_WHATSAPP_PADRAO ?>">
                <button class="btn-modal-whats">
                    <span><?= TELEFONE_WHATSAPP ?> - Aluguel</span>
                </button>
            </a>
            <a target="_blank"
                href="https://api.whatsapp.com/send?phone=55<?= preg_replace('/[^0-9]/', '', TELEFONE_WHATSAPP) ?>&text=<?= isset($mensagem_whatsapp) ? $mensagem_whatsapp  : MENSAGEM_WHATSAPP_PADRAO ?>">
                <button class="btn-modal-whats">
                    <span><?= TELEFONE_WHATSAPP ?> - Unidade</span>
                </button>
            </a>
        </div>
    </div>
<?php } ?>

<div class="container-mansagem">
    <span class="mensagem-alert"></span>
</div>