function carregaGaleria() {
    //se tiver alguma imagem para carregar
    if($(".galeria_completa a img.loadimage").length > 0) {

        //transformo todas as imagens para serem carregadas em imagens de fato
        $(".galeria_completa a img.loadimage").each(function( index ) {
            let src = $(this).attr("data-src");
            $(this).attr("src", src).removeAttr("data-src").removeClass("loadimage");
        });
    }
}

$(document).ready(function() {
    
    //trata a ultima imagem da galeria para receber o botao mais fotos
    if(parseInt($("#cont-fotos").attr("data-totalfotos")) > 7) {

        let src_img = $(".galeria-vs2 li").last().find("img").attr("src");
        $(".galeria-vs2 li").last().append(
        "<div class='img_galeria_vs2' >" +
            "<div class='background_ultima_imagem'>" +
                "<a class='botao_ver_mais_fotos'>Ver mais fotos</a>" +
            "</div>" +
            "</div>");
        $(".galeria-vs2 li").last().css("background-image", "url('" + src_img + "')")
        $(".galeria-vs2 li").last().css("background-size", "cover")

        // removo essa classe da ultima imagem pra nao abrir 2x
        $(".galeria-vs2 li").last().removeClass("open_foto_sel"); 
        
        //removo a ultima imagem e uso um background com um botao de 
        $(".galeria-vs2 li").last().find("img").remove();
    }
    
    
    //quando clicar em uma foto especifica
    $(".open_foto_sel").click(function() {
      
        carregaGaleria();
        let indexador = $(this).attr("data-index");
        $(".galeria_completa a[data-index='"+indexador+"']").click();
    });
    

    $(".fancybox-stage").click(function() { 
        $(".fancybox-button--close").click();
    });

    //se for mobile celular
    if($(document).width() <= 600) {
        let largura_foto    = $(".galeria-vs2 li img").first().width();
        let altura_foto     = $(".galeria-vs2 li img").first().height();
        let caminho_foto    = $(".galeria-vs2 li img").first().attr("src");
        
        $(".galeria-vs2 li img").first().remove();
        $(".galeria-vs2 li").first().append(
        '<div class="img_capa_mobile" style="min-height:'+altura_foto+'px;">'+
            '<div class="open_galeria_completa back_img_capa_mobile" style="min-height:'+altura_foto+'px;">' +
                '<button>Ver fotos do imóvel</button>' +
            '</div>' +
            '</div>');
         $(".galeria-vs2 li").first().css("background-image", "url('" + caminho_foto + "')");
        $(".botao_ver_mais_fotos_mobile").css("display", "none");
    }

});

//quando clicar em um botao para abrir a galeria completa
$(document).on("click", ".open_galeria_completa",function() {
    carregaGaleria();
    $(".galeria_completa a[data-index='0']").first().click();
});

//quando clicar em um botao para abrir a galeria completa
$(document).on("click", ".botao_ver_mais_fotos",function() {
    carregaGaleria();
    $(".galeria_completa a[data-index='0']").first().click();
});

