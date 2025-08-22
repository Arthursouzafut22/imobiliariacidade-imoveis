$('#carrosel-sobre').slick({
    dots: false,
    infinite: false,
    speed: 300,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 4,
    autoplay: true,
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

var sobre = $('#carrosel-sobre');

$('.arrow-left').click(function () {
    sobre.slick('slickPrev');
});

$('.arrow-right').click(function () {
    sobre.slick('slickNext');
});


Fancybox.bind("[data-fancybox]", {});
