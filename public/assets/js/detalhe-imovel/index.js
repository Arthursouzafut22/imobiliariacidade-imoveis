
var paramSimilares = imovel;

//CARREGAR MAPA
function carregarMapa(m) {
    var uluru = { lat: parseFloat(m.latitude), lng: parseFloat(m.longitude) };

    var map = new google.maps.Map(
        document.getElementById('map'), { zoom: 15, center: uluru });

    // var marker = new google.maps.Marker({position: uluru, map: map});

    var cityCircle = new google.maps.Circle({
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
        map,
        center: uluru,
        radius: Math.sqrt(20) * 100,
    });

    //            var latitude =  parseFloat(m.imovel.latitude);
    //            var longitude = parseFloat(m.imovel.longitude);
    //
    //            console.log(latitude + " " + longitude);
    //
    //            var svService = new google.maps.StreetViewService();
    //            var panoRequest = {
    //                location: {lat: parseFloat(m.imovel.latitude), lng: parseFloat(m.imovel.longitude)},
    //                preference: google.maps.StreetViewPreference.NEAREST,
    //                radius: 100,
    //                source: google.maps.StreetViewSource.OUTDOOR
    //            };
    //
    //            var findPanorama = function(radius) {
    //                panoRequest.radius = radius;
    //                svService.getPanorama(panoRequest, function(panoData, status){
    //                    if (status === google.maps.StreetViewStatus.OK) {
    //                        var panorama = new google.maps.StreetViewPanorama(
    //                            document.getElementById('pano'),
    //                            {
    //                                pano: panoData.location.pano,
    //                            });
    //                    } else {
    //                        //Handle other statuses here
    //                        if (radius > 200) {
    //                            alert("Street View is not available");  
    //                        } else {
    //                            findPanorama(radius + 5);
    //                        }
    //                    }
    //                });     
    //            };
    //
    //            findPanorama(100);


    //CARREGAR STREET VIEW
    //    var panorama = new google.maps.StreetViewPanorama(
    //            document.getElementById('pano'), {
    //        position: {lat: parseFloat(m.imovel.latitude), lng: parseFloat(m.imovel.longitude)},
    //        pov: {heading: 165, pitch: 0},
    //        radius: 100,
    //        motionTracking: true,
    //        motionTrackingControl: true,
    ////        motionTrackingControlOptions: {
    ////            position: google.maps.ControlPosition.LEFT_BOTTOM
    ////        }
    //    });
    //
    //    map.setStreetView(panorama);
}


//BOTÉS DE 
$('#cont-fotos').css('display','flex');

$('#btn-fotos').click(function () {
    $('.container-exibicao').hide();
    $("#cont-fotos").css('display','flex')

    $(".container-controls-360-fixa").css('display', 'none');
});

$('#btn-mapa').click(function () {
    $('.container-exibicao').hide();
    $("#map").fadeIn('slow');

    $(".container-controls-360-fixa").css('display', 'none');

});

$('#btn-rua').click(function () {
    $('.container-exibicao').hide();
    $("#pano").fadeIn('slow');

    $(".container-controls-360-fixa").css('display', 'none');

    var geocoder = new google.maps.Geocoder();
    //var address = "2 Simei Street 3, Singapore, Singapore 529889";
    //var address = "62 Raimunda de Freitas, Ibirite, 32400580";
    var address = imovel.numero + ' ' + imovel.endereco + ',' + imovel.bairro + ', ' + imovel.cidade;

    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();

            console.log(latitude + " " + longitude);

            var svService = new google.maps.StreetViewService();
            var panoRequest = {
                location: results[0].geometry.location,
                preference: google.maps.StreetViewPreference.NEAREST,
                radius: 50,
                source: google.maps.StreetViewSource.OUTDOOR
            };

            var findPanorama = function (radius) {
                panoRequest.radius = radius;
                svService.getPanorama(panoRequest, function (panoData, status) {
                    if (status === google.maps.StreetViewStatus.OK) {
                        var panorama = new google.maps.StreetViewPanorama(
                            document.getElementById('pano'),
                            {
                                pano: panoData.location.pano,
                            });
                    } else {
                        //Handle other statuses here
                        if (radius > 200) {
                            alert("Street View is not available");
                        } else {
                            findPanorama(radius + 5);
                        }
                    }
                });
            };

            findPanorama(50);
        }
    });
});

$('#btn-video').click(function () {
    $('.container-exibicao').hide();
    $("#video").fadeIn('slow');

    $(".container-controls-360-fixa").css('display', 'none');
});

$('#btn-tour').click(function () {
    $('.container-exibicao').hide();
    $("#tour-virtual").fadeIn('slow');

    $(".container-controls-360-fixa").css('display', 'none');
});

$('#btn-foto-360').click(function () {

    $('.container-exibicao').hide();
    $("#imagens360").fadeIn();
    $('.container-controls-360-fixa').css('display', 'flex');

    setTimeout(function () {
        initPano(fotos360)
    }, 300)


});

$('.btn-close-360').click(function () {
    $('#carrossel-foto360').slick('unslick');
    $('#carrossel-foto360').empty();
    $(".modal-foto-360").css('display', 'none');
})

$.ajax({
    method: "POST",
    url: retornarVariavelLocal() + 'retornar-detalhe-imovel',
    async: true,
    data: {},
    beforeSend: function () {
        $('#faculdade-proximas').empty();
    }
}).done(function (dados) {


    $('.cont-fav').text(dados.favoritos.length);

    let cod = $('#cod-principal').text();

    //VERIFICAR SE O ÍMOVEL ESTÁ MARCADO COMO FAVORITOS
    $.each(dados.favoritos, function (i, c) {
        if (cod == c) {
            $('#fovoritos-principal').children().attr('src', retornarVariavelLocal() + 'assets/icons/icon-favorito-ativo.svg');
            $('#fovoritos-principal').addClass('active');
        }
    });

    imovel = dados
    fotos360 = imovel.fotos360;

    let srcVideo = retornarUrlVideoTratada(dados.urlvideo);

    $('#ifram-video').attr("src", srcVideo);
    $('#ifram-tour').attr("src", dados.urlpublica);
    carregarMapa(dados);

    carregarImoveisSimilares();

}).then(function (dados) {

}).always(function () {
});


/*
 * 
 * ==============================
 * ====== GOOGLE PLACES =========
 * ==============================
 * 
 * 
 */
const str = 'ÁÉÍÓÚáéíóúâêîôûàèìòùÇç/.,~!@#$%&_12345';

function removeAcento(text) {

    text = text.toLowerCase();
    text = text.replace(new RegExp('[ÁÀÂÃ]', 'gi'), 'a');
    text = text.replace(new RegExp('[ÉÈÊ]', 'gi'), 'e');
    text = text.replace(new RegExp('[ÍÌÎ]', 'gi'), 'i');
    text = text.replace(new RegExp('[ÓÒÔÕ]', 'gi'), 'o');
    text = text.replace(new RegExp('[ÚÙÛ]', 'gi'), 'u');
    text = text.replace(new RegExp('[Ç]', 'gi'), 'c');

    return text;
}


//ATIVAR O CARRSSEL DOS IMÓVEIS SIMILARES
function initSlckSimilares() {

    //SLICK CARROSSEL DE DESTAQUES HOME
    $('#carrossel_imoveis_similares').slick({
        dots: false,
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        responsive: [{
            breakpoint: 1400,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: false,
            }
        },
        {
            breakpoint: 1280,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: false,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                centerPadding: '20px',
            }

        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                centerPadding: '20px',
            }

        }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    var desta = $('#carrossel_imoveis_similares');

    $('.arrow-left-imovel').click(function () {
        desta.slick('slickPrev');
    });

    $('.arrow-right-imovel').click(function () {
        desta.slick('slickNext');
    });

    //quando terminar de passar o carrossel
    desta.on('edge', function (event, slick, direction) {
        if (direction == 'left') {
            //acao aqui
        }
    });
}

//CARREGAR DESTAQUES
function carregarImoveisSimilares() {

    imovel.codigofinalidade = imovel.codigofinalidade;
    imovel.codigocidade = imovel.codigocidade;

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-imoveis-similares', //ImovelController
        async: true,
        data: imovel,
        beforeSend: function () {
            $('#carrossel_imoveis_similares').empty();
            $('.gif-silimares').show();
        }
    }).done(function (imovel) {


        //verifico maior que 1, porque eu sempre vou trazer o proprio imóvel
        if (imovel.lista.length >= 1) {

            $(".section_imoveis_similares").css("display", "block");

            initSlckSimilares();

            let fav = Object.values(imovel.favoritos);
            imovel.favoritos = fav;

            $('.cont-fav').text(imovel.favoritos.length);

            let cod = $('#cod-principal').text();

            //VERIFICAR SE O ÍMOVEL ESTÁ MARCADO COMO FAVORITOS

            $.each(imovel.favoritos, function (i, c) {

                if (cod == c) {

                    $('#fovoritos-principal').children().attr('src', retornarVariavelLocal() + 'assets/icons/icon-favorito-ativo.svg');
                    $('#fovoritos-principal').addClass('active');
                }
            });

            $.each(imovel.favoritos, function (key, f) {

                $.each(imovel.lista, function (key2, imoveis) {

                    if (imovel.favoritos[key] == imoveis.codigo) {

                        imovel.lista[key2].favoritos = true;
                    } else {
                        imovel.lista[key2].favoritos = false;
                    }

                });
            });


            $.each(imovel.lista, function (key, imo) {

                $('#carrossel_imoveis_similares').slick('slickAdd', retornarCardImovel(imo));

            });

        } else {
            //esconde a section pois não temos semelhantes
            $(".carrossel_similares").fadeOut();
            $(".form_section_detalhes_imovel").css("margin-bottom", "0px");
        }

    }).then(function () {
        $('.gif-silimares').hide();
    }).always(function () {
    });

}



//EXIBIR O BOTAP DE COMPARTILHAMENTO
$('.icon-share').click(function () {
    $('#container-share').fadeToggle('slow');
});

// quando caregar o documento
window.onload = (event) => {
    
    // pega a altura do box a esquerda
    let height = $(".cont-call-to-action").height();
    
    // defini altura minima do conteudo a direita
    $(".container-esquerda").css("min-height", ""+height+"px");
};


//quando o documento carregar
$(document).ready(function () {

    //se tiver caracteristicas extras mostro a section
    if ($(".caracteristicas-extras li.extras-active").length > 0) {
        $(".section_caracteristicas_extras").fadeIn();
    }

    //se tiver caracteristicas internas mostro a section
    if ($(".caracteristicas-internas li.extras-active").length > 0) {
        $(".section_caracteristicas_internas").fadeIn();
    }

    //se tiver caracteristicas externas mostro a section
    if ($(".caracteristicas-externas li.extras-active").length > 0) {
        $(".section_caracteristicas_externas").fadeIn();
    }

    //pego a altura do container da esquerda e aplico no da direita
    if ($(window).width() > 575) {
        let tamanhoColEsquerda = $(".container-esquerda").height() - 140; //140 é o tamanho do box anunciar imovel que fica abaixo desse elemento
        $(".container-direito-nivel-1").css("height", "" + tamanhoColEsquerda + "px");
    }
});


$('.btn-actions-favoritos').click(function () {
    favoritar($(this).attr('codigo'))
})




function retornarImoveisEmpreendimentosFilhosDisponiveis() {

    $('#container-imoveis-filho').empty();
    
    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-imoveis-empreendimentos-filho',
        async: true,
        data: {
            'codigo': $('#cod-principal-form').text(),
            'pagina': 1,
        },
        beforeSend: function () {
            $('#container-imoveis-filho').show();
        }
    }).done(function (imovel) {

        let fav = Object.values(imovel.favoritos);
        imovel.favoritos = fav;

        if(imovel.lista.length <= 0){
            $('#secao-empreendimentos-filho').css('display','none')
        }

        $.each(imovel.favoritos, function (key, f) {

            $.each(imovel.lista, function (key2, imoveis) {

                if (imovel.favoritos[key] == imoveis.codigo) {

                    imovel.lista[key2].favoritos = true;
                } else {
                    imovel.lista[key2].favoritos = false;
                }

            });
        });
        
        //lista de imoveis 
        $.each(imovel.lista, function (key, imo) {
            $('#container-imoveis-filho').append('<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 wrap_card_imovel" data-local="3">' + retornarCardImovel(imo) + '</div>');
        });

    }).then(function (imovel) {

    });
}


if($('#EXIBIR_LACAMENTO_EM_MODAL').val() == 0){

    retornarImoveisEmpreendimentosFilhosDisponiveis();
}

