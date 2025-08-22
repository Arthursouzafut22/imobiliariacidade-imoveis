var fotos360 = '';

//varivael que recebe as URLs das fotos
var urlParaStreetView = '';

//SLICK FOTO 360 NAV
function initialFoto360() {

    $('#imagens360').slick({
        dots: false,
        arrows: false,
        infinite: false,
        draggable: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        centerMode: false,
        pauseOnHover: true,
        centerPadding: '50px',
        focusOnSelect: true,
        // asNavFor: '#carrossel-foto360',
        responsive: [{
            breakpoint: 1280,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
            }
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 1,
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

        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                centerPadding: '20px',
            }

        }]
    });

    var desta = $('#imagens360');

    $('#arrow-360-left-c1').click(function () {
        desta.slick('slickPrev');
    });

    $('#arrow-360-right-c1').click(function () {
        desta.slick('slickNext');
    });

    desta.on('edge', function (event, slick, direction) {


        if (direction == 'left') {

        }
    });
}


//AÇÃO DAS SETAS PARA ESQUERDA DO MODAL DE FOTOS
$('#arrow-360-left').click(function () {
    let obj = $(this);
    if (parseInt($(obj).attr('code-imge')) == 0){
        return false
    }

    $.each(fotos360, function (i, foto) {

        if ((parseInt($(obj).attr('code-imge')) - 1) == i) {

            const panorama = new google.maps.StreetViewPanorama(
                document.getElementById("carrossel-foto360"),
                { pano: "reception", visible: true },
            );

            // panorama.setPov(
            //     /** @type {google.maps.StreetViewPov} */ {
            //       heading: 500,
            //       pitch: 300,
            //     }
            //   );

            urlParaStreetView = foto.url;
            panorama.registerPanoProvider(getCustomPanorama);

            $(obj).attr('code-imge', i);
            $('#arrow-360-right').attr('code-imge', i);
            return false;
        }
    });
});


//AÇÃO DA SETAS PARA DIREITA DO MODAL DE FOTOS
$('#arrow-360-right').click(function () {

    let obj = $(this);
    if (parseInt($(obj).attr('code-imge')) == fotos360.length){
        return false
    }

    $.each(fotos360, function (i, foto) {

        if ((parseInt($(obj).attr('code-imge')) + 1) == i) {

            const panorama = new google.maps.StreetViewPanorama(
                document.getElementById("carrossel-foto360"),
                { pano: "reception", visible: true },
            );

            // panorama.setPov(
            //     /** @type {google.maps.StreetViewPov} */ {
            //       heading: 500,
            //       pitch: 300,
            //     }
            //   );


            urlParaStreetView = foto.url;
            panorama.registerPanoProvider(getCustomPanorama);

            $(obj).attr('code-imge', i);
            $('#arrow-360-left').attr('code-imge', i);

            return false;
        }
    });

});


function initPano(fotos360) {
    // Set up Street View and initially set it visible. Register the
    // custom panorama provider function. Set the StreetView to display
    // the custom panorama 'reception' which we check for below.

    if ($('#imagens360').slick() !== undefined) {
        $('#imagens360').slick('destroy');
    }

    $('#imagens360').empty();

    urlParaStreetView = '';

    $.each(fotos360, function (i, foto) {


        let item = $('<div>')
            .attr('id', 'item-' + i + '')
            .addClass('item-foto')
            .append($('<img>').attr('src', foto.url))
            .click(function () {

                $('.modal-foto-360').css('display', 'block');

                if ($('#carrossel-foto360').slick() !== undefined) {
                    $('#carrossel-foto360').slick('destroy');
                }


                $('#arrow-360-left').attr('code-imge', i);
                $('#arrow-360-right').attr('code-imge', i);


                const panorama = new google.maps.StreetViewPanorama(
                    document.getElementById("carrossel-foto360"),
                    { 
                        pano: "reception", 
                        visible: true, 
                        
                    },
                    
                );

                // panorama.setPov(
                // /** @type {google.maps.StreetViewPov} */ {
                //       heading: 500,
                //       pitch: 300,
                //     }
                // );

                urlParaStreetView = foto.url;
            
                panorama.registerPanoProvider(getCustomPanorama);

            });

        $('#imagens360').append(item);
    });


    urlParaStreetView = '';
    initialFoto360();

}

// Return a pano image given the panoID.
function getCustomPanoramaTileUrl(pano, zoom, tileX, tileY, url) {
    return (urlParaStreetView);
}

// Construct the appropriate StreetViewPanoramaData given
// the passed pano IDs.
function getCustomPanorama(pano) {

    if (pano === "reception") {
        return {
            location: {
                pano: "reception",
            },
            zoom_changed: 8000,
            links: [],
            // The text for the copyright control.
            // The definition of the tiles for this panorama.
            tiles: {
                tileSize: new google.maps.Size(1024, 512),
                worldSize: new google.maps.Size(1024, 512),
                // The heading in degrees at the origin of the panorama
                // tile set.
                centerHeading: 105,
                getTileUrl: getCustomPanoramaTileUrl,
            },
        };
    }
    // @ts-ignore TODO fix typings
    return null;
}


