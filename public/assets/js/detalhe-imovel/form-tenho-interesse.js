
const formconversion = document.forms.leadimovel;

formconversion.addEventListener('submit', (e) => {
    e.preventDefault();

    let form = {};
    if ($('#captchaAtivo').val() == 1) {
        form.g_recaptcha = grecaptcha.getResponse(0); //PRIMEIRO CAPTCHA DA PAGINA (FORMULARIO TENHO INTERESSE NO IMOVEL)
    }

    form.codigoimovel = $('.cod-id-form').text();
    form.finalidade = $('#form-corretor-finalidade').val();
    form.nome = $('#form-corretor-nome').val();
    form.telefone = $('#form-corretor-celular').val();
    form.email = $('#form-corretor-email').val();
    form.anotacoes = $('#form-corretor-msg').val();

    if (validarCamposForm('.formulario-lead') == false) {
        return false;
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'detalhe-imovel-incluir-lead-form', //ImovelController
        async: true,
        data: form,
        beforeSend: function () {
            habilitarDesabilitarBotao('#btn-enviar-lead-imovel', 'desabilitar');
        }
    }).done(function (dados) {

        if (dados.status == false) {
            mostrarMensagem(dados.mensagem);
            habilitarDesabilitarBotao('#btn-enviar-lead-imovel', 'habilitar', 'TENHO INTERESSE');
        } else {
            window.location.href = retornarVariavelLocal() + 'obrigado/imovel/99'
        }

    }).then(function () {
        habilitarDesabilitarBotao('#btn-enviar-lead-imovel', 'habilitar', 'TENHO INTERESSE');

    }).always(function () {
        habilitarDesabilitarBotao('#btn-enviar-lead-imovel', 'habilitar', 'TENHO INTERESSE');
    });
});


function validarEmail(email) {
    return /^[\w+.]+@\w+\.\w{2,}(?:\.\w{2})?$/.test(email);
}
