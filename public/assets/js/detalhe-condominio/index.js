

//ATIVAR O CARRSSEL DOS IMÓVEIS SIMILARES
function ativarGaleriaSlick() {


    debugger;
    //SLICK CARROSSEL DE DESTAQUES HOME
    $('#galeria-imagens').slick({
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

    var galeria = $('#galeria-imagens');

    $('.arrow-left-imovel').click(function () {
        galeria.slick('slickPrev');
    });

    $('.arrow-right-imovel').click(function () {
        galeria.slick('slickNext');
    });

    //quando chegar no final do carrossel
    galeria.on('edge', function (event, slick, direction) {
        if (direction == 'left') {
            //acao aqui
        }
    });
}

ativarGaleriaSlick();


$('.btn-acao-rolagem').click(function () {

    targetOffset = $($(this).attr('data-link-id')).offset().top;

    $('html, body').animate({
        scrollTop: targetOffset - 50
    }, 500);


});




Fancybox.bind("[data-fancybox='gallery']", {
    Thumbs: {
      autoStart: true, // Mostra as miniaturas automaticamente
    },
    Toolbar: {
      display: ["zoom", "fullscreen", "close"], // Ícones na barra de ferramentas
    },
    Carousel: {
      transition: "slide", // Efeito de transição entre slides
    },
    caption: function (fancybox, carousel, slide) {
      return slide.$trigger.alt || "Sem legenda"; // Usa o atributo alt como legenda
    },
  });



  

