<div id="carrossel_empreendimentos">
    <?php foreach ($banners_carrossel as $banner): ?>
        <div class="contain-img">
            <a target="_blank" href="<?= $banner['url_imagem_conteudo'] != null ? $banner['url_imagem_conteudo'] : "" ?>">
                <img class="img_carrossel_desktop" loading="lazy" src="<?= $banner['caminho_imagem_conteudo'] ?>"
                    alt="Banner Home Page" width="1400px" height="350px" border="0" />
            </a>
        </div>
    <?php endforeach ?>
</div>
<!-- 
<div class="marcadores-blog margin-top-10">
    <div class="slick-slider-dots slick-slider-dots-banners"></div>
</div> -->

<div class="container-setas">
    <div class="arrow-lef-empreendimento arrow_circle seta_left_empreendimento">
        <span class="carousel_setinha">‹</span>
    </div>
    <div class="arrow-right-empreendimento arrow_circle seta_right_empreendimento">
        <span class="carousel_setinha">›</span>
    </div>
</div>