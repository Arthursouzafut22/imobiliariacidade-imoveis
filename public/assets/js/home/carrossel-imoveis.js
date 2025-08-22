function initSlcik() {

  //SLICK CARROSSEL DE DESTAQUES HOME
  $('#carrossel_destaques_imoveis').slick({
        dots: false,
        arrows: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
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
                    slidesToShow: 2,
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

    var desta = $('#carrossel_destaques_imoveis');

    $('.arrow-left-imovel').click(function () {
        desta.slick('slickPrev');
    });

    $('.arrow-right-imovel').click(function () {
        desta.slick('slickNext');
    });
    //quando terminar de passar o carrossel 
    desta.on('edge', function (event, slick, direction) {
        if (direction == 'left') {
            // acao aqui
        }
    });
}

//CARREGAR DESTAQUES
function carregarDestaques(tipoCarrossel = "destaque", finalidade = "venda") {
    //debugger;

    //variaveis padroes do carrossel
    rota = "retornar-destaques";
    imovel.finalidade = 2;
    imovel.numeropagina = 1;
    imovel.numeroregistros = 20;
    imovel.destaque = 2;
    

    // defini a rota de acordo com o tipoCarrossel
    if (tipoCarrossel == "super-destaque") {
      imovel.destaque = 3;
    }

    // se a finalidade for aluguel
    if(finalidade == 'aluguel') {
      imovel.finalidade = 1;
    }

    $.ajax({
      method: "POST",
      url: retornarVariavelLocal() + rota,
      async: true,
      data: imovel,
      beforeSend: function () {
        $("#id-gif").show();
        $("#carrossel_destaques_imoveis").empty();
      },
    })
      .done(function (imovel) {
        initSlcik();

      
        let fav = Object.values(imovel.favoritos);
        imovel.favoritos = fav;

        $(".cont-fav").text(imovel.favoritos.length);

        //ATUALIZAR FAVORITOS QUANDO CARREGAR A PAGINA
        $("#cont-fav").text(imovel.favoritos.length);

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
          $("#carrossel_destaques_imoveis").slick("slickAdd", retornarCardImovel(imo));
        });

        
      })
      .then(function () {})
      .always(function () {
        $("#id-gif").hide();
      });
}

