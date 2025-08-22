<div class="row">
    <div class="col-12 margin-top-20">
        <div id="carrossel_blog" class="d-flex justify-content-center">

            <?php foreach ($carrossel_blog as $key => $item_blog): ?>
            <div class="container_card_blog">
                <div class="container_date">
                    <div class="container_date_dia">
                        <span><?=$item_blog['campo_custom3']?></span>
                    </div>
                    <div class="container_date_mes">
                        <span><?=$item_blog['campo_custom4']?></span>
                    </div>
                </div>
                <a href="<?=BASE_URL."blog/".$item_blog['url_pagina']."/".$item_blog['cod_pagina']?>">
                    <div class="card_blog">
                        <img class="img_blog" src="<?=$item_blog['caminho_imagem_conteudo']?>" alt="<?= $item_blog['alt_imagem_conteudo'] ?>" loading="lazy" />
                        <div class="card_body_blog">
                            <strong class="title_blog">
                                <?=$item_blog['titulo_pagina']?> 
                            </strong>
                            <p>
                            <span><?= (strlen($item_blog['subtitulo_pagina']) > 70 ? substr($item_blog['subtitulo_pagina'], 0, 70) . '...' : $item_blog['subtitulo_pagina']) ?></span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach;?>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 margin-bottom-20">
        <div class="marcadores-blog">
            <div class="slick-slider-dots slick-slider-dots-blog"></div>
        </div>
    </div>
</div>