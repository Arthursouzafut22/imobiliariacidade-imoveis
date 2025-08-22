function ativarGaleria() {

    $('#galeria').slick({
        dots: false,
        infinite: false,
        speed: 300,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 5,
        autoplay: true,
        centerMode: true,
        centerPadding: '100px',
        responsive: [
            {
                breakpoint: 3000,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    centerPadding: '100px',

                }
            },
            {
                breakpoint: 1600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    centerPadding: '100px',

                }
            },
            {
                breakpoint: 1277,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    centerPadding: '50px',
                }
            },
            {
                breakpoint: 779,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: false,
                    centerMode: true,
                    centerPadding: '0px',
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    centerMode: true,
                    centerPadding: '20px',
                }
            },
            {
                breakpoint: 320,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    centerMode: true,
                    centerPadding: '20px',
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    var depoimentos = $('#galeria');

    $('.arrow-left').click(function () {
        depoimentos.slick('slickPrev');
    });

    $('.arrow-right').click(function () {
        depoimentos.slick('slickNext');
    });

    //=================== // ====================
}

function ativarModal() {

    if (screen.width > 720) {
        // sirva a versão pra celular
        $('.modal-carrossel').modal('show');
    }

}


//function ativarCarrosselModal() {
//
//    $.ajax({
//        method: "POST",
//        url: retornarVariavelLocal() + 'retornar-detalhe-imovel', //ImovelController
//        async: true,
//        data: {},
//        beforeSend: function () {
//            $('#galeria-full').empty();
////            $('#galeria').hide();
//
//            $('#galeria-mini').empty();
////            $('#galeria-full').hide();
//
//        }
//    }).done(function (dados) {
//        
//        console.log(dados);debugger;
//
//        $.each(dados.imovel.fotos, function (key, f) {
//
//            let fotorr = '<div class="card card-modal d-flex align-items-center">' +
//                    '<img class="img-modal lazyload" data-src="' + f.url + '" alt="Card image cap" />' +
//                    '</div>';
//
//            //$('#galeria-full').slick('slickAdd', foto);
//            $('#galeria-full').append(fotorr);
//        });
//
//    }).then(function (dados) {
//
//        $.each(dados.imovel.fotos, function (key, f) {
//
//            let foto = '<div class="card card-img-modal-mini d-flex align-items-center">' +
//                    '<img class="img-model-mini lazyload" data-src="' + f.urlpp + '" alt="Card image cap" />' +
//                    '</div>';
//
//            //$('#galeria-mini').slick('slickAdd', foto);
//            $('#galeria-mini').append(foto);
//
//        });
//
//    }).then(function () {
//
//        //$('#galeria').show('slow');
//
//        $('#galeria-full').slick({
//            slidesToShow: 1,
//            slidesToScroll: 1,
//            arrows: false,
//            fade: true,
//            asNavFor: '#galeria-mini'
//        });
//
//        $('#galeria-mini').slick({
//            slidesToShow: 10,
//            slidesToScroll: 5,
//            asNavFor: '#galeria-full',
//            dots: false,
//            centerMode: false,
//            focusOnSelect: true,
//            responsive: [{
//                    breakpoint: 1500,
//                    settings: {
//                        slidesToShow: 5,
//                        slidesToScroll: 5,
//                        infinite: false,
//
//                    }
//                },
//                {
//                    breakpoint: 779,
//                    settings: {
//                        slidesToShow: 2,
//                        slidesToScroll: 2,
//                        infinite: false,
//                        centerMode: true,
//
//                    }
//                },
//                {
//                    breakpoint: 480,
//                    settings: {
//                        slidesToShow: 2,
//                        slidesToScroll: 2,
//                        infinite: false,
//                        centerMode: true,
//                        centerPadding: '20px',
//                    }
//
//                }, {
//                    breakpoint: 375,
//                    settings: {
//                        slidesToShow: 2,
//                        slidesToScroll: 2,
//                        infinite: false,
//                        centerMode: true,
//                        centerPadding: '20px',
//                    }
//
//                }
//                // You can unslick at a given breakpoint now by adding:
//                // settings: "unslick"
//                // instead of a settings object
//            ]
//        });
//
//        var galeriaFull = $('#galeria-full');
//
//        $('.arrow-left-modal').click(function () {
//            galeriaFull.slick('slickPrev');
//        });
//
//        $('.arrow-right-modal').click(function () {
//            galeriaFull.slick('slickNext');
//        });
//
//
//        $('#fechar-modal').click(function () {
//            $('.modal-carrossel').modal('hide');
//        });
//
//        $('.modal-carrossel').on('show.bs.modal', function (e) {
//
//        });
//
//        $('.modal-carrossel').on('hidden.bs.modal', function (e) {
//            // $('.modal-carrossel').modal('dispose');
//        });
//
//
//    }).then(function () {
//
//    }).always(function () {
//
//        //$('#galeria').show('slow');
//
//        // $('#id-gif').hide();
//    });
//
//}
;

//CARREGAR DESTAQUES DINAMICAMENTE
function carregarDados() {

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-detalhe-imovel', //ImovelController
        async: true,
        data: {},
        beforeSend: function () {
            //$('#id-gif').show();
            $('#galeria').empty();
            // $('#cont-fotos').hide();

        }
    }).done(function (dados) {

        ativarGaleria();

        let foto ='';
        let fotofull ='';
        let fotomini ='';

        $.each(dados.imovel.fotos, function (key, f) {

            if (key < 5){

                foto += '<div onclick="ativarModal()" class="card card-galeria d-flex align-items-center">' +
                    '<img class="card-img-top" src="' + f.url + '" alt="' + f.descricao + '" />' +
                    '</div>';

                fotofull += '<div class="card card-modal d-flex align-items-center">' +
                    '<img class="img-modal" src="' + f.url + '" alt="' + f.descricao + '" />' +
                    '</div>';

                fotomini += '<div class="card card-img-modal-mini d-flex align-items-center">' +
                    '<img class="img-model-mini" src="' + f.urlpp + '" alt="' + f.descricao + '" />' +
                    '</div>';

            } else {

                foto += '<div onclick="ativarModal()" class="card card-galeria d-flex align-items-center">' +
                    '<img class="card-img-top lazyload" data-src="' + f.url + '" alt="' + f.descricao + '" />' +
                    '</div>';

                fotofull += '<div class="card card-modal d-flex align-items-center">' +
                    '<img class="img-modal lazyload" data-src="' + f.url + '" alt="' + f.descricao + '" />' +
                    '</div>';

                fotomini += '<div class="card card-img-modal-mini d-flex align-items-center">' +
                    '<img class="img-model-mini lazyload" data-src="' + f.urlpp + '" alt="' + f.descricao + '" />' +
                    '</div>';

            }
            

        });

        $('#galeria').slick('slickAdd', foto);
        $('#galeria-full').append(fotofull);
        $('#galeria-mini').append(fotomini);

        $('#galeria-full').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '#galeria-mini'
        });

        $('#galeria-mini').slick({
            slidesToShow: 10,
            slidesToScroll: 5,
            asNavFor: '#galeria-full',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            responsive: [{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: false,

                }
            },
            {
                breakpoint: 779,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: false,
                    centerMode: true,

                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: false,
                    centerMode: true,
                    centerPadding: '20px',
                }

            }, {
                breakpoint: 375,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: false,
                    centerMode: true,
                    centerPadding: '20px',
                }

            }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        var galeriaFull = $('#galeria-full');

        $('.arrow-left-modal').click(function () {
            galeriaFull.slick('slickPrev');
        });

        $('.arrow-right-modal').click(function () {
            galeriaFull.slick('slickNext');
        });


        $('#fechar-modal').click(function () {
            $('.modal-carrossel').modal('hide');
        });

        $('.modal-carrossel').on('show.bs.modal', function (e) {

        });

        $('.modal-carrossel').on('hidden.bs.modal', function (e) {
            // $('.modal-carrossel').modal('dispose');
        });



    }).then(function () {

        // ativarCarrosselModal();
        // $('#cont-fotos').shows();

    }).then(function () {

    }).always(function () {

    });
}

carregarDados();
//CARREGAR DESTAQUES  DINAMICAMENTE

