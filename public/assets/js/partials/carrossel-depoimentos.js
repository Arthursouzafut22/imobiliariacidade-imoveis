$('#carrossel-depoimentos').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    arrows: false,
    responsive: [
        {
            breakpoint: 3000,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
            }
        },
        {
            breakpoint: 1600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
            }
        },
        {
            breakpoint: 1277,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                centerPadding: '60px',
            }
        },
        {
            breakpoint: 779,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                centerMode: true,
                centerPadding: '60px',
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
    ]
});

let depoimentos = $('#carrossel-depoimentos');

$('#anterior-depoimento').click(function () {
    depoimentos.slick('slickPrev');
});
$('#proximo-depoimento').click(function () {
    depoimentos.slick('slickNext');
});