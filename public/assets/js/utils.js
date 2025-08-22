const APIMAPA = '';
const EXIBIR_ENDERECO = true;

var REGIAO_LOCALIZACAO_BASE = $("#REGIAO_LOCALIZACAO_BASE").val();
var STR_REGIAO_LOCALIZACAO_BASE= $("#STR_REGIAO_LOCALIZACAO_BASE").val();
var REGIAO_LOCALIZACAO_BASE_URL= $("#REGIAO_LOCALIZACAO_BASE_URL").val();

//onde o mapa vai iniciar
const lat_lng= {}
lat_lng.lat = parseFloat($('#LATITUDE').val());
lat_lng.lng = parseFloat($('#LONGITUDE').val());


$(document).on("click", ".seta_img", function() {
    //debugger;

    let codigoImovel = $(this).attr("data-codimovel");

    $(".img-imovel[data-codimovel='"+codigoImovel+"']").each(function() {

        if($(this).attr("src") == "") {
            let urlImagem = $(this).attr("data-src");
            $(this).attr("src", urlImagem);
        }
    });
});

function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

function ajustarHeightElemento(elemento) {

    let heightMax = 0;
    $(elemento).each(function() {
        if($(this).innerHeight() > heightMax){
            heightMax = $(this).innerHeight();
        }
    });
    
    return heightMax;
}


function retornarCardImovel(imovelObj) {

    //pego as fotos dos imoveis --------------------------------------------------------------------------------------------------
    let AllFotos = "";

    if (imovelObj.fotos.length != 0) {

        $.each(imovelObj.fotos, function (key, fotoItem) {

            if (key == 0) {
                
                AllFotos += 
                `<div class="carousel-item active">
                    <img class="img-imovel" loading="lazy" src="`+fotoItem.urlp+`" data-src="`+fotoItem.urlp+`" data-codimovel="`+imovelObj.codigo+`" alt="`+fotoItem.descricao+`" border="0" />
                </div>
                `;
            } 
            else if (key < 5) { 

                let srcImagemItem = 'src="" data-src="'+fotoItem.urlp+'"';  

                if(key <= 1) {
                    srcImagemItem = 'src="'+fotoItem.urlp+'" data-src="'+fotoItem.urlp+'"';  
                }                
                
                AllFotos += 
                `<<div class="carousel-item" data-numerofoto="`+key+`">
                    <img class="img-imovel" loading="lazy" ` + srcImagemItem + ` data-codimovel="`+imovelObj.codigo+`" alt="`+fotoItem.descricao+`" border="0" />
                </div>
                `;
            }

            if (key == 5) {
                return false;
            }
        });

    } else {

        let srcImagemNaoExiste = 'src="'+retornarVariavelLocal()+'assets/images/imagem-nao-disponivel-'+$("#TEMA_STRING").val()+'.webp" data-src="'+retornarVariavelLocal()+'assets/images/imagem-nao-disponivel-'+$("#TEMA_STRING").val()+'.webp"';

        AllFotos += 
        `<div class="carousel-item active">
            <img class="img-imovel" loading="lazy" `+srcImagemNaoExiste+` alt="imagem imovel" border="0" />
        </div>
        `;
    }



    //pego os dados que vou usar no card para deixar o html do card mais limpo -------------------------------------------------------
    let onClickFavorito = `onClick="favoritar(`+imovelObj.codigo+`)"`;
    let classFavoritoAtivo = imovelObj.favoritos == true ? "card-favoritos-ativo" : "";
    let srcImovel = 'src="' + retornarVariavelLocal() + 'assets/icons/' + (imovelObj.favoritos == true ? "icon-favorito-ativo.svg" : "icon-favorito.svg");
    let urlImovel = retornarVariavelLocal() + "imovel/" + imovelObj.url_amigavel + "/" + imovelObj.codigo + "";
    let stringFinalidade = (imovelObj.codigofinalidade == "2" ? " à venda" : " para alugar ");

    let codigo  = imovelObj.codigo;
    let bairro  = imovelObj.bairro;
    let cidade  = imovelObj.cidade;
    let tipo    = imovelObj.tipo;
    let nomeCondominio  = (imovelObj.nomecondominio != "" && imovelObj.nomecondominio != null ? " no condomínio " + imovelObj.nomecondominio : "");
    let valorImovel = (imovelObj.empreendimento == '1' ? " À partir de " + retornarValor(imovelObj) : retornarValor(imovelObj));
    let metragemImovel = (imovelObj.empreendimento == '1' ? imovelObj.areainterna + " m²" : imovelObj.areainterna + " m²");
    let numeroQuartos = imovelObj.numeroquartos;
    let numeroVagas = imovelObj.numerovagas;
    let numeroBanhos = imovelObj.numerobanhos;
    let valoranterior = imovelObj.valoranterior != 0 && imovelObj.valoranterior != 0.00 ?  retornarValor(imovelObj.valoranterior) : '';

    
    //monto o card do imovel -------------------------------------------------------------------------------------------------------------
    let cardImovel =

    `<div style="position:relative">
        <div class="btn-actions">
            <img src="${retornarVariavelLocal()}assets/icons/${(imovelObj.favoritos == true ? 'icon-favorito-ativo.svg' : 'icon-favorito.svg')}" class="${classFavoritoAtivo}"  id="icon-favoritos-` + codigo + `"  `+onClickFavorito+` />
        </div>
        <a  href="`+ urlImovel + `"  class="meuLink" data-codigo-mae="`+ imovelObj.codigo + `" data-empreendimento="`+ imovelObj.empreendimento + `">
            <div class="link-card-imovel card card_imovel_style">
                <div id="carousel-card-` + codigo + `" class="local2 carousel slide" data-interval="false" data-ride="carousel">
                    ` + getTag(imovelObj)+`
                    <div class="carousel-inner">
                        ` + AllFotos + `
                    </div>
                    <div class="carousel-control-prev seta_img" data-codimovel="`+codigo+`" type="button" data-target="#carousel-card-` + codigo +`" data-slide="prev">
                        <span class="carousel_setinha">&lsaquo;</span>
                        <span class="sr-only">Previous</span>
                    </div>
                    <div class="carousel-control-next seta_img" data-codimovel="`+codigo+`" type="button" data-target="#carousel-card-` + codigo + `" data-slide="next">
                        <span class="carousel_setinha">&rsaquo;</span>
                        <span class="sr-only">Next</span>
                    </div>
                </div>
                <div class="card-body card_imovel_color">
                    <div class="container-endereco">
                        <span class="card-text card_imovel_color">
                            ` + bairro + ` | ` + cidade + `
                        </span>
                        <span class="preco-cond-card card_imovel_color">
                            Código. ` + codigo + `
                        </span>
                        <span class="preco-cond-card card_imovel_color">
                            Código. ` + codigo + ` 
                        </span>
                    </div>
                    <h2 class="card-title card_imovel_color">
                        ` + tipo + ` ` + stringFinalidade + ` no ` + bairro  + ` ` + nomeCondominio + `
                    </h2>
                    <div class="preco-imovel-card card_imovel_color_destaque">
                        <s>${valoranterior}</s>
                        <strong>
                            ` + valorImovel + `
                        </strong>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="container-icon">
                        <img class="lazyload" src="`+retornarVariavelLocal()+`assets/icons/icons-tema-`+$("#TEMA_STRING").val()+`/icon-area.svg" width="20" border="0"  />
                        <span class="card_imovel_color">` + metragemImovel + `</span>
                        <span>Área principal</span>
                    </div>
                    <div class="container-icon">
                        <img class="lazyload" src="`+retornarVariavelLocal()+`assets/icons/icons-tema-`+$("#TEMA_STRING").val()+`/icon-bed.svg" width="20" border="0"  />
                        <span class="card_imovel_color">` + numeroQuartos + `</span>
                        <span>quarto(s)</span>
                    </div>
                    <div class="container-icon">
                        <img class="lazyload" src="`+retornarVariavelLocal()+`assets/icons/icons-tema-`+$("#TEMA_STRING").val()+`/icon-garage.svg" width="20" border="0"  />
                        <span class="card_imovel_color">` + numeroVagas + `</span>
                        <span>Vaga(s)</span>
                    </div>
                    <div class="container-icon">
                        <img class="lazyload" src="`+retornarVariavelLocal()+`assets/icons/icons-tema-`+$("#TEMA_STRING").val()+`/icon-shower.svg" width="20" border="0"  />
                        <span class="card_imovel_color">` + numeroBanhos + `</span>
                        <span>banho(s)</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    `;
    
    return cardImovel;
}

function retornarValor(param){
    if(param.empreendimento == '1'){
        let valorEmpreendimento = param.valor.split('até');
        return valorEmpreendimento[0].toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})
    }

    return param.valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})
}


function desabilitarCampoParaLancamentos() {

    $('.fild-hide').css('cursor', 'not-allowed');
    $('.fild-hide').find('input').prop("disabled", true);
    $('.fild-hide').find('input').css('cursor', 'not-allowed');
    $('.fild-hide').find('select').css('cursor', 'not-allowed');
    $('.fild-hide').prop("disabled", true);

    $(".btn-circle").css("pointer-events", 'none')
    $(".btn-circle").css("cursor", 'not-allowed')
    $(".btn-circle").css("opacity", '0.5')
    $(".fild-hide").css("opacity", '0.5')
}

function habilitarCampoParaLancamentos() {
    $('.fild-hide').css('cursor', 'pointer');
    $('.fild-hide').find('input').prop("disabled", false);
    $('.fild-hide').find('input').css('cursor', 'pointer');
    $('.fild-hide').prop("disabled", false);

    $(".btn-circle").css("pointer-events", 'auto')
    $(".btn-circle").css("cursor", 'pointer')
    $(".btn-circle").css("opacity", 1)
    $(".btn-circle").css("opacity", 1)

    $(".fild-hide").css("opacity", '1')
}

function retornarVariavelLocal() {
    //debugger;
    var local = window.location.href;

    //se for localhost
    if (local.match(/localhost/)) {
        local = local.split("/");
        local = local[0]+"//"+local[2]+'/'+local[3]+'/';
    }
    //se for producao
    else {
        local = local.split("/");
        local = local[0]+"//"+local[2]+'/';
    }
    
    //retorna a variavel local
    return local;
}

// retorna a url do vídeo já tratada
function retornarUrlVideoTratada(urlParam) {
    
    let urlVideo = "";
    
    //verifica se é um embed
    if (urlParam.includes("shorts/") == true) {
        
        let urlCompleta = urlParam; //recebe a url
        let array1 = urlCompleta.split("shorts/"); //divide em array
        let codigoVideo = array1[1]; //Esse é o codigo do vídeo

        urlVideo = "https://www.youtube.com/embed/" + codigoVideo; //Monta a url do embed
    }
    //verifica se é um embed
    else if (urlParam.includes("embed/") == true) {
        
        let urlCompleta = urlParam; //recebe a url
        let array1 = urlCompleta.split("embed/"); //divide em array
        let codigoVideo = array1[1]; //Esse é o codigo do vídeo

        urlVideo = "https://www.youtube.com/embed/" + codigoVideo; //Monta a url do embed        
    }
    //Verifica se tem o v= na url
    else if (urlParam.includes("v=") == true) {
        let urlCompleta = urlParam; //recebe a url
        let array1 = urlCompleta.split("v="); //corta tudo antes do v=
        let codigoVideo = array1[1]; //Esse é o codigo do vídeo

        urlVideo = "https://www.youtube.com/embed/" + codigoVideo; //Monta a url do embed
    }
    else {

        urlVideo = urlParam;
    }

    //se tiver um & comercial na url
    if (urlVideo.includes("&") == true) {  

        let array2  = urlVideo.split("&"); 
        urlVideo = array2[0];
    }

    //console.log(urlVideo);
    return urlVideo; //Retorna a url
}

//ALERTA DE FAVORITOS
function alertFavoritos(msg){

    $('.mensagem-alert').text(msg);

    $(".container-mansagem").animate({
        bottom: "+=100",
    }, 200, function () {
    });

    setTimeout(function () {
        $(".container-mansagem").animate({
            bottom: "-=100",
        }, 200, function () {
        });
    
    }, 4000)
}

if (EXIBIR_ENDERECO == false) {
    
    //PAGINA DE BUSCA - ESCONDER BOTÃO DO MAPA QUANDO IMOBILIÁRIA NÃO MOSTRAR O ENDEREÇO
    $('#container-btn-mapa').removeClass('d-flex');
    $('#container-btn-mapa').css('display', 'none');

    //ESCONDER BOTÃO DO MAPA NO MOBILE - PAGINA DE BUSCA
    $('#btn-mapa-mobile').css('display', 'none');

    //ENDEREÇO NO DETALHE DO IMÓVEL
    $('#breadcrumb-endereco').css('display', 'none');

    //BOTAO DO DETALHE DO IMÓVEL
    $('#btn-rua').css('display', 'none');
}

function alertSave(msg){

    $('.mensagem-alert').text(msg);

    $(".container-mansagem").animate({
        bottom: "+=100",
    }, 200, function () {
    });

    setTimeout(function () {
        $(".container-mansagem").animate({
            bottom: "-=100",
        }, 200, function () {
        });
        // document.location.reload(true);
    }, 3000)
}

function alerError(msg){
    debugger;

    $('.mensagem-alert-error').text(msg);

    $(".container-mensagem-error").css('background-color','red');
    $(".container-mensagem-error").animate({
        bottom: "+=100",
    }, 200, function () {
    });

    setTimeout(function () {
        $(".container-mensagem-error").animate({
            bottom: "-=100",
        }, 200, function () {
        });
    }, 3000)
}

// CONVERTER PARA PLURAL

var regras = {

    /**
     * Palavras que terminam em a|e|i|o|u|ã|ãe|ão
     * apenas acrescenta a letra 's' no final
     * @type {Object}
     */
    acrescentar: {
        's'  : ['a', 'e', 'i', 'o', 'u', 'ã', 'ãe'],
        'es' : ['r', 'z', 'n', 'ás'],
        ''   : ['is', 'us', 'os']
    },

    /**
     * Palavras que terminam em al|el|ol|ul|il|m
     * substitui a terminação
     * @type {Object}
     */
    substituir: {
        'ais' : 'al',
        'eis' : 'el',
        'ois' : 'ol',
        'uis' : 'ul',
        'is'  : 'il',
        'ns'  : 'm',
        'eses': 'ês',
        'ões' : 'ão'
    },

    /**
     * Plural das sete exceções
     * @type {Object}
     */
    excecoes: {
        'males'    : 'mal',
        'cônsules' : 'cônsul',
        'méis' : 'mel',
        'féis' : 'fel',
        'cais' : 'cal',
    },

    /**
     * Palavras que não tem plural
     * @type {Object}
     */
    sem_plural: [
      'não'
    ],
};

function plural( palavra ) {

    var regex_troca =  "^([a-zA-Zà-úÀ-Ú]*)(%s)$"
      , plural = "";

    for ( var regra in regras ) {

        switch ( regra ) {

            case 'acrescentar':

                for ( var adicao in regras[regra] ) {

                    var busca = regex_troca.replace("%s", regras[regra][adicao].join("|"))
                      , regex = new RegExp(busca, 'i');

                    if ( regex.exec(palavra) !== null ) {
                        plural = palavra + adicao;
                        break;
                    }

                }

            break;

            case 'substituir':

                for ( var substituicao in regras[regra] ) {

                    var busca = regex_troca.replace("%s", regras[regra][substituicao])
                      , regex = new RegExp(busca, 'i');

                    if ( regex.exec(palavra) !== null ) {
                        /**
                         * Se a palavra for paroxítona ou proparoxítona,
                         * troca-se 'il' por 'eis'
                         */
                        if ( palavra.match(/([áéíóú])/) !== null && regex.exec(palavra)[2] == "il" ) {
                            plural = palavra.replace("il", "eis");
                            break;
                        } else {
                            var busca_sub = new RegExp(regex.exec(palavra)[2] + '$', 'i');
                            plural = palavra.replace(busca_sub, substituicao);
                            break;
                        }

                    }

                }

            break;

            case 'excecoes':

                for ( var excecao in regras[regra] ) {
                    if ( palavra == regras[regra][excecao] ) {
                        plural = excecao;
                        break;
                    }
                }

            break;

            case 'sem_plural':
                regras[regra].forEach(function(r) {
                  if (palavra === r) plural = palavra;
                });

            break;
        }

    }

    return plural !== "" ? plural : palavra;
}

//habilitar e desabilitar botoes
function habilitarDesabilitarBotao(elemento, acao, html) {

    
    if(acao == "habilitar") {
        
        $(elemento).html(html).prop("disabled", false);

    } else {

        $(elemento).html('<i class="fa fa-1x fa-spinner fa-pulse">Aguarde...</i>').prop("disabled", true);
    }
}

function getTag(imo){
    let tag =  '<div class="container-tag">'+

    (imo.aceitafinancimento == 1 ? '<div class="tag-card">ACEITA FINANCIAMENTO</div>' : '' )+
    
    // (imo.temproposta == 1 ? '<div class="tag-card">TEM PROPOSTA</div>' : '' )+
    (imo.empreendimento == 1 ? '<div class="tag-card">LANÇAMENTO</div>' : '' )+
    // (imo.temreserva == 1 ? '<div class="tag-card">RESERVADO</div>' : '' )+
    (imo.tempoCadastro < 31 && imo.tempoCadastro != undefined ? '<div class="tag-card">NOVO</div>' : '' )+
    (imo.urlpublica != '' && imo.urlpublica != undefined  ? '<div class="tag-card">TOUR VIRTUAL</div>' : '' )+
    (imo.exclusivo == 1 ? '<div class="tag-card">EXCLUSIVO</div>' : '' )+
    (imo.aceitapermuta == 1 ? '<div class="tag-card">ACEITA PERMUTA</div>' : '' )+
    (imo.valoranterior != 0.00 && imo.valoranterior != 0 && imo.valoranterior != undefined  ? '<div class="tag-card">PREÇO REDUZIDO</div>' : '' )+
    '</div>';

    return tag;
}

function alerError(msg) {

    $('.mensagem-alert-error').text(msg);

    /*
    $(".container-mensagem-error").css('background-color', 'red');

    $(".container-mensagem-error").animate({
        bottom: "100",
        display: "block",
    }, 200, function () {
    });
    */

    $(".container-mensagem-error").fadeIn();

    setTimeout(function () {

        $(".container-mensagem-error").fadeOut();

        /*
        $(".container-mensagem-error").animate({
            bottom: "100",
            display: "none",
        }, 200, function () {
        });
        */

        //bottom: "-=100",

    }, 3000);
}


function removerSinalDeMaisDoInicioEFim(str) {
    if (str.startsWith("+")) {
        str = str.slice(1);
    }
    if (str.endsWith("+")) {
        str = str.slice(0, -1);
    }
    return str;
}



//valida todos os campos do formulario
function validarCamposForm(idOrClassForm) {

    let preencheuTudo = true;

    $(''+idOrClassForm+' input:required, '+idOrClassForm+' select:required, '+idOrClassForm+' textarea:required, '+idOrClassForm+' radio:required, '+idOrClassForm+' checkbox:required').each(function( index ) {
        
        if($(this).val() == "" || $(this).val() == " " || $(this).val() == 'none' ) {
            let labelCampo = $(this).attr('data-label');

            if ($(this).prop('tagName').toLowerCase() == 'textarea'){
                let label = $(this).attr("data-label");
                mostrarMensagem('Preencha o campo "'+label+'".');    
            }
            else{
                mostrarMensagem('Informe o campo: "'+labelCampo+'".');
            }

            preencheuTudo = false;
            debugger;
        }

       
    });

 
    return preencheuTudo;
}


//funcao para mostrar mensagens na aplicacao
function mostrarMensagem(mensagem, tipo = null, tempo = null) {

    tipo = tipo == null ? 'danger' : tipo;
    tempo = tempo == null ? 1000 : tempo;

    $.notify(mensagem, {
        type: tipo,
        hideDuration: tempo
    });
}



var $closeModalWhats = $('.container-whatsapp');
var $btnToggleWhats = $('#btn-whats');

$('.close-modal-whats').click(function(){
    $closeModalWhats.toggle();
   e.stopPropagation();
});

// Função para alternar a visibilidade da lista de bairros
$btnToggleWhats.on('click', function (e) {
    $closeModalWhats.toggle();
    e.stopPropagation(); // Previne que o clique se propague para o document
});

// Impede que cliques dentro da lista de bairros fechem a lista
$closeModalWhats.on('click', function (e) {
    e.stopPropagation();
});

$(document).on('click', function (e) {
    if (!$closeModalWhats.is(e.target) && $closeModalWhats.has(e.target).length === 0 && !$closeModalWhats.is(e.target)) {
        $closeModalWhats.hide();
    }
});



