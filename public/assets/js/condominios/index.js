//CARREGAR OS FACULDADES PROXIMAS
var paramCondominio = imovel;

paramCondominio.finalidade = '0';
paramCondominio.numeroregistros = 12;
paramCondominio.numeropagina = 1;
paramCondominio.retornoReduzido = false;

paramCondominio.codigocidade = 0;
paramCondominio.codigobairro = 0;

var quantiadeRegistos = paramCondominio.numeroregistros;

//carregar condominios
function carregarCondominios(param = 1) {


    paramCondominio.numeropagina = param;

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'get-condominios-paginacao',
        async: true,
        data: paramCondominio,
        beforeSend: function () {
            $('.container_loader').css('display', 'block');
            $("#container_condominios").empty();
        }
    }).done(function (dados) {

        if (dados.quantidade == 0) {
            let alert = `<div class="col-12">
                                <div class="menssagem-condominio-nao-encontrado">
                                    <div class="text-center">
                                        <strong>Não há condomínios para essa localização</strong>
                                    </div>
                                </div>
                           </div>`;

            $("#container_condominios").append(alert);

            $('#container_geral_paginacao').css('display', 'none');
            return false;
        }

        $.each(dados.lista, function (i, cond) {

            let place =
                '<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">' +
                '<a class="link" href="' + retornarVariavelLocal() + 'condominio/' + cond.url_amigavel + '/' + cond.codigo + '">' +
                '<div class="card_condominio">' +
                '<div>' +
                '<img loading="lazy" class="img_condominio" src="' + cond.urlfotoprincipal + '" />' +
                '</div>' +
                '<div class="corpo_card_text_place margin-bottom-20">' +
                '<span class="titulo_card">' + cond.nome + '</span>' +
                '</div>' +
                '</div>' +
                '</a>' +
                '</div>';

            $("#container_condominios").append(place);
        });

        atualizarPaginacao(dados);

    }).then(function () {
        $('.container_loader').css('display', 'none');
    }).always(function () {

    });

}

carregarCondominios();

function atualizarPaginacao(imoPaginacao) {

    $('.container-paginacao').empty();

    let numeroPagiana = Math.ceil(parseInt(imoPaginacao.quantidade) / quantiadeRegistos);

    for (let i = 1; i <= numeroPagiana; i++) {

        if ((i + 2) == parseInt(imoPaginacao.numeropagina) || (i + 1) == parseInt(imoPaginacao.numeropagina) || i == parseInt(imoPaginacao.numeropagina) || (i - 2) == parseInt(imoPaginacao.numeropagina) || (i - 1) == parseInt(imoPaginacao.numeropagina)) {

            let btnPage = $('<div>')
                .addClass('btn-paginacao ' + (imoPaginacao.numeropagina == i ? 'active' : ''))
                .append($('<span>').text(i));

            $(btnPage).click(function () { carregarCondominios(i) });

            $('.container-paginacao').append(btnPage);
        }
    }

    $('#btn-end').empty();

    let btn = $('<div>').attr('id', 'ultimaPagina').addClass('btn-paginacao');
    $(btn).append($('<span>').addClass('carousel_setinha_listagem').text('›'));
    $(btn).click(function () {
        carregarCondominios(numeroPagiana)
    });

    $('#btn-end').append(btn);

    //mostrar os botões
    $('#container_geral_paginacao').css('display', 'flex');

}

//CARREGAR BAIRROS
function carregarBairros() {

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-bairros-disponiveis', //ImovelController
        async: true,
        data: paramCondominio,
        beforeSend: function () {
            $('#bairro').empty();
            $('#bairro').append('<option value="0">Carregando...</option>');
        }
    }).done(function (bairros) {

        $('#bairro').empty();
        $('#bairro').append('<option value="0">Todas os Bairros</option>');

        $.each(bairros.lista, function (key, bairro) {


            if (bairro.urlCidadeAmigavel == paramCondominio.urlcidade) {
                $('#bairro').append('<option value="' + bairro.codigobairro + '" url="' + bairro.urlAmigavel + '" id-bairro="' + bairro.codigo + '" value="' + bairro.urlAmigavel + '">' + bairro.nomebairro + '</option>')
            }
        });

    }).then(function () {

    }).always(function () {

    });
}

//CARREGAR OS TIPOS
function carregarCidades() {

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-cidades-disponiveis', //ImovelController
        async: true,
        data: imovel,
        beforeSend: function () {
            $('#cidade').empty();
            $('#cidade').append('<option value="0">Carregando...</option>');

        }
    }).done(function (cidades) {
        $('#cidade').empty();

        $('#cidade').append('<option value="0">Todas as Cidades</option>');

        $.each(cidades.lista, function (key, cidade) {

            $('#cidade').append('<option val="' + cidade.codigo + '" url="' + cidade.urlAmigavel + '" id-cidade="' + cidade.codigo + '" value="' + cidade.urlAmigavel + '">' + cidade.nome + '</option>');
        });

    }).then(function () {

        carregarBairros();

    }).always(function () {
    });
}

carregarCidades();

$('#cidade').change(function () {
    paramCondominio.codigocidade = 0;
    paramCondominio.codigoBairro = '';

    let cidade = $(this).val();


    $('#cidade option').each(function (index, element) {

        if (cidade == $(element).attr('value')) {

            paramCondominio.codigocidade = $(element).attr('id-cidade');
            paramCondominio.urlcidade = $(element).attr('url');

        }

    });

  
    if (paramCondominio.codigocidade == undefined) {
        paramCondominio.codigocidade = 0;
        paramCondominio.urlcidade = '';
    }

    carregarCondominios(1);
    carregarBairros();
});

$('#bairro').change(function () {
    paramCondominio.codigobairro = $(this).val();
    carregarCondominios(1);
});




