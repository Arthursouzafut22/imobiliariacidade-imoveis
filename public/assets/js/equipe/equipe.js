//quando clicar no botao saiba mais
$('.btn_saber_mais').click(function () {
    debugger;

    // pego o codigo conteudo
    let codconteudo = $(this).attr('data-codconteudo');

    //faz o ajax
    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-detalhes-colaborador', // ImovelController
        async: true,
        data: {'codconteudo' : codconteudo},
        beforeSend: function () {
        }
    }).done(function (dados) {
        debugger;
        
        if(dados.caminho_imagem_conteudo != undefined) {
            $(".wrap_imagem").html("").html('<img id="img_modal" src="' + dados.caminho_imagem_conteudo + '" border="0" class="lazyload">');
        }

        $(".modal-title").html(dados.campo_custom1 != undefined ? dados.campo_custom1 : "");

        $(".wrap_dados_colaborador").html("");
        $(".wrap_dados_colaborador").append((dados.campo_custom1 != undefined ? '<span>' + dados.campo_custom1 + '</span><br/>' : ""));
        $(".wrap_dados_colaborador").append((dados.campo_custom2 != undefined ? '<span>' + dados.campo_custom2 + '</span><br/>' : ""));
        $(".wrap_dados_colaborador").append((dados.campo_custom3 != undefined ? '<span>' + dados.campo_custom3 + '</span><br/>' : ""));
        $(".wrap_dados_colaborador").append((dados.campo_custom4 != undefined ? '<span>' + dados.campo_custom4 + '</span><br/>' : ""));
        $(".wrap_dados_colaborador").append((dados.campo_custom5 != undefined ? '<span>' + dados.campo_custom5 + '</span><br/>' : ""));

        $(".wrap_descricao_colaborador").html(nl2br(dados.descricao_imagem_conteudo != undefined ? dados.descricao_imagem_conteudo : ""));

        $('#exampleModal').modal('show');

    });
});

$('#fechar-modal').click(function(){
    $('#exampleModal').css('display','none');
    $('#exampleModal').modal('hide');
});

$('.close').click(function(){
    $('#exampleModal').css('display','none');
    $('#exampleModal').modal('hide');
});



