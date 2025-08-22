
//VARIAVEIS PARA BUSCA LIVRE
var obj_cidade = {};
obj_cidade.cidade = REGIAO_LOCALIZACAO_BASE;
obj_cidade.cod_cidade = 0;
obj_cidade.nome_amigavel = REGIAO_LOCALIZACAO_BASE_URL;

var obj_bairro = {};
obj_bairro.nome = 'todos-os-bairros';
obj_bairro.cod_bairro = 0;
obj_bairro.nome_cidade = REGIAO_LOCALIZACAO_BASE_URL;
obj_bairro.nome_amigavel = 'todos-os-bairros';

var obj_endereco = {};

obj_endereco.nome = null;
obj_endereco.cod_bairro = null;
obj_endereco.cod_cidade = null;

var finalidade = 2;
let localizacao = {};

function removerPlus(str) {
    // Expressão regular para encontrar os caracteres "+" no início ou no fim da string
    var regex = /^\+|\+$/g;

    // Use o método replace() para substituir os caracteres "+" por uma string vazia
    return str.replace(regex, '');
}

//ACAO DA LISTA
function getCidade() {

    obj_cidade.cidade = $(this).text();
    obj_cidade.cod_cidade = $(this).attr('cod_cidade');
    obj_cidade.nome_amigavel = $(this).attr('nome_amigavel');
    $('#endereco').val(obj_cidade.cidade);
    $('#lista-endereco').empty();

    imovel.codigocidade = obj_cidade.cod_cidade;


    //zerar os bairros
    obj_bairro.nome = 'todos-os-bairros';
    obj_bairro.cod_bairro = 0;
    obj_bairro.nome_cidade = 'todas-as-cidades';
    obj_bairro.nome_amigavel = 'todos-os-bairros';

}

//ACAO DA LINHA DE BAIRROS
// function getBairros() {

//     obj_bairro.nome = $(this).text();
//     obj_bairro.cod_bairro = $(this).attr('cod_bairro');
//     obj_bairro.nome_amigavel = $(this).attr('nome_amigavel');
//     obj_bairro.nome_origianl = $(this).attr('nome_origianl');
//     obj_bairro.nome_cidade = $(this).attr('nome_cidade');
//     $('#endereco').val(obj_bairro.nome);
//     $('#lista-endereco').empty();

//     obj_cidade.nome_amigavel = $(this).attr('nome_cidade');

// }

function getBairrosApi() {

    if (imovel.codigocidade != '0') {

        $.ajax({
            method: "POST",
            url: retornarVariavelLocal() + 'retornar-bairros-disponiveis', //ImovelController
            async: true,
            data: imovel,
            beforeSend: function () {
                $('.lista-bairros ul').empty();
                $('#input-bairro').parent().css("opacity", '0.5').css('cursor', 'not-allowed');
            }
        }).done(function (bairros) {

            $.each(bairros.lista, function (key, bairro) {

                let option = '<li><input id="' + bairro.urlAmigavel + '" type="checkbox" class="check-box-bairros" value="' + bairro.urlAmigavel + '"><label for="' + bairro.urlAmigavel + '">' + bairro.nomebairro + '</label></li>';
                option = $(option).click(function () {
                    // Suponha que o contêiner tenha a classe "container"
                    var quantidadeBairrosMarcados = $('.lista-bairros input[type="checkbox"]:checked').length;
                    $('.cont-bairro').text(quantidadeBairrosMarcados);
                });

                $('.lista-bairros ul').append(option);
            });

        }).then(function () {

            $('.lista-bairros').css('display', 'block');
            $('#input-bairro').parent().css("opacity", '1').css('cursor', 'pointer');


        }).always(function () {
        });
    }
}

$('#cidade').change(function () {
    obj_cidade.cidade = $(this).val();
    $('#cidade option').each(function (cont, city) {
        if ($(city).attr('url') == obj_cidade.cidade) {
            obj_cidade.cod_cidade = $(this).attr('id-cidade');
            obj_cidade.nome_amigavel = $(this).attr('url');
        }
    })


    $('#lista-endereco').empty();

    //zerar os bairros
    obj_bairro.nome = 'todos-os-bairros';
    obj_bairro.cod_bairro = 0;
    obj_bairro.nome_cidade = 'todas-as-cidades';
    obj_bairro.nome_amigavel = 'todos-os-bairros';

    $('#lista-bairros-selecionados').empty();

    $('.count-bairros').text(0);
    obj_bairro = {};

    //Alterad o codigo da cidade padrão.
    imovel.codigocidade = obj_cidade.cod_cidade;

    //limpar quando nao estiver selecionado
    if ($(this).val() == 'todas-as-cidades') {
        $('.lista-bairros ul').empty();
    }

    getBairrosApi();

    $('.cont-bairro').text(0)
})

var $listaBairros = $('.lista-bairros');
var $btnToggle = $('.btn-toggle');

// Função para alternar a visibilidade da lista de bairros
$btnToggle.on('click', function (e) {

    if ($('.lista-bairros ul li').length == '0') {
        mostrarMensagem('Selecione uma Cidade para carregar os Bairros.'); //alertError
    }

    $listaBairros.toggle();
    e.stopPropagation(); // Previne que o clique se propague para o document
});

// Função para fechar a lista de bairros ao clicar fora dela
$(document).on('click', function (e) {
    if (!$listaBairros.is(e.target) && $listaBairros.has(e.target).length === 0 && !$btnToggle.is(e.target)) {
        $listaBairros.hide();
    }
});

// Impede que cliques dentro da lista de bairros fechem a lista
$listaBairros.on('click', function (e) {
    e.stopPropagation();
});

//ACAO DA LINHA DE ENDERECO
function getEndereco() {

    obj_endereco.nome = $(this).text();
    obj_endereco.cod_bairro = $(this).attr('cod_bairro');
    obj_endereco.cod_cidade = $(this).attr('cod_cidade');
    $('#endereco').val(obj_endereco.nome);
    $('#lista-endereco').empty();

}

$('#tipo').change(function () {

    if ($("#endereco").val() != '') {

        let splitWords = $("#endereco").val().split(" ");
        let firstWord = splitWords[0].toLowerCase();
        carregarEndereco(firstWord);
    }

});

function carregarEndereco(endereco) {

    //     SE FOR NUMERO INTERROMPE
    if (!isNaN(endereco)) {

        return false;
    }

    if (endereco.length < 3) {

        $('#lista-endereco').empty();

        return false;

    } else {

        $('#label-endereco').text('DIGITE UMA LOCALIZAÇÃO');
    }

    let cod = endereco.split(',');

    if (!isNaN(cod[0])) {
        return false;
    }


    localizacao.finalidade = (finalidade == 1 ? 1 : 2);
    localizacao.localizacao = endereco;
    localizacao.opcaoImovel = 0;

    var tipos = $('#tipo');


    if (tipos.val() != 0) {

        $.each(tipos.children(), function (i, value) {

            if ($(tipos).val() == $(value).val()) {

                localizacao.codigoTipo = $(value).attr('id-tipo');
            }
        });
    } else {

        localizacao.codigoTipo = 0;
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-enderecos-disponiveis', //ImovelController
        async: true,
        data: localizacao,
        beforeSend: function () {

            $('#lista-endereco').empty();
            $('#lista-endereco').append('<li class="list-group-item"><b>Carregando...</b></li>');
        }
    }).done(function (dados) {

        $('#lista-endereco').empty();

        if (dados.cidades.length > 0) {

            $('#lista-endereco').append('<li class="list-group-item"><b class="text-list-top">Selecione uma Cidade</b></li>');

            $.each(dados.cidades, function (x, cidade) {

                let linhaCidade = $('<li>')
                    .addClass('list-group-item buttom-cidade')
                    .text(cidade.nome)
                    .attr('nome_amigavel', cidade.nome_amigavel)
                    .attr('cod_cidade', cidade.codigo)
                    .click(getCidade);

                $('#lista-endereco').append(linhaCidade);
            });
        }

        if (dados.bairros.length > 0) {
            $('#lista-endereco').append('<li class="list-group-item"><b class="text-list-top">Selecione um Bairro</b></li>');

            $.each(dados.bairros, function (x, bairro) {

                let linhaBairro = $('<li>')
                    .addClass('list-group-item buttom-cidade')
                    .text(bairro.nomebairro + ' - ' + bairro.nomecidade)
                    .attr('nome_amigavel', bairro.nome_amigavel)
                    .attr('nome_origianl', bairro.nomecidade)
                    .attr('nome_cidade', bairro.nome_amigavel_cidade)
                    .attr('cod_bairro', bairro.codigobairro)
                    .click(getBairros);

                $('#lista-endereco').append(linhaBairro);

            });
        }

        if (dados.enderecos.length == 0 && dados.cidades.length == 0 && dados.bairros.length == 0) {

            $('#lista-endereco').append('<li class="list-group-item" style="color:red"><b>Não temos ' + ($('#tipo').val()) + ' para ' + ($('#finalidade').val() == '1' ? 'alugar' : 'comprar') + ' em "' + $('#endereco').val() + '"</b></li>');

            $('#submit-busca').attr("disabled", true);

            //            $('#lista-endereco').append('<li class="list-group-item"><b>Endereço</b></li>');
            //
            //            $.each(dados.enderecos, function (x, endereco) {
            //
            //                let linhaEndereco = $('<li>')
            //                    .addClass('list-group-item buttom-cidade')
            //                    .text(endereco.endereco)
            //                    .attr('cod_cidade', fendereco.codigocidade)
            //                    .attr('cod_bairro', endereco.codigobairro)
            //                    .click(getEndereco);
            //
            //                $('#lista-endereco').append(linhaEndereco);
            //
            //            });
        } else {
            $('#submit-busca').attr("disabled", false);
        }

    }).then(function () {

        $('#label-endereco').text('DIGITE UMA LOCALIZAÇÃO');

    }).always(function () {

    });
}

var typingTimer;
$('#endereco').keyup(function () {
    //    carregarEndereco($(this).val());
    $('#lista-endereco').empty();
    $('#submit-busca').attr("disabled", false);
    clearTimeout(typingTimer);

    let = objEnd = $(this);

    if (objEnd.val()) {

        typingTimer = setTimeout(function () {
            carregarEndereco(objEnd.val());
        }, 1000);
    } else {
        $('#lista-endereco').empty();
    }
});

$('.btn-cond-form').click(function () {

    $('#container-cond').fadeToggle('slow');

    console.log($(this).text());

    if ($(this).text() == 'Encontrar condomínios') {

        $(this).text('Esconder condomínos');

    } else {

        $(this).text('Encontrar condomínos');
    }

});

$('.buttom_finalidade_busca_home').click(function () {

    $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');

    if ($(this).children().children().attr('data-campofinalidade') == 'alugar') {

        $(this).addClass('btn-active-busca');


        finalidade = 1;

        imovel.finalidade = 'aluguel';
        imovel.numeropagina = 1;
        imovel.numeroregistros = 20;
        imovel.opcaoimovel = 0;

        // $('.fild-hide').show();
        habilitarCampoParaLancamentos();

    } else if ($(this).children().children().attr('data-campofinalidade') == 'comprar') {

        $(this).addClass('btn-active-busca');


        finalidade = 2;

        imovel.finalidade = 'venda';
        imovel.numeropagina = 1;
        imovel.numeroregistros = 20;
        imovel.opcaoimovel = 0;

        // $('.fild-hide').show();
        habilitarCampoParaLancamentos()


    } else if ($(this).children().children().attr('data-campofinalidade') == 'lancamentos') {

        $(this).addClass('btn-active-busca');


        finalidade = '';

        imovel.finalidade = 'venda';
        imovel.numeropagina = 1;
        imovel.numeroregistros = 20;
        imovel.opcaoimovel = 2;

        $('#input_valor_min').val('');
        $('#input_valor_max').val('');

        $('#quartos option').each(function (key, element) {
            if (0 == $(element).val()) {
                $(element).prop("selected", true);
            } else {
                $(element).prop("selected", false)
            }
        });

        desabilitarCampoParaLancamentos();

    }
});

$('#finalidade').change(function () {
    if ($(this).val() == 1) {
        imovel.finalidade = 'aluguel';
    } else {
        imovel.finalidade = 'venda';
    }

    carregarTipos();
});


$('#submit-busca').click(function () {

    var lancamentos = '';

    if (finalidade == 1) {

        imovel.finalidade = 'aluguel';

    } else if (finalidade == 2) {

        imovel.finalidade = 'venda';

    } else {

        lancamentos = 'apenas-lancamentos'
        imovel.finalidade = 'venda';
    }


    // if (imovel.opcaoimovel != 0) {
    //     var lancamentos = 'apenas-lancamentos'
    //     imovel.finalidade = 'venda';
    // }


    if (obj_cidade.nome_amigavel != REGIAO_LOCALIZACAO_BASE_URL) {

        obj_cidade.cidade = obj_cidade.nome_amigavel;
    }
    if (obj_bairro.nome_amigavel != 'todos-os-bairros') {

        obj_cidade.cidade = obj_bairro.nome_cidade;
    }


    let tipo = '';

    if ($('#tipo').val() == "0" || $('#tipo').val() == "" || $('#tipo').val() == null) {

        tipo = 'imovel';

    } else {

        tipo = $('#tipo').val();

    }


    let tipoC = '';
    if (obj_cidade.nome_amigavel != REGIAO_LOCALIZACAO_BASE_URL && tipo == 'imovel') {

        tipoC = '/imovel';

    } else {

        tipoC = '/' + tipo;

    }

    let url_direct = retornarVariavelLocal() +
        imovel.finalidade + (tipo != 'imovel' ? '/' + tipo : '') +
        (obj_cidade.nome_amigavel != REGIAO_LOCALIZACAO_BASE_URL ? tipoC + '/' + obj_cidade.nome_amigavel : '') +
        (obj_bairro.nome_amigavel != 'todos-os-bairros' ? '/' + obj_bairro.nome_amigavel : '');

    // Suponha que o contêiner tenha a classe "container"
    var checkboxesMarcados = $('.lista-bairros input[type="checkbox"]:checked');
    var checkParamtrosUrl = '';
    // Agora você pode iterar sobre os checkboxes marcados
    checkboxesMarcados.each(function () {
        // Faça algo com cada checkbox marcado
        checkParamtrosUrl += $(this).val() + "+";
    });
    checkParamtrosUrl = removerPlus(checkParamtrosUrl);


    // Suponha que o contêiner tenha a classe "container"
    var checkboxesMarcadosTipos = $('.lista-tipos input[type="checkbox"]:checked');
    var checkParamtrosUrlTipos = '';
    // Agora você pode iterar sobre os checkboxes marcados
    checkboxesMarcadosTipos.each(function () {
        // Faça algo com cada checkbox marcado
        checkParamtrosUrlTipos += $(this).val() + "+";
    });

    checkParamtrosUrlTipos = removerPlus(checkParamtrosUrlTipos);


    let condUrl = $('#condominio').val();
    if (condUrl == '0') {

        condUrl = '';

    } else {


        if (tipo == '') {
            tipo = 'imovel';
        }

        if (obj_cidade.nome_amigavel == REGIAO_LOCALIZACAO_BASE_URL) {
            obj_cidade.nome_amigavel = REGIAO_LOCALIZACAO_BASE_URL;
        }

        if (obj_bairro.nome_amigavel == 'todos-os-bairros') {
            obj_bairro.nome_amigavel = 'todos-os-bairros';
        }


        url_direct = retornarVariavelLocal() + imovel.finalidade + '/' + (checkParamtrosUrlTipos != '' ? checkParamtrosUrlTipos : 'imovel') + '/' + obj_cidade.nome_amigavel + '/' + checkParamtrosUrl + '/' + condUrl + (lancamentos == '' ? '' : '/apenas-lancamentos/');

    }

    let quartos = $('#quartos').val();
    let val_min = $('#input_valor_min').val();
    let val_max = $('#input_valor_max').val();

    url_direct = retornarVariavelLocal() + imovel.finalidade + '/' + (checkParamtrosUrlTipos != '' ? checkParamtrosUrlTipos : 'imovel') + '/' + (obj_cidade.nome_amigavel != 'todas-as-cidades' ? obj_cidade.nome_amigavel : REGIAO_LOCALIZACAO_BASE_URL) + '/' + (checkParamtrosUrl != '' ? checkParamtrosUrl : 'todos-os-bairros') + '/' + (condUrl != 'todos-os-condominios' && condUrl != '' && condUrl != '0' ? condUrl : 'todos-os-condominios') + (lancamentos == '' ? '/todas-as-opcoes/' : '/apenas-lancamentos/') + (quartos != '0' ? quartos : '') + (val_min != '' && val_max == '' ? '?valor_min=' + val_min : '') + (val_max != '' && val_min == '' ? '?valor_max=' + val_max : '') + (val_max != '' && val_min != '' ? '?valor_min=' + val_min + '&valor_max=' + val_max : '');

    //REDIRECIONAMENTO PARA PAGINA DE BUSCA
    window.location.href = url_direct;
});


$('#show-search-cod').click(function () {

    if ($('.container_busca_codigo').hasClass('active')) {
        $('.container_busca_codigo').removeClass('active');

    } else {
        $('.container_busca_codigo').addClass('active');
    }
})

//BUSCAR POR CÓDIGO
$('#btn_codigo').click(function () {

    if ($('#codigo').val() == '') {
        return false
    }

    let codigos = $('#codigo').val();
    codigos = codigos.replace(" ", "");
    codigos = codigos.split(',');

    let link = '';
    $.each(codigos, function (i, c) {
        link += c + ',';
    });

    link = link.slice(0, -1);
    window.location.href = retornarVariavelLocal() + 'venda?codigos=' + link;
})

//CARREGAR OS CONDOMINIOS
function carregarCondominios() {

    let paramCondominio = imovel;
    paramCondominio.finalidade = '0';
    paramCondominio.numeroregistros = 1000;
    paramCondominio.retornoReduzido = 'true';

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'get-condominios', //ImovelController
        async: true,
        data: paramCondominio,
        beforeSend: function () {
            $('#condominio').empty();
            $('#condominio').append('<option value="0">Carregando...</option>');
        }
    }).done(function (cond) {

        $('#condominio').empty();
        $('#condominio').append('<option value="0">Todos</option>');

        $.each(cond.lista, function (key, c) {

            $('#condominio').append('<option url="' + c.url_amigavel + '" id-cond="' + c.codigo + '" value="' + c.url_amigavel + '">' + c.nome + '</option>');
        });

    }).then(function () {

        $('.chosen').chosen();

    }).always(function () {

    });
}

carregarCondominios()

//CARREGAR OS TIPOS
function carregarTipos() {

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-tipos-disponiveis',
        async: true,
        data: imovel,
        beforeSend: function () {
            $('.lista-tipos ul').empty();
        }
    }).done(function (tipos) {

        $.each(tipos.lista, function (key, tipo) {

            let option = '<li><input  id="' + tipo.urlAmigavel + '" type="checkbox" class="check-box-tipos" value="' + tipo.urlAmigavel + '"><label for="' + tipo.urlAmigavel + '">' + tipo.nome + '</label></li>';
            option = $(option).click(function () {

                // Suponha que o contêiner tenha a classe "container"
                var quantidadeTiposMarcados = $('.lista-tipos input[type="checkbox"]:checked').length;
                $('.cont-tipos').text(quantidadeTiposMarcados);
            });

            $('.lista-tipos ul').append(option);
        });

    }).then(function () {

    }).always(function () {
    });
}

carregarTipos();

$('.botao_destaque_home').click(function () {
    
    $('.botao_destaque_home').removeClass('btn-active');

    if ($(this).attr("data-finalidade") == 'alugar') {

        $(this).addClass('btn-active');

        $('#carrossel_destaques_imoveis').slick('unslick');
        $('.botao_ver_destaque[data-finalidade=aluguel]').prop('href', retornarVariavelLocal() + 'aluguel');
        carregarDestaques("destaque", "aluguel");

    }
    else if ($(this).attr("data-finalidade") == 'comprar') {

        $(this).addClass('btn-active');

        $('#carrossel_destaques_imoveis').slick('unslick');
        $('.botao_ver_destaque[data-finalidade=venda]').prop('href', retornarVariavelLocal() + 'venda');
        carregarDestaques("destaque", "venda");

    }
    else if ($(this).attr("data-finalidade") == 'super_destaque') {

        $(this).addClass('btn-active');

        $("#carrossel_destaques_imoveis").slick("unslick");
        $(".botao_ver_destaque[data-finalidade=venda]").prop(
            "href",
            retornarVariavelLocal() + "venda"
        );
        carregarDestaques("super-destaque", "venda");
    }
});

//INTERAÇÕES COM BUSCA HOME
$('#container-codigo').click(function () { });

$('.buttom_busca_home').click(function () {

    $('.buttom_busca_home').removeClass('btn-active');

    if ($(this).children().children().attr('id') == 'busca-endereco') {

        $(this).addClass('btn-active');
        $('.container-codigo').fadeOut(function () {
            $('.container-campos-home').fadeIn('slow');
        });

    } else {

        $(this).addClass('btn-active');
        $('.container-campos-home').fadeOut(function () {
            $('.container-codigo').fadeIn('slow');
        });

    }
});

$('#endereco').focus(function () {

    // targetOffset = $('#submit-busca').offset().top;

    // $('html, body').animate({
    //     scrollTop: targetOffset - 200
    // }, 500);
});

$('#quartos').change(function () {
    imovel.numeroquartos = $(this).val();
});

$('#input_valor_min').change(function () {
    imovel.valorde = $(this).val();
});

$('#input_valor_max').change(function () {
    imovel.valorate = $(this).val();
});


$('#input_valor_min').mask("###.###.##0,00", { reverse: true });
$('#input_valor_max').mask("###.###.##0,00", { reverse: true });

$(document).ready(function () {

    //vou carregar os destaques
    carregarDestaques('destaque', 'venda');
});


//CARREGA CIDADES
function getCidades() {

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-cidades-disponiveis',
        async: true,
        data: imovel,
        beforeSend: function () {
            $('#cidade').empty();
            $('#cidade').append('<option  url="todas-as-cidades" id-cidade="0" value="todas-as-cidades">Carregando...</option>');
        }
    }).done(function (cidades) {

        $('#cidade').empty();
        $('#cidade').append('<option  url="todas-as-cidades" id-cidade="0" value="todas-as-cidades">Cidade</option>');

        $.each(cidades.lista, function (key, cidade) {
            $('#cidade').append('<option url="' + cidade.urlAmigavel + '" id-cidade="' + cidade.codigo + '" value="' + cidade.urlAmigavel + '">' + cidade.nome + '</option>');
        });

    }).then(function () {

    }).always(function () {
    });
}

getCidades();

//CUSTOMIZAÇÃO TIPOS
var $listaTipos = $('.lista-tipos');
var $btnToggleTipo = $('.btn-toggle-tipo');

// Função para alternar a visibilidade da lista de bairros
$btnToggleTipo.on('click', function (e) {

    //if($('.lista-bairros ul li').length == '0'){
    //    mostrarMensagem('Selecione uma Cidade para carregar os Bairros. #1'); //alertError
    //}

    if ($('.lista-tipos ul li').length == '0') {
        // mostrarMensagem('Selecione uma Cidade para carregar os Tipos.'); //alertError
    }


    $listaTipos.toggle();
    e.stopPropagation(); // Previne que o clique se propague para o document
});

// Função para fechar a lista de bairros ao clicar fora dela
$(document).on('click', function (e) {
    if (!$listaTipos.is(e.target) && $listaTipos.has(e.target).length === 0 && !$btnToggleTipo.is(e.target)) {
        $listaTipos.hide();
    }
});

// Impede que cliques dentro da lista de bairros fechem a lista
$listaTipos.on('click', function (e) {
    e.stopPropagation();
});


//funcao pra escrever no banner pagina inicial
function typeWrite(elemento) {
    //debugger;

    let timeEscrita = 80;

    const textoArray = elemento.innerHTML.split('');
    elemento.innerHTML = ' ';
    textoArray.forEach(function (letra, i) {
        setTimeout(function () {
            elemento.innerHTML += letra;
        }, timeEscrita * i)
    });
}

if ($(".texto_animado_banner").length > 0) {
    //debugger;
    const titulo = document.querySelector('.texto_animado_banner');
    typeWrite(titulo);
}
