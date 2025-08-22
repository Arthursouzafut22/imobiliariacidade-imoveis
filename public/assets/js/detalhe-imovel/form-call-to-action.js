$('#tel-call').mask('(00) 0 0000-0000');

const formulario = document.forms.imovelideal;

formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    let form = {};

    if ($('#captchaAtivo').val() == 1 ) {
        form.g_recaptcha = grecaptcha.getResponse(1); //SEGUNDA CAPTCHA DA PAGINA (FORMULARIO IMOVEL IDEAL)
    }

    form.nome = $('#nome-call').val();
    form.email = $('#email-call').val();
    form.tel = $('#tel-call').val();

    if (validarCamposForm('.form-imovel-ideal') == false) {
        return false;
    }

    habilitarDesabilitarBotao('#btn-call-to-action', 'desabilitar');;

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'detalhe-imovel-nao-achou-imovel-form', 
        async: true,
        data: form

    }).done(function (dados) {

        if (dados.status == false) {
            mostrarMensagem(dados.mensagem);
            habilitarDesabilitarBotao('#btn-call-to-action', 'habilitar', 'BUSCAR IMÓVEIS');
        } else {
            window.location.href = retornarVariavelLocal() + 'obrigado/imovel-ideal/100'
        }

    }).then(function (dados) {
    }).always(function () {
        habilitarDesabilitarBotao('#btn-call-to-action', 'habilitar', 'BUSCAR IMÓVEIS');
    });
});


$('#form-corretor-celular').mask("(00) 0 0000-0000");
