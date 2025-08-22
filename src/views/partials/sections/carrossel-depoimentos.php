<!--<div class="row">
    <div class="col-12 margin-top-20 margin-bottom-30">
        <div class="d-flex justify-content-center">
            <img id="anterior-depoimento" class="lazyload mr-1" loading="lazy" data-src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-seta-depoimento-proximo.svg" />
            <img id="proximo-depoimento" class="lazyload ml-1" loading="lazy" data-src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-seta-depoimento-anterior.svg" />
        </div>
    </div>
</div>

                
-->


<div class="row">
    <div class="col-12 margin-top-20 margin-bottom-30">
        <div class="d-flex justify-content-center">

            <div id="anterior-depoimento" class="arrow_circle">
                <span class="carousel_setinha">‹</span>
            </div>
            <div id="proximo-depoimento" class="arrow_circle">
                <span class="carousel_setinha">›</span>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div id="carrossel-depoimentos">
            <?php foreach ($depoimentos as $key => $item) : ?>
                <div>
                    <img class="icon-aspas lazyload" loading="lazy" data-src="<?= $base ?>assets/icons/icons-tema-<?=TEMA_STRING?>/icon-aspas-depoimentos.svg" />
                    
                    <span class="color_texto"><?= nl2br($item['descricao_imagem_conteudo']) ?></span>

                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="card-foto color_texto">
                            <img class="img-perfil" src="<?= $item['caminho_imagem_conteudo'] ?>" />
                            <div class="containe">
                                <strong class="nome-depoimentos"><?= $item['campo_custom1'] ?></strong><br/>
                                <span class="profissao-depoime"><?= $item['campo_custom2'] ?></span>
                            </div>
                        </div>
                    </div>                    
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>