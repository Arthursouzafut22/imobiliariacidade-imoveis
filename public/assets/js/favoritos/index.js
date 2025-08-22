function favoritar(codigo) {
    
    if ($('#icon-favoritos-' + codigo).hasClass('card-favoritos-ativo')) {

        // REMOVER O FAVORITOS

        //CARD NORMAL
        $('#icon-favoritos-' + codigo).removeClass('card-favoritos-ativo');
        $('#icon-favoritos-' + codigo).attr('src', retornarVariavelLocal() + 'assets/icons/icon-favorito.svg');

        $.ajax({
            method: "POST",
            url: retornarVariavelLocal() + 'removerFavoritos', //ImovelController
            async: true,
            data: { codigo: codigo },
            beforeSend: function (d) {

            }

        }).done(function (dados) {

            dados = Object.values(dados);

            $('.cont-fav').text(dados.length);

            //            if (dados.length == 0) {
            //                $('#mensagem-favoritos').css('display', 'block');
            //            }


            var cont = 0;
            $.each(dados, function (key, f) {
                cont = parseInt(key) + 1;
            });

            //$('#icon-favoritos-' + codigo).parent().parent().parent().remove();

            mostrarMensagem('Imóvel ' + codigo + ' removido dos favoritos');

        }).fail(function () {

            console.log("error");

        }).always(function () {

        });

    } else {

        // ADICIONAR O FAVORITOS
        $('#icon-favoritos-' + codigo).addClass('card-favoritos-ativo');
        $('#icon-favoritos-' + codigo).attr('src', retornarVariavelLocal() + 'assets/icons/icon-favorito-ativo.svg');

        $.ajax({
            method: "POST",
            url: retornarVariavelLocal() + 'addFavoritos', //ImovelController
            async: true,
            data: { codigo: codigo },
            beforeSend: function (d) {

            }

        }).done(function (dados) {

            dados = Object.values(dados);

            $('.cont-fav').text(dados.length);

            $('.heading-icon').text(dados.length);

            var cont = 0;
            $.each(dados, function (key, f) {
                cont = parseInt(key) + 1;
            });

            //            $('#cont-fav').text(cont);
            mostrarMensagem('Imóvel ' + codigo + ' adicionado ao favoritos','success');

        }).fail(function () {

            console.log("error");

        }).always(function () {

        });

    }

}


function carregarImoveis() {

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-favoritos', //ImovelController
        async: true,
        data: {},
        beforeSend: function () {
            $('#id-gif').show();
            $('#container-gif').show();

            //LIMPA TODOS OS IMOVEIS
            $('#container-favoritos').empty();
        }

    }).fail(function () {

         ;

    }).done(function (dados) {
            

        if (dados.favoritos == 0) {

            $('.cont-fav').text(0);
            $('#container-gif').hide();
            $('#container-erro').css('display', 'block');

            let alert = 
            '<div class="container-alert">' +
                '<div class="alert-imoveis">' +
                    '<span>Não há imóvel favoritados </span></br>' +
                '</div>' +
            '</div>';

            $('#container-favoritos').append(alert);

            return false;
        }

        imoveis_busca = dados;

        //ATUALIZA O TORAL DE IMOVEIS DA DIV
        $('.cont-fav').text(imoveis_busca.quantidade);

        $.each(imoveis_busca.favoritos, function (key, f) {

            $.each(imoveis_busca.lista, function (key2, imoveis) {
                if (imoveis_busca.favoritos[key] == imoveis.codigo) {

                    imoveis_busca.lista[key2].favoritos = true;
                }
            });
        });


        $.each(imoveis_busca.lista, function (key, imo) {

            let itemImovel = retornarCardImovel(imo);
        
            $('#container-favoritos').append('<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 wrap_card_imovel">'+itemImovel+'</div>');
        });
    }).then(function () {

        $('#container-gif').hide();

    }).always(function () {
        
        $('#container-gif').hide();
        // setTimeout(function(){ $('.property').css('visibility', 'visible'); }, 1000);
    });

}

 carregarImoveis();

$('#buscar-favoritos').click(function () {
    window.location.href = retornarVariavelLocal() + 'venda/';
});



