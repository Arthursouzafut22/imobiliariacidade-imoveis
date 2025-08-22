$('#carrossel_blog').slick({
    dots: true,
    arrows: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    dotsClass: $('.slick-slider-dots-blog'),
    appendDots: $('.slick-slider-dots-blog'),
    centerMode: false,
    centerPadding: '50px',
    responsive: [{
            breakpoint: 1280,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
            }
        },
        {
            breakpoint: 991,
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

var blogCarrossel = $('#carrossel_blog');

$('.arrow-left').click(function () {
    blogCarrossel.slick('slickPrev');
});

$('.arrow-right').click(function () {
    blogCarrossel.slick('slickNext');
});

//quando terminar de passar o carrossel
blogCarrossel.on('edge', function (event, slick, direction) {
    if (direction == 'left') {
        // acao aqui
    }
});

//Escondeno marcadores quando tiver apenas 4 itens na tela
blogCarrossel.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
    var slideCount = slick.slideCount;

    if(slideCount <= 4 && window.screen.width >= 991){
        $('.slick-slider-dots-blog').hide();
    } else {
        $('.slick-slider-dots-blog').show();
    }
});



