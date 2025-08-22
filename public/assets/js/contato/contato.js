$('#tel').mask('(00) 0 0000-0000');
$('#fixo').mask('(00) 0000-0000');

const formulario = document.forms.faleconosco;

formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    debugger;

    let form = {};

    form.nome = $('#nome').val();
    form.email = $('#email').val();
    form.tel = $('#tel').val();
    form.fixo = $('#fixo').val();
    form.descricao = $('#descricao').val();
    
    if ($('#captchaAtivo').val() == 1 ) {
        form.g_recaptcha = grecaptcha.getResponse();
    }

    //VALIAR FORMULARIO
    if (validarCamposForm('.form-contato') == false) {
        return false
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'contato-form',
        async: true,
        data: form,
        beforeSend: function () {
            habilitarDesabilitarBotao('#submit-contato', 'desabilitar');
        }

    }).done(function (dados) {

        if (dados.status ==  false) {
            mostrarMensagem(dados.mensagem);
            habilitarDesabilitarBotao('#submit-contato', 'habilitar', 'Enviar mensagem');
        } else {
            window.location.href = retornarVariavelLocal() + 'obrigado/contato/96';
        }
    }).then(function () {
        habilitarDesabilitarBotao('#submit-contato', 'habilitar', 'Enviar mensagem');
    }).always(function () {
        habilitarDesabilitarBotao('#submit-contato', 'habilitar', 'Enviar mensagem');
    });
});

$(document).ready(function () {

    if(window.innerWidth <= 982){
        return false;
    }

    // em 800 milesegundos
    setTimeout(function () {

        // ajusto a altura do box de contato
        let altura = ajustarHeightElemento(".box_contato");
        $(".box_contato").css("min-height", "" + altura + "px");

        // altura do maps
        let alturaIframe = ajustarHeightElemento(".box_contato");
        alturaIframe = alturaIframe - 136;
        $(".wrap_mapa_iframe iframe").css("min-height", "" + alturaIframe + "px");

    }, 800);
});