$('#telefone').mask('(00) 0 0000-0000');
$('#numero').mask('000000');
$('#cep').mask('00000000');
$('#cpf').mask('000.000.000-00');

$('.mask-valor').mask("###.###.##0,00", { reverse: true });

function numberToReal(numero) {
    var numero = numero.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

const formulario = document.forms.ouvidoria;

formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();
    if ($('#captchaAtivo').val() == 1) {
        data.append('g_recaptcha', grecaptcha.getResponse())
    }
    data.append('nome', $('#nome').val())
    data.append('sobrenome', $('#sobrenome').val())
    data.append('telefone', $('#telefone').val())
    data.append('email', $('#email').val())
    data.append('endereco', $('#endereco').val())
    data.append('motivo', $('#motivo').val())
    data.append('mensagem', $('#mensagem').val())
    data.append('midia', 'Site')

    let arquivo = $('#arquivo')[0].files
    data.append('arquivo', arquivo[0]);

    if (validarCamposForm('.form-ouvidoria') == false) {
        return false;
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'ouvidoria-form',
        async: true,
        data: data,
        contentType: false,
        processData: false,
        beforeSend: function () {
            habilitarDesabilitarBotao('#submit-ouvidoria', 'desabilitar');;
        }
    }).done(function (dados) {

        if (dados.status == false) {
            mostrarMensagem(dados.mensagem);
            habilitarDesabilitarBotao('#submit-ouvidoria', 'habilitar', 'Enviar');
        } else {
            window.location.href = retornarVariavelLocal() + 'obrigado/condominio/103'
        }

    }).then(function (dados) {
        habilitarDesabilitarBotao('#submit-ouvidoria', 'habilitar', 'Enviar');
    }).fail(function () {
        habilitarDesabilitarBotao('#submit-ouvidoria', 'habilitar', 'Enviar');
    }).always(function () {
        habilitarDesabilitarBotao('#submit-ouvidoria', 'habilitar', 'Enviar');
    })

})

$('#cep').keyup(function () {

    let cep = $(this).val();

    if (cep.length == 8) {

        $.ajax({
            method: "GET",
            url: 'https://viacep.com.br/ws/' + cep + '/json/', //ImovelController
            async: true,
            data: imovel,
            beforeSend: function () { }
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

