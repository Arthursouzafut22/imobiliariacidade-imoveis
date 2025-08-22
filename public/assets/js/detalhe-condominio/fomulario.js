


const formulario = document.forms.detalhecondominio;

formulario.addEventListener('submit', (e) => {
    e.preventDefault();

    let form = {};

    form.g_recaptcha = grecaptcha.getResponse();

    form.codigoimovel = $('#codigo-empreendimento').val();
    form.nomeempreendimento = $('#nome-empreendimento').val();
    form.nome = $('#nome-call').val();
    form.email = $('#email-call').val();
    form.telefone = $('#tel-call').val();
    form.anotacoes = $('#mensagem').val();
    form.finalidade = '2';

    if (validarCamposForm('.form-detalhe-condominio') == false) {
        return false;
    }

    habilitarDesabilitarBotao('#btn-call-to-action', 'desabilitar');;

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'detalhe-condominio-enviar-lead-form',
        async: true,
        data: form
    }).done(function (dados) {

        if (dados.status == false) {
            mostrarMensagem(dados.mensagem);
            habilitarDesabilitarBotao('#btn-call-to-action', 'habilitar', 'Anunciar Mensagem');
        } else {
            window.location.href = retornarVariavelLocal() + 'obrigado/condominio/98'
        }

    }).then(function (dados) {
    }).always(function () {
        habilitarDesabilitarBotao('#btn-call-to-action', 'habilitar');
    });
});
