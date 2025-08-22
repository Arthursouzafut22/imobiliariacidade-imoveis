$('#telefone').mask('(00) 0 0000-0000');
$('#numero').mask('000000');
$('#cep').mask('00000000');
$('#cpf').mask('000.000.000-00');

const formulario = document.forms.trabalheconosco;

formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();
    data.append('nome', $('#nome').val())
    data.append('sobrenome', $('#sobrenome').val())
    data.append('telefone', $('#telefone').val())
    data.append('cpf', $('#cpf').val())
    data.append('vaga', $('#vaga').val())
    data.append('midia', 'Site')

    let arquivo = $('#arquivo')[0].files
    data.append('arquivo', arquivo[0]);

    if ($('#captchaAtivo').val() == 1) {
        data.append('g_recaptcha', grecaptcha.getResponse())
    }

    //VALIAR FORMULARIO
    if (validarCamposForm('.form-trabalhe-conosco') == false) {
        return false
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'trabalhe-conosco-form',
        async: true,
        data: data,
        contentType: false,
        processData: false,        
        beforeSend: function () {
            habilitarDesabilitarBotao('#submit-trabalhe-conosco', 'desabilitar');;
        }
    }).done(function (dados) {

        if(dados.status == false) {
            mostrarMensagem(dados.mensagem);
            return false;
        }

        //redireciona
        window.location.href = retornarVariavelLocal() + 'obrigado/trabalhe-conosco/104';

    }).fail(function () {

        let resposta = dados.responseText;
        resposta = JSON.parse(resposta.resposta);

        habilitarDesabilitarBotao('#submit-trabalhe-conosco', 'habilitar');

    }).always(function () {
        habilitarDesabilitarBotao('#submit-trabalhe-conosco', 'habilitar');
    })
})



