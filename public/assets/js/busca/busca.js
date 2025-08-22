
$('#abrir-filtro').click(function () {
    $('.modal-form').addClass('modal-form-active');
});

$('.buttom-x-menu').click(function () {
    $('#lista-endereco').empty();
    $('.modal-form').removeClass('modal-form-active');
})

$('.btn-buscar').click(function () {
    $('.modal-form').removeClass('modal-form-active');
})

$('.modal-form').click(function (e) {

    if (e.target != this) return;
    $(this).css('display', 'none');
});


$('.btn-favorite').click(function () {
})

//Fecha lista de endereços no mobile
$('#close-list-endereco').click(function () {
    $('.container-list-endereco').css('display', 'none');
})


$('#input_valor_min').mask("###.###.##0,00", { reverse: true });
$('#input_valor_max').mask("###.###.##0,00", { reverse: true });

// $('#input_area_min').mask("000000,00", { reverse: true });
// $('#input_area_max').mask("000000,00", { reverse: true });

$('#input_area_min').mask("########.00", { reverse: true });
$('#input_area_max').mask("########.00", { reverse: true });



$("#result-busca-map").scroll(function () {

    // console.log( $(this)[0].scrollHeight);
    // console.log($(this).get(0).scrollHeight);
    // console.log(Math.abs($(this).scrollTop));

    if ($(this).scrollTop() + $(this).height() == $(this)[0].scrollHeight) {
        // a rolagem chegou ao fim, fazer algo aqui.

        let numberImovel = codpaginacao.split(',');

        if (numberImovel.length < 20) {
            return false;
        }

        carregarCodigosPaginacao(imovel.numeropagina++);

    }
});


function retornarImoveisPeloCoigo(codigos) {

    if (codigos == '') {
        retornarImoveisDisponiveis();
        return false;
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-imoveis-codigo', //ImovelController
        async: true,
        data: {
            'codigo': codigos,
            'pagina': 1
        },
        beforeSend: function () {
            $('.modal-loader').css('display', 'flex');
            $('#container_resultado_listagem_imoveis').empty();
        }

    }).fail(function () {
        console.log("error ao carregaso  favoritos");
    }).done(function (imovel) {

        let url = window.location.href;
        let finalidadeAtual = url.includes("/venda") ? "venda" : url.includes("/aluguel") ? "aluguel" : null;
        let finalidadeImovel = imovel.lista[0].codigofinalidade == 1 ? 'aluguel' : 'venda'

        if (finalidadeAtual && finalidadeAtual !== finalidadeImovel) {
            url = url.replace(`/${finalidadeAtual}`, `/${finalidadeImovel}`);

            history.replaceState(null, "", url); // Atualiza a URL sem reload

            //ATUALIZAÇÃO DO FORMULARIO FINALIDADE
            if (finalidadeImovel == 'comprar' || finalidadeImovel == 'venda') {
                $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');
                $(".btn-venda").addClass('btn-active-busca');

            } else if (finalidadeImovel == 'aluguel' || finalidadeImovel == 'locacao') {

                $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');
                $(".btn-aluguel").addClass('btn-active-busca');

            }
        }

        if (imovel.quantidade == 0) {
            $('.texto-topo-busca').text('Nenhum imóvel encontrado com o código: ' + codigos);
        } else {
            $('.texto-topo-busca').text('Lista de imóveis de acordo com os códigos informados');
        }

        $('.container-alert').css('display', 'none');
        $('#texto-topo-busca').text(imovel.quantidade);



        let fav = Object.values(imovel.favoritos);
        imovel.favoritos = fav;

        $('.cont-fav').text(imovel.favoritos.length);

        //ATUALIZAR FAVORITOS QUANDO CARREGAR A PAGINA
        $('#cont-fav').text(imovel.favoritos.length);

        $.each(imovel.favoritos, function (key, f) {

            $.each(imovel.lista, function (key2, imoveis) {

                if (imovel.favoritos[key] == imoveis.codigo) {

                    imovel.lista[key2].favoritos = true;
                } else {
                    imovel.lista[key2].favoritos = false;
                }

            });
        });

        let codigosEncontrados = '';

        $.each(imovel.lista, function (key, imo) {

            let itemImovel = retornarCardImovel(imo);
            $('#container_resultado_listagem_imoveis').append('<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 wrap_card_imovel" data-local="1">' + itemImovel + '</div>');
        });

        $('#input_codigo').val(codigosEncontrados.slice(0, -1));

    }).then(function () {

        $('.modal-loader').css('display', 'none');


    }).always(function () {
    });
}


// Adiciona o evento ao document ou container pai
// $(document).on('click', '.meuLink', function(event) {
//     event.preventDefault(); // Impede o redirecionamento

//     let imovelEmpreendimento = $(this).attr('data-empreendimento');

//     if(imovelEmpreendimento == '1' && $('#EXIBIR_LACAMENTO_EM_MODAL').val() == 1){
//         retornarImoveisEmpreendimentosFilhosDisponiveis($(this).attr('data-codigo-mae'))
//     }else{

//         window.location.href = $(this).attr('href');
//     }
// });



// Adiciona o evento ao document ou container pai
$(document).on('click', '.meuLink', function (event) {

    debugger;
    // Verifica se o clique foi em uma seta, e não no link
    if ($(event.target).closest('.seta_img').length) {
        return; // Não faz nada, permite a navegação do carrossel
    }

    event.preventDefault(); // Impede o redirecionamento normal

    let imovelEmpreendimento = $(this).attr('data-empreendimento');

    if (imovelEmpreendimento == '1' && $('#EXIBIR_LACAMENTO_EM_MODAL').val() == 1) {
        retornarImoveisEmpreendimentosFilhosDisponiveis($(this).attr('data-codigo-mae'));
    } else {
        window.location.href = $(this).attr('href'); // Redireciona normalmente
    }
});
