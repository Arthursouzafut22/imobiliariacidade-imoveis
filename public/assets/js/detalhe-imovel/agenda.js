
// CARROSSEL AGENDAMENTO
$('#carrossel-data-a').slick({
    dots: false,
    infinite: false,
    speed: 300,
    arrows: true,
    slidesToShow: 7,
    slidesToScroll: 7,
    infinite: false,
    autoplay: false,
    //appendArrows: '<img class="seta-agenda-left" src="http://localhost:8080/premium/assets/icons/icon-seta-left.svg" />',
    responsive: [
        {
            breakpoint: 3000,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 7,
            }
        },
        {
            breakpoint: 1600,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 7,

            }
        },
        {
            breakpoint: 1277,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 7,

                centerPadding: '60px',
            }
        },
        {
            breakpoint: 779,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: false,
                centerPadding: '60px',
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: false,
                centerPadding: '20px',
            }
        }
    ]
});

var agendamento = $('#carrossel-data-a');

$('.seta-agenda-left').click(function () {
    agendamento.slick('slickPrev');
});

$('.seta-agenda-right').click(function () {
    agendamento.slick('slickNext');
});



$('.agendar-visita').click(function () {

    $('#for-lead-modal').fadeOut('slow');
    $('#ag-horario-success-modal').fadeOut('slow');

    $('#ag-data-modal').fadeIn('slow');

    $('#carrossel-data-a').slick('destroy');
    $('#staticBackdrop').modal('show');

    $('#carrossel-data-a').empty();

    setTimeout(function () {

        $.ajax({
            method: "POST",
            url: retornarVariavelLocal() + 'retornar-calendario', //ImovelController
            async: true,
            data: {},
            beforeSend: function () {

                $('.load-horarios').fadeIn('slow');
                $('#carrossel-data-a').empty();

            }
        }).done(function (dados) {


            $.each(dados, function (i, a) {

                var dia = $('<div>').addClass('card-data d-flex flex-column justify-content-center align-items-center').attr('data', a.data);

                dia.append($('<span>').addClass('dia-semana').text(a.dia));
                dia.append($('<span>').addClass('dia-mes').text(a.diaMes));
                dia.append($('<span>').addClass('mes').text(a.mes));
                dia.click(function () {

                    $('.card-data').removeClass('data-active');
                    $(this).addClass('data-active');

                    carregarHorarios($(this).attr('data'));
                });

                $('#carrossel-data-a').slick('slickAdd', dia);
                //$('#carrossel-data-a').slick('slickAdd', dia);
            });

        }).then(function (dados) {

            $('.load-horarios').fadeOut('slow');

        }).then(function () {

        });


    }, 1000)


});

// ativarSlickCalendario();
// ativarSlickHorarios();

function carregarHorarios(data) {

    let param = {};
    param.data = data;
    param.codigoimovel = $('#cod-principal-form').text();

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-horarios', //ImovelController
        async: true,
        data: param,
        beforeSend: function () {

            $('#carrossel-horaio').slick('unslick');
            $('#carrossel-horaio').empty();
        }
    }).done(function (dados) {


        if (dados.length == 0) {

            $('#text-horarios').text('Não temos horários disponíveis para essa data').css('color', '#F44336');
        } else {

            $('#text-horarios').text('Agora, qual o melhor horário ?').css('color', '#222328');
        }


        for (var i = 0; i < dados.length; i++) {

            h = $('<div>')
                .addClass('card-hora d-flex flex-column justify-content-center align-items-center')
                .append(dados[i]);
            h.click(function () {

                $('.card-hora').removeClass('data-active');
                $(this).addClass('data-active');


                $('#btn-ag-data-avancar').prop('disabled', false);
            });

            $('#carrossel-horaio').slick('slickAdd', h);
        }

    }).then(function (dados) {


    }).then(function () {

    });

}


//CARROSSEL DE HORARIOS
$('#carrossel-horaio').slick({
    dots: false,
    infinite: true,
    speed: 300,
    arrows: true,
    infinite: false,
    slidesToShow: 7,
    slidesToScroll: 7,
    autoplay: true,
    //        appendArrows: '<img class="seta-agenda-left" src="http://localhost:8080/premium/assets/icons/icon-seta-left.svg" />',
    responsive: [
        {
            breakpoint: 3000,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 7,

            }
        },
        {
            breakpoint: 1600,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 7,

            }
        },
        {
            breakpoint: 1277,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 7,
                centerPadding: '60px',
            }
        },
        {
            breakpoint: 779,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                centerPadding: '60px',
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                centerPadding: '20px',
            }
        },
        {
            breakpoint: 320,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                centerPadding: '20px',
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

var horario = $('#carrossel-horaio');

$('.seta-agenda-hora-left').click(function () {
    horario.slick('slickPrev');
});

$('.seta-agenda-hora-right').click(function () {
    horario.slick('slickNext');
});


$('#btn-ag-data-avancar').click(function () {

  
    let objData = $('#carrossel-data-a').find("div.data-active");
    let dia = objData.children().eq(0).text();
    let diaMes = objData.children().eq(1).text();
    let mes = objData.children().eq(2).text();

    let objHora = $('#carrossel-horaio').find("div.data-active");
    let hora = objHora.text();

    let dataVisita = $(".card-data.data-active").attr("data-databr");
    let horaVisita = $('#carrossel-horarios').find("div.data-active").text();
    //ATUALIZA TITULO
    $('#txt-data-agenda').text(dia + ', ' + diaMes + ' de ' + mes + ' às ' + hora);

    $('#form-ag-data').text(dia + ', ' + diaMes + ' de ' + mes + ' às ' + hora);
    
    $('#ag-data-modal').fadeOut();
    $('#ag-horario-modal').fadeIn();
});

$('#voltar-agenda').click(function () {

    $('#ag-data-modal').fadeIn('slow');

    $('#ag-horario-modal').fadeOut('slow');
});


$('#form-ag-celular').mask('(00) 0 0000-0000');
$('#form-corretor-celular').mask('(00) 0 0000-0000');

const formVisita = document.forms.visitaimovel;

formVisita.addEventListener('submit', (e) => {
    e.preventDefault();

    let form = {};
    if ($('#captchaAtivo').val() == 1) {
        form.g_recaptcha = grecaptcha.getResponse(2); //TERCEIRO CAPTCHA DA PAGINA (FORMULARIO AGENDAMENTO DE VISITAS)
    }
    form.nome = $('#form-ag-nome').val();
    form.telefone = $('#form-ag-celular').val();
    form.email = $('#form-ag-email').val();
    form.anotacoes = $('#form-ag-msg').val();
    form.codigoimovel = $('#cod-principal-form').text();
    form.codigo = $('#cod-principal-form').text();
    form.datahoraagendamentovisita = $('#carrossel-data-a').find("div.data-active").attr('data') + ' ' + $('#carrossel-horaio').find("div.data-active").text();

    if (validarCamposForm('.visitaimovel') == false) {
        return false;
    }

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'detalhe-imovel-agendar-visita-form',
        async: true,
        data: form,
        beforeSend: function () {
            habilitarDesabilitarBotao('#btn-agendar-visita', 'desabilitar');
        }
    }).done(function (dados) {

        if (dados.status == false) {
            habilitarDesabilitarBotao('#btn-agendar-visita', 'habilitar');
            mostrarMensagem(dados.mensagem);

        } else {
            window.location.href = retornarVariavelLocal() + 'obrigado/agendamento-visitas/101';
        }

    }).then(function (dados) {

        $('.id-gif').hide();
        habilitarDesabilitarBotao('#btn-agendar-visita', 'habilitar');

    }).always(function () {
        habilitarDesabilitarBotao('#btn-agendar-visita', 'habilitar');
    });

});


function validarFormAgenda(form) {

    if (form.nome == '') {

        $('#form-ag-nome').css('border-color', 'red');

        return false;
    }

    if (form.email == '' || !validarEmail(form.email)) {

        $('#form-ag-email').css('border-color', 'red');

        return false;
    }

    if (form.telefone == '') {

        $('#form-ag-celular').css('border-color', 'red');

        return false;
    }

    return true;

}


//FECHAR MODAL
$('#fecher-agenda').click(function () {
    $('#staticBackdrop').modal('hide');
});

//ABRIR MODAL FALE COM O CORRETOR
$('.btn-fale-corretor').click(function () {

    $('#staticBackdrop').modal('show');

    //Esconte todos os modais
    $('#ag-data-modal').fadeOut('slow');
    $('#ag-horario-modal').fadeOut('slow');
    $('#ag-horario-success-modal').fadeOut('slow');


    $('#for-lead-modal').fadeIn('slow');
});


$('#btn-call-mobile').click(function () {

    // var id = $(this).attr('href'),
    // targetOffset = $(".cont-call-to-action").offset().top;

    // $('html, body').animate({ 
    //     scrollTop: targetOffset - 100
    // }, 500);
    $('#staticBackdrop').modal('show');

    //Esconte todos os modais
    $('#ag-data-modal').fadeOut('slow');
    $('#ag-horario-modal').fadeOut('slow');
    $('#ag-horario-success-modal').fadeOut('slow');


    $('#for-lead-modal').fadeIn('slow');

})

$('#modal-lead').modal('show');
