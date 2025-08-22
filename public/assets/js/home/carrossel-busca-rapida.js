$('#carrossel_busca_rapida').slick({
    dots: true,
    arrows: false,
    infinite: false,
    speed: 300,
    slidesToShow: 8,
    slidesToScroll: 4,
    autoplay: true,
    dotsClass: $('.slick-slider-dots-busca-rapida'),
    appendDots: $('.slick-slider-dots-busca-rapida'),
    centerMode: false,
    centerPadding: '50px',
    responsive: [{
            breakpoint: 1280,
            settings: {
                slidesToShow: 8,
                slidesToScroll: 4,
                infinite: false,
            }
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 3,
                infinite: false,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                centerPadding: '20px',
            }

        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
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

var desta = $('#carrossel_busca_rapida');

$('.arrow-left').click(function () {
    desta.slick('slickPrev');
});

$('.arrow-right').click(function () {
    desta.slick('slickNext');
});
//quando terminar de passar o carrossel
desta.on('edge', function (event, slick, direction) {
    if (direction == 'left') {
        //acao
    }
});


