var map = {};
var markerCluster = {};
var ajaxID = 1;
var codpaginacao = '';
var mapActive = false;
var markersArray = [];


$('#button_check_mapa').click(function () {

    //VAMOS ATIVAR A LISTAGEM
    if (mapActive) {

        mapActive = false;

        $('#ordenacao').show();

        //escondo o mapa
        $('#container_lista_imoveis_right_mapa').css('display', 'none');

        //mostra a listagem
        $('#wrap_listagem_imoveis').css('display', 'flex');
        $('#wrap_paginacao').css('display', 'flex');

        //muda o texto do botao
        $('#button_check_mapa').text("Exibir Mapa");

        //coloca o col left fixo e 100%
        $("#container_lista_imoveis_left").css("overflow-y", "initial").css("height", "initial");

        numeroRegistrosBusca = 16;
        retornarImoveisDisponiveis();

    } 
    // VAMOS ATIVAR O MAPA
    else {
        
        mapActive = true;

        $('#ordenacao').hide();

        //esconde a listagem
        $('#wrap_listagem_imoveis').css('display', 'none');
        $('#wrap_paginacao').css('display', 'none');
        
        //mostra o mapa
        $('#container_lista_imoveis_right_mapa').css('display', 'flex');
        
        //muda o texto do botao
        $('#button_check_mapa').text("Exibir Lista");

        //coloca o col left fixo e 100%
        let height = "" + $("#header").height() + "px";
        $("#container_lista_imoveis_left").css("overflow-y", "auto").css("height", "calc(100vh - "+ height +")");


        //$('#button_check_mapa').empty();
        //$('#button_check_mapa').append('<span>Mais Filtros</span> <span class="material-symbols-outlined">format_list_bulleted</span>');

        if (EXIBIR_ENDERECO) {
            if (mapActive) {
                initMap();
                numeroRegistrosBusca = 1000;
                retornarImoveisDisponiveis();
            }
        }
    }
});


const Allmarker = {};

function initMap() {

    // console.log()

    map = new google.maps.Map(document.getElementById('map'), {
        center: lat_lng,
        //disableDefaultUI: true,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: true,
        fullscreenControl: false,
        zoom: 12,
        minZoom: 2,
        maxZoom: 18,
    });

    //set style options for marker clusters (these are the default styles)
    let mcOptions = {
        styles: [{
            height: 53,
            url: retornarVariavelLocal() + "assets/images/mapa/circulo-53.png",
            width: 53
        },
        {
            height: 56,
            url: retornarVariavelLocal() + "assets/images/mapa/circulo-56.png",
            width: 56
        },
        {
            height: 66,
            url: retornarVariavelLocal() + "assets/images/mapa/circulo-66.png",
            width: 66
        },
        {
            height: 78,
            url: retornarVariavelLocal() + "assets/images/mapa/circulo-78.png",
            width: 78
        },
        {
            height: 90,
            url: retornarVariavelLocal() + "assets/images/mapa/circulo-90.png",
            width: 90
        }],

        // averageCenter: false,
        zoomOnClick: true
    }

    //init clusterer with your options
    markerCluster = new MarkerClusterer(
        map,
        {},
        mcOptions
    );

    // markerCluster.getAverageCenter(false);
    google.maps.event.addListener(markerCluster, 'clusterclick', function (cluster) {

        //  map.options.resize = 'false';
        // cluster.setZoomOnClick = false;
        map.setOptions({
            resize: false,
            //     scrollwheel:false,
            //     zoomControl: true,
            //     gestureHandling: 'none',
            //     disableDoubleClickZoom: true
        });

        var markers = cluster.getMarkers();

        let cod = '';
        $.each(markers, function (i, m) {
            cod += m.idImovel + ',';
        });

        codpaginacao = cod;

        // carregarCodigos(cod);

        if (map.getZoom() >= 18) {

            $('.modal-cards-mapa ').show();

            // var contentString = '<div class="point-mapa" id="id_' + imo.codigo + '"></div>';
            // $('.container-cards-mapa').append(contentString);

            $.ajax({
                method: "POST",
                url: retornarVariavelLocal() + 'retornar-imoveis-codigo', //ImovelController
                async: true,
                data: {
                    'codigo': codpaginacao,
                    'pagina': 1
                },
                beforeSend: function () {
                    $('.container-cards-mapa').empty();
                }
            }).done(function (imoveis) {

                $.each(imoveis.lista, function (key, imovel) {
                    var novoConteudo = retornarCardImovel(imovel)

                    $('.container-cards-mapa').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3" data-local="4">'+novoConteudo+'</div>');
                });

            }).fail(function () {

            }).then(function () {

                ativarCarrosselModalMapa();

            }).always(function () {

            });

        }

    });


    // map.addListener('idle', function () {
    //     $('#result-busca-map').empty();
    //     var bounds = map.getBounds();
    //     var southWest = bounds.getSouthWest();
    //     var northEast = bounds.getNorthEast();

    //     var limitMapa = {};

    //     limitMapa.sudoeste_latitude = southWest.lat();
    //     limitMapa.sudoeste_longitude = southWest.lng();
    //     limitMapa.nordeste_latitude = northEast.lat();
    //     limitMapa.nordeste_longitude = northEast.lng();

    //     let aux = '';

    //     $.each(markerCluster.markers_, function (x, mk) {
    //         if (map.getBounds().contains({ lat: mk.lat, lng: mk.lng })) {
    //             aux += mk.idImovel + ',';
    //         }
    //     });


    //     codpaginacao = aux;
    //     if (mapActive) {
    //          carregarCodigos(aux);
    //     }

    //     //var teste = markers.getMarkers();
    //     //check_is_in_or_out(bounds, limitMapa);
    // });

}

function clearClusterMarkers() {
    if (markerCluster) {
        markerCluster.clearMarkers(); // Remove todos os marcadores do cluster
    }
}

function addmarker(im) {

    codpaginacao = '';
    clearClusterMarkers();

    $.each(im.lista, function (i, imo) {

        marker = new google.maps.Marker({
            position: { lat: parseFloat(imo.latitude), lng: parseFloat(imo.longitude) },
            idImovel: imo.codigo,
            lat: parseFloat(imo.latitude),
            lng: parseFloat(imo.longitude),
            icon: retornarVariavelLocal() + 'assets/images/mapa/maker-mini.png'
        });

        // if (map.getBounds().contains(marker.position)) {
        //     codpaginacao += imo.codigo + ',';
        // }

        marker.addListener('click', function (m) {

            $('.modal-cards-mapa ').show();

            $.ajax({
                method: "POST",
                url: retornarVariavelLocal() + 'retornar-imoveis-codigo', //ImovelController
                async: true,
                data: {
                    'codigo': imo.codigo,
                    'pagina': 1
                },
                beforeSend: function () {
                  
                    $('.container-cards-mapa').empty();
                }
            }).done(function (imoveis) {

                $.each(imoveis.lista, function (key, imovel) {
                    var novoConteudo = retornarCardImovel(imovel)
                    $('.container-cards-mapa').append('<div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">'+novoConteudo+'</div>');
                });

            }).fail(function () {

            }).then(function () {

            }).always(function () {

            });
        });

        markerCluster.addMarker(marker);
        // markersArray.push(marker);
    });


    carregarCodigosPaginacao(1);
}

var imo = imovel;

$('.fechar-carrossel-mapa').click(function () {
    $("#carrossel-map").slick("unslick");
    $("#container-carrossel-map").fadeOut();
});


$('.close-modal-card-mapa').click(function () {
    $('.modal-cards-mapa').hide();
})

