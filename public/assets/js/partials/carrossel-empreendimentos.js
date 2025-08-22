$('#carrossel_empreendimentos').slick({
    dots: true,
    arrows: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    dotsClass: $('.slick-slider-dots-banners'),
    appendDots: $('.slick-slider-dots-banners'),
    centerMode: false,
    centerPadding: '50px',
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

        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


var carrossel_empreendimentos = $('#carrossel_empreendimentos');


$('.seta_left_empreendimento').click(function () {
    carrossel_empreendimentos.slick('slickPrev');
});

$('.seta_right_empreendimento').click(function () {
    carrossel_empreendimentos.slick('slickNext');
});

//quando terminar de passar o carrossel
carrossel_empreendimentos.on('edge', function (event, slick, direction) {
    if (direction == 'left') {
        // acao aqui
    }
});


