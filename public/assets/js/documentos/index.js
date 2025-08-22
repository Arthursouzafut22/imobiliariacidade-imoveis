$('#carrossel-depoimentos').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    arrows: false,
});

var depoimentos = $('#carrossel-depoimentos');
$('#anterior-depoimento').click(function () {
    depoimentos.slick('slickPrev');
});
$('#proximo-depoimento').click(function () {
    depoimentos.slick('slickNext');
});



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




// var nav;
// Modernizr.on('webp', function (result) {

//     if (result) {
//         nav = true;

//     } else {

//         nav = false;

//     }

// });



// $(document).ready(function () {

//     $(document).on('scroll', function () {
//         loadImage();
//     });

//     (loadImage = function () {

//         var image = $(".img-webp");
//         var url = image.data("url");
//         image.attr('src', url);

//         $.each($('.img-webp'), function () {

//             var block = $(this);
//             var image = block;

//             if (isOnScreen(block)) {

//                 var url;

//                 if (nav) {
//                     url = image.data('webp');
//                 } else {
//                     url = image.data('original');
//                 }

//                 if (image.attr('src') != url) {

//                     image.attr("src", url);
//                     image.addClass('teaser');

//                 }
//             }

//         });

//     })();
// });

// function isOnScreen(element) {

//     var win = $(window);

//     var screenTop = win.scrollTop();
//     var screenBottom = screenTop + win.height();

//     var elementTop = element.offset().top;
//     var elementBottom = elementTop + element.height();

//     return elementBottom > screenTop && elementTop < screenBottom;

// }


