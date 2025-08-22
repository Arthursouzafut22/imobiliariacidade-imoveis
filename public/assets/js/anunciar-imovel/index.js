$('#telefone').mask('(00) 0 0000-0000');
$('#numero').mask('000000');
$('#cep').mask('00000000');

$('.mask-valor').mask("###.###.##0,00", { reverse: true });

function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

const formulario = document.forms.anuncieseuimovel;

formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    let form = {};

    if ($('#captchaAtivo').val() == 1) {
        form.g_recaptcha = grecaptcha.getResponse();
    }

    form.nome = $('#nome').val();
    form.telefone = $('#telefone').val();
    form.email = $('#email').val();
    form.finalidade = $('#finalidade').val();

    form.destinacao = $('#destinacao').val();
    form.codigotipoimovel = $('#tipo').val();
    form.tipoimovel = $('#tipoimovel').val();

    form.valorimovel = $('#valorimovel').val();
    form.valorcondominio = $('#valorcondominio').val();
    form.valoriptu = $('#valoriptu').val();
    form.areainterna = ($('#areainterna').val() == '' ? 0 : $('#areainterna').val())
    form.areaexterna = ($('#areaexterna').val() == '' ? 0 : $('#areaexterna').val())

    form.arealote = ($('#arealote').val() == '' ? 0 : $('#arealote').val())
    form.andar = parseFloat(($('#andar').val() == '' ? 0 : $('#andar').val()))
    form.numeroquarto = parseFloat(($('#numeroquarto').val() == '' ? 0 : $('#numeroquarto').val()))
    form.numerosuite = parseFloat(($('#numerosuite').val() == '' ? 0 : $('#numerosuite').val()))
    form.numerobanho = parseFloat(($('#numerobanho').val() == '' ? 0 : $('#numerobanho').val()))
    form.numerovaga = parseFloat(($('#numerovaga').val() == '' ? 0 : $('#numerovaga').val()))
    form.aceitapermuta = Boolean($('#aceitapermuta')[0].checked);
    form.aceitafinanciamento = Boolean($('#aceitafinanciamento')[0].checked);
    form.ocupado = Boolean($('#ocupado')[0].checked);

    form.cep = ($('#cep').val() == '' ? 0 : $('#cep').val())
    form.endereco = $('#endereco').val();
    form.numeroendereco = $('#numeroendereco').val();
    form.complemento = $('#complemento').val();
    form.bairro = $('#bairro').val();
    form.cidade = $('#cidade').val();
    form.estado = $('#estado').val();

    if (validarCamposForm('.form-anuncie') == false) {
        return false;
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'anuncie-imovel-form', 
        async: true,
        data: form,
        beforeSend: function () {
            habilitarDesabilitarBotao('#submit-anunciar', 'desabilitar');
        }
    }).done(function (dados) {

        if (dados.status == false) {
            mostrarMensagem(dados.mensagem);
            habilitarDesabilitarBotao('#submit-anunciar', 'habilitar', 'Anunciar Mensagem');
        } else {
            window.location.href = retornarVariavelLocal() + 'obrigado/anuncie-seu-imovel/97'
        }

    }).then(function (dados) {
    }).fail(function () {
        habilitarDesabilitarBotao('#submit-anunciar', 'habilitar', 'Anunciar Mensagem');
    }).always(function () {
        habilitarDesabilitarBotao('#submit-anunciar', 'habilitar', 'Anunciar Mensagem');
    })
})


$('#btn-action-anucniar').click(function () {
    targetOffset = $("#header").offset().top;
    $('html, body').animate({
        scrollTop: targetOffset + 200
    }, 500);

});

//CARREGAR OS TIPOS
function carregarTipos() {

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-tipos-disponiveis', //ImovelController
        async: true,
        data: imovel,
        beforeSend: function () {
            $('#tipo').empty();
            $('#tipo').append('<option value="">Carregando...</option>');

        }
    }).done(function (tipos) {


        $('#tipo').empty();

        $('#tipo').append('<option value="">Selecione o tipo</option>');

        $.each(tipos.lista, function (key, tipo) {

            $('#tipo').append('<option url="' + tipo.urlAmigavel + '" id-tipo="' + tipo.codigo + '" value="' + tipo.codigo + '">' + tipo.nome + '</option>');
        });

        $('#tipo').append('<option value="0">Outros</option>');

    }).then(function () {
    }).always(function () {
    });
}

carregarTipos()

$('#cep').keyup(function () {

    let cep = $(this).val();

    if (cep.length == 8) {

        $.ajax({
            method: "GET",
            url: 'https://viacep.com.br/ws/' + cep + '/json/', //ImovelController
            async: true,
            data: imovel,
            beforeSend: function () {

            }
        }).done(function (dados) {

            $('#endereco').val(dados.logradouro);
            $('#bairro').val(dados.bairro);
            $('#cidade').val(dados.localidade);
            $('#estado').val(dados.uf);

        }).then(function () {
        }).always(function () {
        });
    }
})

$('#tipo').change(function () {

    if ($(this).val() != '0') {

        $('#container-text-tipo').fadeOut()

    } else {
        $('#container-text-tipo').fadeIn()
    }

});