<div class="row">
    <div class="col-12">
        <div class="container-btn">
            <button class="btn_recente_popular active-button">DESTAQUES</button>
            <button class="btn_recente_popular">RECENTES</button>
        </div>
    </div>
</div>

<div class="container-posts-recentes">
    <?php foreach ($posts_recentes as $key => $post): ?>
        <a href="<?= $base ?>blog/<?= $post['url_amigavel'] ?>/<?= $post['cod_pagina'] ?>">
            <div class="card-mini-post">
                <img src="<?= $post['caminho_imagem_conteudo'] ?>" alt="<?= $post['alt_imagem_conteudo'] ?>">
                <div class="contain">
                    <strong><?= $post['titulo_pagina'] ?></strong>
                    
                    <span><?= (strlen($post['subtitulo_pagina']) > 70 ? substr($post['subtitulo_pagina'], 0, 70) . '...' : $post['subtitulo_pagina']) ?></span>
                </div>
            </div>
        </a>
    <?php endforeach ?>
</div>

<div class="container-posts-populares posts_destaques_active">
    <?php foreach ($posts_destaques as $key => $post): ?>
        <a href="<?= $base ?>blog/<?= $post['url_amigavel'] ?>/<?= $post['cod_pagina'] ?>">
            <div class="card-mini-post">
                <img src="<?= $post['caminho_imagem_conteudo'] ?>" alt="<?= $post['alt_imagem_conteudo'] ?>">
                <div class="contain">
                    <strong>
                        <?= $post['titulo_pagina'] ?>
                    </strong>
                    
                    <span><?= (strlen($post['subtitulo_pagina']) > 70 ? substr($post['subtitulo_pagina'], 0, 70) . '...' : $post['subtitulo_pagina']) ?></span>
                    
                </div>
            </div>
        </a>
    <?php endforeach ?>
</div>



<div class="lista-categorias">
    <h5>Categorias</h5>
    <?php foreach ($cms_pagina_categoria as $key => $categoria): ?>
        <a href="<?= $base ?>blog?pagina=1&categoria=<?= $categoria['cod_pagina_categoria'] ?>">
            <div class="linha <?= ($categoria['cod_pagina_categoria'] == $categoria_selecionada ? 'active' : '') ?>">
                <span><?= $categoria['nome_pagina_categoria'] ?></span>
                <div class="number"><span><?= $categoria['paginas_count'] ?></span></div>
            </div>
        </a>
    <?php endforeach ?>

    <?php if ($categoria_selecionada != ''): ?>
        <a href="<?= $base ?>blog?pagina=1&categoria=">
            <button class="btn_limpar_filtro">
            <span>✖</span><span>Limpar filtro</span>
            </button>
        </a>
    <?php endif ?>

</div>