//VARIAVEIS PARA BUSCA LIVRE
var numeroRegistrosBusca = 20;

var obj_cidade = {};
obj_cidade.cidade = 0;
obj_cidade.cod_cidade = REGIAO_LOCALIZACAO_BASE_URL;
obj_cidade.nome_amigavel = REGIAO_LOCALIZACAO_BASE_URL;

var obj_bairro = {};
obj_bairro.nome = 'todos-os-bairros';
obj_bairro.cod_bairro = 0;
obj_bairro.nome_cidade = REGIAO_LOCALIZACAO_BASE_URL;
obj_bairro.nome_amigavel = 'todos-os-bairros';

var obj_endereco = {};

obj_endereco.nome = null;
obj_endereco.cod_bairro = null;
obj_endereco.cod_cidade = null;

var bairros_selecionados = [];

//CARREGA CIDADES
function getCidades() {

    return $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-cidades-disponiveis', //ImovelController
        async: true,
        data: imovel,
        beforeSend: function () {
            $('#cidade').empty();
            $('#cidade').append('<option  url="todas-as-cidades" id-cidade="0" value="todas-as-cidades">Carregando...</option>');
        }
    })
}

//Atualuzar o formulario depois que os dados foram cadastrados
function onBothAjaxComplete(data1, data2, data3) {

    // PARAMETROS PARA PRIMEIRO CARREGAMENTO
    pramsReferencias['geral'] = data2; // DADOS PRA COMPARAÇÃO DO QUE VEM PELA URL
    pramsReferencias['url'] = data3;

    //ATUALIZA O FORMULARIO DA PÁGINA
    atualizarForm()
}

$.when(getCidades(), retornarParametrosGerais(), carregarUrl())
    .done(function (data1, data2, data3) {

        // Acessando o conteúdo real de cada resposta
        const cidadesPromisse = data1[0]; // Dados retornados por getCidades
        const parametrosGeraisPromisse = data2[0]; // Dados retornados por retornarParametrosGerais
        const urlDataPromisse = data3[0]; // Dados retornados por carregarUrl

        // Manipule as cidades aqui
        $('#cidade').empty();
        $('#cidade').append('<option url="todas-as-cidades" id-cidade="0" value="todas-as-cidades">Todos</option>');
        $.each(cidadesPromisse.lista, function (key, cidade) {
            $('#cidade').append('<option url="' + cidade.urlAmigavel + '" id-cidade="' + cidade.codigo + '" value="' + cidade.urlAmigavel + '" data-nome="' + cidade.nome + '">' + cidade.nome + '</option>');
        });

        // Sua lógica após os AJAX terminarem
        onBothAjaxComplete(cidadesPromisse, parametrosGeraisPromisse, urlDataPromisse);
    })
    .fail(function (error1, error2, error3) {
        console.error("Erro em uma das chamadas AJAX:");
        if (error1) console.error("Erro na chamada 1:", error1);
        if (error2) console.error("Erro na chamada 2:", error2);
        if (error3) console.error("Erro na chamada 3:", error3);
    });


function detalheImovelHef(param) {
    window.location.href = param;
}

//ACAO DA LISTA de CIDADE
function getCidade() {

    //remove a tag cidade
    $('#id-tag-cidade-' + imovel.cidades.codigo).remove();

    //LIMPA OS BAIRROS
    imovel.endereco = '';
    imovel.bairros = [];
    imovel.bairros.push({
        cidade: REGIAO_LOCALIZACAO_BASE_URL,
        codigo: '',
        estado: "",
        nome: "",
        nomeUrl: "todos-os-bairros",
        regiao: REGIAO_LOCALIZACAO_BASE_URL
    });

    obj_cidade.cidade = $(this).text();
    obj_cidade.cod_cidade = $(this).attr('cod_cidade');
    obj_cidade.nome_amigavel = $(this).attr('nome_amigavel');
    $('#endereco').val('');
    $('#lista-endereco').empty();
    $('#lista-endereco-top').empty();
    $('.container-list-endereco').css('display', 'none');



    //REMOVER OS BAIRROS DA CIDADE ANTERIOR
    $.each(pramsReferencias.geral.bairros, function (i, b) {
        if (b.cidade == imovel.cidades.nome) {

            $('#id-tag-bairro-' + b.codigo).fadeOut(function () {
                $(this).remove();
            });
        }
        $('#tag-endereco-' + b.codigo).fadeOut(function () {
            $(this).remove();
        });
    });

    let cidade = $('<span>')
        .attr('id', 'id-tag-cidade-' + obj_cidade.cod_cidade)
        .addClass('card-tipo text-center justify-content-between align-items-center')
        .text(obj_cidade.cidade + ' ')
        .attr('codigo', obj_cidade.cod_cidade)
        .attr('nome-amigavel', obj_cidade.nome_amigavel)
        .append(
            $('<img>')
                .addClass('icon-x')
                .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
        ).click(function () {
            removerCidade();
            $(this).remove();
        });

    imovel.cidades = {
        codigo: obj_cidade.cod_cidade,
        estado: "",
        estadoUrl: "",
        nome: obj_cidade.cidade,
        nomeUrl: obj_cidade.nome_amigavel
    }

    imovel.codigocidade = obj_cidade.cod_cidade;
    //   imovel.bairros = obj_cidade;

    retornarImoveisDisponiveis();
    $('#container-parametros').append(cidade);

}

//ACAO DA LINHA DE BAIRROS
function getBairros() {

    $('.alert-busca').fadeIn('slow');
    $('.alert-busca').text('Encontre outros bairros usando campo de busca selecionado acima');
    $('#endereco').css('border', '2px solid #15e515');
    setTimeout(function () {
        $('.alert-busca').fadeOut('slow');
        // $('#endereco').css('border','1px solid #ced4da');
    }, 10000)


    imovel.endereco = '';

    obj_bairro.nome = $(this).text();
    obj_bairro.cod_bairro = $(this).attr('cod_bairro');
    obj_bairro.nome_amigavel = $(this).attr('nome_amigavel');
    obj_bairro.nome_origianl = $(this).attr('nome_origianl');
    obj_bairro.nome_cidade = $(this).attr('nome_cidade');
    $('#endereco').val('');


    //REMOVER OS BAIRROS DA CIDADE ANTERIOR
    $.each(pramsReferencias.geral.bairros, function (i, b) {

        //REMOVER OS BAIRROS SE A CIDADE ALTERIORMENTE SELECIONADA FOR DIFERENTE DA ATUAL
        if (b.cidade == imovel.cidades.nome && b.cidade != obj_bairro.nome_origianl) {

            $('#id-tag-bairro-' + b.codigo).fadeOut(function () {
                $(this).remove();
            });
        }

        $('#tag-endereco-' + b.codigo).fadeOut(function () {
            $(this).remove();
        });

    });

    let tags = $('.card-tipo');
    $(tags).each(function (key, tag) {
        if ($(tag).attr('id') == 'id-tag-bairro-' + obj_bairro.cod_bairro) {
            $('#id-tag-bairro-' + obj_bairro.cod_bairro).remove();
        }
    });


    $.each(pramsReferencias.geral.cidades, function (x, c) {

        if (c.nomeUrl == obj_bairro.nome_cidade) {

            //REMOVER A CIDADE ANTERIOR
            $('#id-tag-cidade-' + imovel.codigocidade).fadeOut(function () {
                $(this).remove();
            });

            //ATUALIZA O OBJETO CIDADE
            imovel.cidades = c;
            imovel.codigocidade = c.codigo;
        }
    });

    let narr = [];
    $.each(imovel.bairros, function (x, c) {

        if (c.cidadeUrl == undefined) { c.cidadeUrl = c.cidade; };
        if (c.nomeUrl != 'todos-os-bairros' && imovel.cidades.nomeUrl == c.cidadeUrl) {
            narr.push(imovel.bairros[x]);
        }

    });

    imovel.bairros = narr;
    imovel.bairros.push({
        cidade: obj_bairro.nome_cidade,
        codigo: obj_bairro.cod_bairro,
        //      estado:obj_bairro.,
        nome: obj_bairro.nome,
        nomeUrl: obj_bairro.nome_amigavel,
        //      regiao: obj_bairro.
    });


    //EVITAR OBJETOS DUPLICADOS
    imovel.bairros = manterObjetosDiferentesPorCodigo(imovel.bairros);


    let bairro = $('<span>')
        .attr('id', 'id-tag-bairro-' + obj_bairro.cod_bairro)
        .addClass('card-tipo text-center justify-content-between align-items-center')
        .text(obj_bairro.nome + ' ')
        .attr('codigo', obj_bairro.cod_bairro)
        .attr('nome-amigavel', obj_bairro.nome_amigavel)
        .append(
            $('<img>')
                .addClass('icon-x')
                .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
        ).click(removerBairro);


    $('#container-parametros').append(bairro);


    $('#lista-endereco').empty();
    $('#lista-endereco-top').empty();
    $('.container-list-endereco').css('display', 'none');

    retornarImoveisDisponiveis();
}

//ACAO DA LINHA DE ENDERECO
function getEndereco() {

    imovel.endereco = '';

    $('#container-parametros').empty();

    obj_endereco.nome = $(this).text();
    obj_endereco.cod_bairro = $(this).attr('cod_bairro');
    obj_endereco.cod_cidade = $(this).attr('cod_cidade');
    $('#endereco').val('');


    // let endereco = $('<span>')
    //     .attr('id', 'tag-endereco-' + obj_endereco.cod_bairro)
    //     .addClass('card-tipo text-center justify-content-between align-items-center')
    //     .text(obj_endereco.nome)
    //     .append(
    //         $('<img>')
    //             .addClass('icon-x')
    //             .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
    //     ).click(function () {
    //         $(this).remove();
    //     });


    $('#container-parametros').append(endereco);

    imovel.cidades = [];
    imovel.bairros = [];
    imovel.codigocidade = 0;
    imovel.bairros.push({
        cidade: REGIAO_LOCALIZACAO_BASE_URL,
        codigo: '',
        estado: "",
        nome: "",
        nomeUrl: "todos-os-bairros",
        regiao: REGIAO_LOCALIZACAO_BASE_URL
    });

    imovel.endereco = obj_endereco.nome;

    $('#lista-endereco').empty();
    $('#lista-endereco-top').empty();
    $('.container-list-endereco').css('display', 'none');

    retornarImoveisDisponiveis();

}

function carregarEndereco(endereco) {

    if (!isNaN(endereco)) {
        carregarCodigos(endereco);
        return false;
    }

    if (endereco.length < 4) {
        $('#lista-endereco').empty();

        return false;

    } else {

        let auxMsg = $('<li>')
            .addClass('list-group-item buttom-cidade')
            .text('Carregando...');

        $('#lista-endereco').prepend(auxMsg);
    }


    let localizacao = {};
    localizacao.finalidade = (imovel.finalidade == 'venda' ? '2' : '1');
    localizacao.localizacao = endereco;
    localizacao.opcaoImovel = 0;

    var tipos = $('#tipo');

    $.each(tipos.children(), function (i, value) {

        if ($(tipos).val() == $(value).val()) {

            localizacao.codigoTipo = $(value).attr('id-tipo');
        }

    });

    localizacao.codigoTipo = 0;


    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-enderecos-disponiveis', //ImovelController
        async: true,
        data: localizacao,
        beforeSend: function () {

        }
    }).done(function (dados) {

        $('#lista-endereco').empty();
        $('#lista-endereco-top').empty();



        if (dados.cidades.length > 0) {

            $('#lista-endereco').append('<li class="list-group-item"><b>Cidades</b></li>');

            $.each(dados.cidades, function (x, cidade) {

                let linhaCidade = $('<li>')
                    .addClass('list-group-item buttom-cidade')
                    .text(cidade.nome)
                    .attr('nome_amigavel', cidade.nome_amigavel)
                    .attr('cod_cidade', cidade.codigo)
                    .click(getCidade);


                $('#lista-endereco').append(linhaCidade);
                //               $('#lista-endereco-top').append(linhaCidade);


            });

            $.each(dados.cidades, function (x, cidade) {

                let linhaCidade2 = $('<li>')
                    .addClass('list-group-item buttom-cidade')
                    .text(cidade.nome)
                    .attr('nome_amigavel', cidade.nome_amigavel)
                    .attr('cod_cidade', cidade.codigo)
                    .click(getCidade);

                $('#lista-endereco-top').append(linhaCidade2);

            });
        }

        if (dados.bairros.length > 0) {
            $('#lista-endereco').append('<li class="list-group-item"><b>Bairros</b></li>');

            $.each(dados.bairros, function (x, bairro) {


                let linhaBairro = $('<li>')
                    .addClass('list-group-item buttom-cidade')
                    .text(bairro.nome + ' - ' + bairro.cidade)
                    .attr('nome_amigavel', bairro.nome_amigavel)
                    .attr('nome_origianl', bairro.cidade)
                    .attr('nome_cidade', bairro.nome_amigavel_cidade)
                    .attr('cod_bairro', bairro.codigo)
                    .click(getBairros);

                //                 $('#lista-endereco').append(linhaBairro);
                $('#lista-endereco-top').append(linhaBairro);

            });

            $.each(dados.bairros, function (x, bairro) {


                let linhaBairro2 = $('<li>')
                    .addClass('list-group-item buttom-cidade')
                    .text(bairro.nomebairro + ' - ' + bairro.nomecidade)
                    .attr('nome_amigavel', bairro.nome_amigavel)
                    .attr('nome_origianl', bairro.nomecidade)
                    .attr('nome_cidade', bairro.nome_amigavel_cidade)
                    .attr('cod_bairro', bairro.codigobairro)
                    .click(getBairros);

                $('#lista-endereco').append(linhaBairro2);
                //                 $('#lista-endereco-top').append(linhaBairro);

            });

        }

        // if (dados.enderecos.length > 0) {

        //     $('#lista-endereco').append('<li class="list-group-item"><b>Endereço</b></li>');

        //     $.each(dados.enderecos, function (x, endereco) {

        //         let linhaEndereco = $('<li>')
        //             .addClass('list-group-item buttom-cidade')
        //             .text(endereco.endereco)
        //             .attr('cod_cidade', endereco.codigocidade)
        //             .attr('cod_bairro', endereco.codigobairro)
        //             .click(getEndereco);

        //         //                $('#lista-endereco').append(linhaEndereco);
        //         $('#lista-endereco-top').append(linhaEndereco);

        //     });
        //     $.each(dados.enderecos, function (x, endereco) {

        //         let linhaEndereco = $('<li>')
        //             .addClass('list-group-item buttom-cidade')
        //             .text(endereco.endereco)
        //             .attr('cod_cidade', endereco.codigocidade)
        //             .attr('cod_bairro', endereco.codigobairro)
        //             .click(getEndereco);

        //         $('#lista-endereco').append(linhaEndereco);
        //     });
        // }

    }).then(function () {

        if (window.screen.width <= 720) {
            $('.container-list-endereco').css('display', 'block')
        }

        $('#label-endereco').text('DIGITE UMA LOCALIZAÇÃO');

    }).always(function () {

    });

}

//ACOES DOS FORMULARIOS
$('#input-top').keyup(function () {

    clearTimeout(typingTimer);

    let = objEnd = $(this);

    if (objEnd.val()) {

        typingTimer = setTimeout(function () {

            carregarEndereco(objEnd.val());

        }, 1000);

    }

});

var typingTimer;
$('#endereco').keyup(function () {

    clearTimeout(typingTimer);

    let = objEnd = $(this);

    if (objEnd.val() == '') {
        retornarImoveisDisponiveis();
    }

    if (objEnd.val()) {

        typingTimer = setTimeout(function () {

            carregarEndereco(objEnd.val());

        }, 1000);

    } else {

        $('#lista-endereco').empty();

    }

});
//=========================================

//TAG REMOVER CIDADE
function removerCidade() {

    imovel.codigocidade = 0;
    imovel.cidades = [];
    imovel.bairros = [];
    imovel.bairros.push({
        cidade: "",
        codigo: "",
        estado: "",
        estadoUrl: "",
        nome: "Todos",
        nomeUrl: "todos-os-bairros",
        regiao: ""
    });

    $(this).remove();
    retornarImoveisDisponiveis();

}


function removerBairro(param) {

    let novosBairros = [];

    $.each(imovel.bairros, function (i, b) {

        if (b.codigo != $(param).children('input').attr('data-codigo')) {

            novosBairros.push(b);
        }
    });

    if (novosBairros.length == 0) {
        imovel.codigocidade = 0;
    }


    imovel.bairros = novosBairros;
    retornarImoveisDisponiveis();

}

function removerLancamento() {

    $('#id-tag-lancamento-2').remove();

    $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');
    $(".btn-venda").addClass('btn-active-busca');

    imovel.finalidade = 'venda';
    imovel.numeropagina = 1;
    imovel.numeroregistros = numeroRegistrosBusca;
    imovel.opcaoimovel = 0;
    imovel.codigoOpcaoimovel = 0;

    retornarImoveisDisponiveis();
}

function titleize(text) {
    var words = text.toLowerCase().split(" ");
    for (var a = 0; a < words.length; a++) {
        var w = words[a];
        words[a] = w[0].toUpperCase() + w.slice(1);
    }
    return words.join(" ");
}

var titulo = '';

function atualizarTitulo(qtd) {

    var parametro_regiao = $("#STR_REGIAO_LOCALIZACAO_BASE").val();

    $('.breadcrumb').empty();
    $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">Início</a></li>');

    var titulo = qtd.toString() + ' ';
    params = [];

    if (imovel.tipos.length != 0) {

        $.each(imovel.tipos, function (x, t) {

            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="' + retornarVariavelLocal() + 'aluguel/' + t.nome + '">' + t.nome + '</a></li>');

            let novoTipo = '';

            if (qtd > 1) {

                let newTipe = t.nome.split(' ');

                $.each(newTipe, function (key, tt) {
                    novoTipo += ' ' + (tt.length <= 2 ? tt : plural(tt));
                })

                t.nome = novoTipo;
            }

            if (x < imovel.tipos.length - 1) {

                titulo += t.nome + ', ';

            } else {
                titulo += t.nome + ' ';
            }
        });

    } else {

        if (qtd == 1) {

            titulo += 'Imóvel ';

        } else {

            titulo += 'Imóveis ';
        }

    }

    let aux = 0;


    if (imovel.numerobanhos == 0) {

        imovel.numerobanhos = '0-banheiros';

    }

    if (imovel.numerobanhos.split('-', 1) != 0) {

        if (imovel.numerobanhos.split('-', 1) == 1) {

            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numerobanhos.split('-', 1) + ' Banheiro </a></li>');

        } else {
            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numerobanhos.split('-', 1) + ' Banheiros </a></li>');
        }

        if (aux == 0) {
            titulo += ' com ';
        }

        titulo += imovel.numerobanhos.split('-', 1);
        titulo += ' Banheiros, ';
        aux++;
    }


    if (imovel.numeroquartos == 0) {

        imovel.numeroquartos = '0-quartos';
    }


    if (imovel.numeroquartos.split('-', 1) != 0) {
        if (aux == 0) {
            titulo += ' com ';
        }

        if (imovel.numeroquartos.split('-', 1) == 1) {

            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numeroquartos.split('-', 1) + ' Quarto</a></li>');

        } else {

            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numeroquartos.split('-', 1) + ' Quartos</a></li>');

        }

        titulo += imovel.numeroquartos.split('-', 1);
        titulo += ' Quartos, ';
        aux++;
    }

    if (imovel.numerosuite == 0) {

        imovel.numerosuite = '0-suites';
    }

    if (imovel.numerosuite.split('-', 1) != 0) {

        if (aux == 0) {
            titulo += ' com ';
        }

        if (imovel.numerosuite.split('-', 1) == 1) {

            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numerosuite.split('-', 1) + ' Suite</a></li>');

        } else {

            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numerosuite.split('-', 1) + ' Suites</a></li>');

        }


        titulo += imovel.numerosuite.split('-', 1);
        titulo += ' Suítes, ';
        aux++;
    }

    if (imovel.numerovagas == 0) {

        imovel.numerovagas = '0-vagas';
    }

    if (imovel.numerovagas.split('-', 1) != 0) {
        if (aux == 0) {
            titulo += ' com ';
        }

        if (imovel.numerovagas.split('-', 1) == 1) {

            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numerovagas.split('-', 1) + ' Vaga</a></li>');

        } else {
            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.numerovagas.split('-', 1) + ' Vagas</a></li>');
        }


        titulo += imovel.numerovagas.split('-', 1);
        titulo += ' Vagas,';
        aux++;
    }

    let caracteristicas = imovel.caracteristicas;
    $.each(caracteristicas, function (i, c) {
        caracteristicas[i] = c;
    });



    //    if (imovel.caracteristicas.length > 0) {
    //
    //
    //        if (aux > 0) {
    //            titulo += ' com ';
    //        }
    //        
    //
    //        $.each(imovel.caracteristicas, function (x, c) {
    //
    //            $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.caracteristicas.split('-', 1) + '</a></li>');
    //
    //            if (x < imovel.caracteristicas.length - 1) {
    //
    //                titulo += c.replace('-', ' ') + ', ';
    //
    //            } else {
    //
    //                titulo += c.replace('-', ' ');
    //            }
    //        });
    //    }


    if (imovel.finalidade == 'venda') {

        titulo += ' à ' + imovel.finalidade;
        $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">Venda</a></li>');

    } else {

        titulo += ' para alugar ';
        $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">Aluguel</a></li>');
    }


    if (imovel.cidades == REGIAO_LOCALIZACAO_BASE_URL || imovel.cidades.length == 0) {
        titulo += ' ' + parametro_regiao + ' ';
    } else {
        titulo += ' em ' + imovel.cidades.nome;


        $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.cidades.nome + '</a></li>');
    }


    if (imovel.bairros.length != 0) {

        if (imovel.bairros[0].nomeUrl != 'todos-os-bairros' && imovel.bairros[0].nomeUrl != 'undefined') {


            titulo += ' no ';

            $.each(imovel.bairros, function (x, b) {

                $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + b.nome + '</a></li>');

                if (x < imovel.bairros.length - 1) {

                    titulo += b.nome + ', ';

                } else {

                    titulo += b.nome + ' ';
                }
            });
        }


    }


    if (imovel.condominio.codigo == 0 || imovel.condominio === undefined) {

        titulo += '';

    } else {

        titulo += ' localizado no ' + imovel.condominio.nome;

        $('.breadcrumb').append('<li  class="breadcrumb-item"><a href="#">' + imovel.condominio.nome + '</a></li>');
    }


    $('.texto-topo-busca').text(titulo);
}

//ATUALIZAR URL PRA
function atualizarUrlCondominio(imovel) {

    let aux = '';

    if (!imovel.condominio) {
        // url += '/REGIAO_LOCALIZACAO_BASE/';
    } else {
        aux += imovel.condominio.nomeUrl + '/';
    }

    return aux;
}

function atualizarUrlOpcaoImovel(imovel) {

    let aux = '';

    if (!imovel.opcaoimovel) {
        // url += '/REGIAO_LOCALIZACAO_BASE/';
    } else {
        aux += imovel.opcaoimovel.nomeUrl + '/';
    }

    return aux;

}

function atulizarUrlTipo(imovel) {

    let aux = '';

    if (imovel.tipos.length > 0) {

        $.each(imovel.tipos, function (i, t) {

            if (i == imovel.tipos.length - 1) {

                aux += t.url_amigavel + '/';

            } else {

                aux += t.url_amigavel + '+';

            }

        });

    } else if (imovel.cidades.length != '0') {

        aux += 'imovel/';

    }

    return aux;

}

function atualizarUrlCidade(imovel) {

    let aux = '';


    if (imovel.cidades.length == 0) {
        // url += '/REGIAO_LOCALIZACAO_BASE/';
    } else {
        aux += imovel.cidades.nomeUrl + '/';
    }

    return aux;

}

function atualizarUrlBairro(imovel) {

    let aux = '';
    if (imovel.bairros.length > 0 && imovel.bairros[0].nomeUrl != '' && imovel.bairros[0].nomeUrl != "todos-os-bairros") {

        $.each(imovel.bairros, function (i, b) {

            if (i == imovel.bairros.length - 1) {

                aux += b.nomeUrl + '/';

            } else {
                aux += b.nomeUrl + '+';

            }
        });
    }

    return aux;
}

function atualizarUrlParametros(imovel) {

    let aux = '';
    var cont_p = 0;


    if (typeof imovel.numerobanhos === "number" && imovel.numerobanhos !== 0) {
        aux += (cont_p > 0 ? '+' : '') + imovel.numerobanhos + '-banheiros';
        cont_p++;
    } else if (imovel.numerobanhos == 0 || imovel.numerobanhos == '0-banheiros') {

        aux += '';

    } else {
        aux += (cont_p > 0 ? '+' : '') + imovel.numerobanhos+'+';
        cont_p++;
    }
   

    if (typeof imovel.numeroquartos === "number" && imovel.numeroquartos != 0) {
        aux += (cont_p > 0 ? '+' : '') + imovel.numeroquartos + '-quartos';
        cont_p++;
    } else if (imovel.numeroquartos == 0 || imovel.numeroquartos == '0-quartos') {
        aux += '';
    } else {
        aux += (cont_p > 0 ? '+' : '') + imovel.numeroquartos+'+';
        cont_p++;
    }



    if (typeof imovel.numerovagas === "number" && imovel.numerovagas != 0) {
        aux += (cont_p > 0 ? '+' : '') + imovel.numerovagas + '-vagas';
        cont_p++;
    } else if (imovel.numerovagas == 0 || imovel.numerovagas == '0-vagas') {
        aux += '';
    } else {
        aux += (cont_p > 0 ? '+' : '') + imovel.numerovagas+'+';
        cont_p++;
    }


    if (typeof imovel.numerosuite === "number" && imovel.numerosuite != 0) {

        aux += (cont_p > 0 ? '+' : '') + imovel.numerosuite + '-suites';
        cont_p++;

    } else if (imovel.numerosuite == 0 || imovel.numerosuite == '0-suites') {

        aux += '';

    } else {
        aux += (cont_p > 0 ? '+' : '') + imovel.numerosuite+'+';
        cont_p++;
    }



    aux = removerSinalDeMaisDoInicioEFim(aux);
    return aux.replaceAll('++','+');


}

function atualizarURLCaracteristicas(imovel) {

    let aux = '';
    if (imovel.caracteristicas.length > 0 || typeof imovel.caracteristicas === "undefined") {
        $.each(imovel.caracteristicas, function (i, c) {
            aux += '+' + c;
        });

    } else {
        aux = aux.substr(0, (aux.length - 1));
    }

    if (imovel.numerobanhos == '0-banheiros' && imovel.numeroquartos == '0-quartos' && imovel.numerovagas == '0-vagas' && imovel.numerosuite == '0-suites') {
        aux = aux.substr(1);
    }


    return removerSinalDeMaisDoInicioEFim(aux);

}

function atualizarURlAreaValor(imovel) {

    //AREA NA URL
    var v_cont = 0;
    let aux = '';
    if (imovel.valorde !== '0' && imovel.valorde != 0 && imovel.valorde != '0.00') {

        aux += (v_cont == 0 ? '?' : '&') + 'valor_min=' + imovel.valorde;
        v_cont++;
    }

    if (imovel.valorate !== '0' && imovel.valorate != 0 && imovel.valorate != '0.00') {

        aux += (v_cont == 0 ? '?' : '&') + 'valor_max=' + imovel.valorate;
        v_cont++;
    }


    //AREA NA URL
    if (imovel.areade !== '0' && imovel.areade != 0 && imovel.areade != '0.00') {

        aux += (v_cont == 0 ? '?' : '&') + 'area_min=' + imovel.areade / 100;
        v_cont++;
    }

    if (imovel.areaate !== '0' && imovel.areaate != 0 && imovel.areaate != '0.00') {

        aux += (v_cont == 0 ? '?' : '&') + 'area_max=' + imovel.areaate / 100;
        v_cont++;
    }


    return removerSinalDeMaisDoInicioEFim(aux);

}

function atualizarURL() {


    let url = '';
    url += retornarVariavelLocal();
    url += imovel.finalidade + '/';

    let UrlCond = atualizarUrlCondominio(imovel);

    //opcao de imovel
    let UrlOpcaoImovel = atualizarUrlOpcaoImovel(imovel);

    let UrlTipo = atulizarUrlTipo(imovel);

    let UrlCidade = atualizarUrlCidade(imovel)

    let UrlBairro = atualizarUrlBairro(imovel)

    let param = atualizarUrlParametros(imovel);

    let carac = atualizarURLCaracteristicas(imovel);

    let area_valor = atualizarURlAreaValor(imovel);

    if (imovel.extras.length > 0) {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : 'todos-os-bairros/') +
            (UrlCond != '' ? UrlCond : 'todos-os-condominios') +
            (UrlOpcaoImovel != '' ? UrlOpcaoImovel : 'todas-as-opcoes') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');

        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }

        let camposExtrasurl = imovel.extras.join(',');
        url += '&extras=' + camposExtrasurl

        window.history.replaceState('Object', 'Categoria JavaScript', removerSinalDeMaisDoInicioEFim(url));
        return false;
    }


    if (imovel.valorde != 0 || imovel.valorate != 0 || imovel.areade != 0 || imovel.areaate != 0) {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : 'todos-os-bairros/') +
            (UrlCond != '' ? UrlCond : 'todos-os-condominios') +
            (UrlOpcaoImovel != '' ? UrlOpcaoImovel : 'todas-as-opcoes') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');

        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }

        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;
    }

    if (param != "") {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : 'todos-os-bairros/') +
            (UrlCond != '' ? UrlCond : 'todos-os-condominios') +
            (UrlOpcaoImovel != '' ? UrlOpcaoImovel : 'todas-as-opcoes') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');

        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }

        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;
    }

    if (typeof imovel.caracteristicas !== "undefined" && imovel.caracteristicas.length > 0) {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : 'todos-os-bairros/') +
            (UrlCond != '' ? UrlCond : 'todos-os-condominios') +
            (UrlOpcaoImovel != '' ? UrlOpcaoImovel : 'todas-as-opcoes') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');

        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }

        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;

    }

    // OPCAO DE IMOVEL
    if (imovel.opcaoimovel.nomeUrl != "todas-as-opcoes" && imovel.opcaoimovel.nomeUr != 0) {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : 'todos-os-bairros/') +
            (UrlCond != '' ? UrlCond : 'todos-os-condominios') +
            (UrlOpcaoImovel != '' ? UrlOpcaoImovel : '') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');

        url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');;


        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;

    }

    if (imovel.condominio && imovel.condominio.nomeUrl != "todos-os-condominios") {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : 'todos-os-bairros/') +
            (UrlCond != '' ? UrlCond : '') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');


        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }


        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;

    }

    if (imovel.bairros.length > 0 && imovel.bairros[0].nomeUrl != "todos-os-bairros") {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : 'todos-os-bairros/') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');


        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }

        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;
    }

    if (imovel.cidades.length != 0) {

        url += (UrlTipo != '' ? UrlTipo : 'imovel/') +
            (UrlCidade != '' ? UrlCidade : REGIAO_LOCALIZACAO_BASE_URL + '/') +
            (UrlBairro != '' ? UrlBairro : '') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');

        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }

        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;
    }

    if (imovel.tipos.length != 0 || imovel.tipos !== "undefined") {

        url += (UrlTipo != '' ? UrlTipo : '') +
            (UrlCidade != '' ? UrlCidade : '') +
            (UrlBairro != '' ? UrlBairro : '') +
            (param != '' ? param : '') +
            (carac != '' ? carac : '') +
            (area_valor != '' ? area_valor : '');


        if (area_valor == '') {
            url += '?&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        } else {
            url += '&pagina=' + imovel.numeropagina + (imovel.ordenacao != '' && imovel.ordenacao != null ? '&ordenacao=' + imovel.ordenacao : '');
        }

        window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
        return false;
    }

    window.history.replaceState('Object', 'Categoria JavaScript',  removerSinalDeMaisDoInicioEFim(url));
}



var pramsReferencias = {};

function retornarImoveisDisponiveis() {

    imovel.numeroregistros = numeroRegistrosBusca;
    imovel.numeropagina = 1;

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-imoveis-disponiveis', //ImovelController
        async: true,
        data: imovel,
        beforeSend: function () {

            $('.modal-loader').css('display', 'flex');

            $("#result-busca-map").empty();
            $("#container_resultado_listagem_imoveis").empty();
        }
    }).done(function (imovel) {

        if (imovel.quantidade == 0) {

            mostrarMensagem('Não há imóvel com esse perfil');

            // $('#container_resultado_listagem_imoveis').append(alert);
        }

        $('#texto-topo-busca').text(imovel.quantidade);

        let fav = Object.values(imovel.favoritos);
        imovel.favoritos = fav;

        $('.cont-fav').text(imovel.favoritos.length);

        //ATUALIZAR FAVORITOS QUANDO CARREGAR A PAGINA
        $('#cont-fav').text(imovel.favoritos.length);

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
            $('#container_resultado_listagem_imoveis').append('<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 wrap_card_imovel" data-local="2">' + retornarCardImovel(imo) + '</div>');
        });

    }).then(function (imovel) {

        $('.modal-loader').css('display', 'none');

        if (EXIBIR_ENDERECO) {
            if (mapActive) {
                addmarker(imovel);
                // inserirMarcadores();
            }
        }

        atualizarURL();
        atualizarPaginacao(imovel)
        atualizarTitulo(imovel.quantidade);
        $('#input_codigo').val('')

        // interceptarLinks()

    })

}

$('.modal-loader').css('display', 'flex');


function retornarImoveisDisponiveisPaginacao(param) {

    imovel.numeroregistros = numeroRegistrosBusca;
    imovel.numeropagina = param;

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-imoveis-disponiveis',
        async: true,
        data: imovel,
        beforeSend: function () {

            $('.modal-loader').css('display', 'flex');

            $('#container_geral_paginacao').css('display', 'none');
            $("#container_resultado_listagem_imoveis").empty();

        }
    }).done(function (imovel) {

        if (imovel.quantidade == 0) {
            mostrarMensagem('Não há imóvel com esse perfil');
        }

        let fav = Object.values(imovel.favoritos);
        imovel.favoritos = fav;

        //ATUALIZAR FAVORITOS QUANDO CARREGAR A PAGINA
        $('#cont-fav').text(imovel.favoritos.length);

        $.each(imovel.favoritos, function (key, f) {

            $.each(imovel.lista, function (key2, imoveis) {

                if (imovel.favoritos[key] == imoveis.codigo) {

                    imovel.lista[key2].favoritos = true;
                } else {
                    imovel.lista[key2].favoritos = false;
                }

            });
        });

        //lista de imoveis 
        $.each(imovel.lista, function (key, imo) {

            $('#container_resultado_listagem_imoveis').append('<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 wrap_card_imovel" data-local="3">' + retornarCardImovel(imo) + '</div>');
        });

    }).then(function (imovel) {

        $('.modal-loader').css('display', 'none');

        atualizarURL();
        atualizarPaginacao(imovel);
        atualizarTitulo(imovel.quantidade);
        scrollTopBusca();
        $('#input_codigo').val('')


        // interceptarLinks();

    });

}


function retornarImoveisEmpreendimentosFilhosDisponiveis(codigoempreendimentomae) {

    $('.container-cards-empreenimentos').empty();

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-imoveis-empreendimentos-filho',
        async: true,
        data: {
            'codigo': codigoempreendimentomae,
            'pagina': 1,
        },
        beforeSend: function () {
            $('.modal-cards-empreenimentos-filho').show();
            $('.nome-empreendimento-modal-lancamentos').text('');

        }
    }).done(function (imovel) {


        let fav = Object.values(imovel.favoritos);
        imovel.favoritos = fav;

        if (imovel.quantidade == 0) {
            $('.nome-empreendimento-modal-lancamentos').text('Não há imóveis disponíveis para esse empreendimento');
            return;
        }

        $('.nome-empreendimento-modal-lancamentos').text('Imóveis do empreendimento ' + imovel.lista[0].nomeempreendimento);

        $.each(imovel.favoritos, function (key, f) {

            $.each(imovel.lista, function (key2, imoveis) {

                if (imovel.favoritos[key] == imoveis.codigo) {

                    imovel.lista[key2].favoritos = true;
                } else {
                    imovel.lista[key2].favoritos = false;
                }

            });
        });

        //lista de imoveis 
        $.each(imovel.lista, function (key, imo) {
            $('.container-cards-empreenimentos').append('<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wrap_card_imovel" data-local="3">' + retornarCardImovel(imo) + '</div>');
        });

    }).then(function (imovel) {

    });
}

$('.close-modal-card-empreendimento').click(function () {
    $('.modal-cards-empreenimentos-filho').hide();
})


//REMOVER TIPOS PELAS TAGS SUPERIORES
function removeTipo() {

    let tipo = $(this);
    tipo.remove();

    $('#btn-tipo-' + tipo.attr('codigo') + '').removeClass('tipo-active listagem_filtro_item_active');

    let novo = [];

    $.each(imovel.tipos, function (x, t) {

        if (imovel.tipos[x].codigo != tipo.attr('codigo')) {
            novo.push(imovel.tipos[x]);
        }
    });

    imovel.tipos = novo;
    retornarImoveisDisponiveis();

}

//TOGGLE PARA BOTOES DOS FORMULARIOS
function tiposToggle(ObjTipo, tipo) {

    if ($(ObjTipo).hasClass('tipo-active')) {

        //REMOVER CLASS
        $(ObjTipo).removeClass('tipo-active listagem_filtro_item_active');

        let novoTipo = [];

        $.each(imovel.tipos, function (x, t) {

            if (imovel.tipos[x].codigo != tipo.codigo && imovel.tipos[x].url_amigavel != 'imovel') {

                novoTipo.push(imovel.tipos[x]);

            } else {

                $("#id-tag-tipo-" + tipo.codigo).fadeOut('slow', function () {
                    $(this).remove();
                });
            }
        });

        imovel.tipos = novoTipo;

    } else {

        $(ObjTipo).addClass('tipo-active listagem_filtro_item_active');
        // $('#container-parametros').append(
        //     $('<span>')
        //         .attr('id', 'id-tag-tipo-' + tipo.codigo)
        //         .attr('codigo', tipo.codigo)
        //         .addClass('card-tipo text-center justify-content-between align-items-center')
        //         .text(tipo.nome + ' ')
        //         .append(
        //             $('<img>')
        //                 .addClass('icon-x')
        //                 .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
        //         ).click(removeTipo)
        // );

        imovel.tipos.push(tipo);
    }

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
}

//ATUALIZAÇÃO DO FORMULARIO
var sliderValor = '';
function atualizarForm() {

    let dadosMesclados = {};
    dadosMesclados.bairros = [];
    dadosMesclados.cidades = [];
    dadosMesclados.tipos = [];


    //ATUALIZAÇÃO DO FORMULARIO FINALIDADE
    if (pramsReferencias.url.finalidade[0] == 'comprar' || pramsReferencias.url.finalidade[0] == 'venda') {

        $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');
        $(".btn-venda").addClass('btn-active-busca');
        imovel.finalidade = 'venda';

    } else if (pramsReferencias.url.finalidade[0] == 'aluguel' || pramsReferencias.url.finalidade[0] == 'locacao') {

        $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');
        $(".btn-aluguel").addClass('btn-active-busca');
        imovel.finalidade = 'aluguel';

    }

    if (typeof pramsReferencias.url.opcaoimovel !== 'undefined' && pramsReferencias.url.opcaoimovel != 'todas-as-opcoes') {

        $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');
        $(".btn-lancamento").addClass('btn-active-busca');

        imovel.finalidade = 'venda';
        imovel.numeropagina = 1;
        imovel.numeroregistros = numeroRegistrosBusca;
        imovel.codigoOpcaoimovel = 2
        imovel.opcaoimovel = { codigo: 2, nome: 'Lançamentos', nomeUrl: 'apenas-lancamentos' };

        desabilitarCampoParaLancamentos();

    }

    if (typeof pramsReferencias.url.cidades !== 'undefined') {

        //ATUALIZAR SELECT DE CIDADE DO FORMULARIO
        $('#cidade option').each(function (key, element) {
            if (pramsReferencias.url.cidades[0] == $(element).attr('url')) {
                $(element).prop("selected", true);
            } else {
                $(element).prop("selected", false)
            }
        });


        if (pramsReferencias.url.cidades[0] != REGIAO_LOCALIZACAO_BASE_URL) {

            //REFATORAMENTO DE CIDADE
            $.each(pramsReferencias.geral.cidades, function (i, g) {

                $.each(pramsReferencias.url.cidades, function (j, u) {

                    if (g.nomeUrl == u) {
                        dadosMesclados.cidades.push(g);

                        // let cidade = $('<span>')
                        //     .attr('id', 'id-tag-cidade-' + g.codigo)
                        //     .addClass('tag-cidade card-tipo text-center justify-content-between align-items-center')
                        //     .text(g.nome + ' ')
                        //     .attr('codigo', g.codigo)
                        //     .attr('nome-amigavel', g.nomeUrl)
                        //     .append(
                        //         $('<img>')
                        //             .addClass('icon-x')
                        //             .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
                        //     ).click(removerCidade);

                        // $('#container-parametros').append(cidade);

                        imovel.cidades = g;
                        imovel.codigocidade = g.codigo;

                    }
                });
            });

        } else {
            imovel.cidades = [];
            imovel.codigocidade = 0;
        }
    } else {

        imovel.cidades = [];
        imovel.codigocidade = 0;
    }


    //REFATORAMENTO BAIRROS
    if (typeof pramsReferencias.url.cidades !== 'undefined') {

        if (pramsReferencias.url.bairros != 'todos-os-bairros') {

            $.each(pramsReferencias.geral.bairros, function (i, g) {

                //preencher formulario no primeior acesso
                if (dadosMesclados.cidades[0].nome == g.cidade) {


                    let option = '<li><input  type="checkbox" id="check-' + g.nomeUrl + '" class="check-box-bairros" data-codigo="' + g.codigo + '" value="' + g.nomeUrl + '" url="' + g.nomeUrl + '" cod_bairro="' + g.codigo + '" nome_amigavel="' + g.nomeUrl + '" nome_origianl="' + g.nome + '" nome_cidade="' + g.cidade + '"><label for="check-' + g.nomeUrl + '">' + g.nome + '</label></li>';
                    option = $(option).click(function () {
                        // Suponha que o contêiner tenha a classe "container"
                        let quantidadeBairrosMarcados = $('.lista-bairros input[type="checkbox"]:checked').length;
                        $('.cont-bairro').text(quantidadeBairrosMarcados);

                        if ($(this).children('input').is(':checked')) {

                            adicionarBairro($(this).children('input'))

                        } else {
                            removerBairro(option);
                        }

                    });

                    $('.lista-bairros ul').append(option);
                }


                $.each(pramsReferencias.url.bairros, function (i, u) {

                    if (g.nomeUrl == u && dadosMesclados.cidades[0].nome == g.cidade) {

                        dadosMesclados.bairros.push(g);
                        $('#check-' + g.nomeUrl + '').prop('checked', true);
                        imovel.bairros.push(g);
                    }
                });
            });

            //atualizar quantidede de bairros
            // $('.count-bairros').text(pramsReferencias.url.bairros.length);

        } else {

            imovel.bairros.push({
                cidade: "",
                codigo: "",
                estado: "",
                estadoUrl: "",
                nome: "Todos",
                nomeUrl: "todos-os-bairros",
                regiao: ""
            });
        }

    } else {

        imovel.bairros.push({
            cidade: "",
            codigo: "",
            estado: "",
            estadoUrl: "",
            nome: "Todos",
            nomeUrl: "todos-os-bairros",
            regiao: ""
        });
    }

    //alterar a quantidade de bairros selecionados
    let quantidadeBairrosMarcados = $('.lista-bairros input[type="checkbox"]:checked').length;
    $('.cont-bairro').text(quantidadeBairrosMarcados);

    //REFATORAMENTO DE TIPOS
    if (typeof pramsReferencias.url.tipos !== 'undefined') {

        $.each(pramsReferencias.geral.tipos, function (i, g) {
            let copJ = 0;
            $.each(pramsReferencias.url.tipos, function (j, u) {

                //ENTRAS APENAS SE O TIPO ESTIVER NA URL
                if (pramsReferencias.url.tipos[0] != 'imovel') {

                    if (g.url_amigavel == u) {

                        copJ = j;

                        dadosMesclados.tipos.push(g);

                        let tipo = $('<span>')
                            .attr('id', 'id-tag-tipo-' + g.codigo)
                            .attr('codigo', g.codigo)
                            .addClass('card-tipo text-center justify-content-between align-items-center')
                            .text(g.nome + ' ')
                            .append(
                                $('<img>')
                                    .addClass('icon-x')
                                    .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
                            ).click(removeTipo);

                        imovel.tipos.push(g);

                        // $('#container-parametros').append(tipo);

                    }

                } else {
                    imovel.tipos = [];
                }

            });


            let tiposBTN = $('<span>')
                .addClass('card-tipo-filter botao_tipo_busca text-center justify-content-between align-items-center ' + (g.url_amigavel == pramsReferencias.url.tipos[copJ] ? 'tipo-active listagem_filtro_item_active' : '') + '')
                .text(g.nome)
                .attr('codigo', g.codigo)
                .attr('url', g.url_agigavel)
                .click(function () {

                    tiposToggle(tiposBTN, g);

                });

            $('#container-btn').append(tiposBTN);

        });


    } else {
        //QUANDO NENHUM TIPO É SELECIONADO

        imovel.tipos = [];

        $.each(pramsReferencias.geral.tipos, function (i, g) {

            let tipo = $('<span>')
                .attr('id', 'id-tag-tipo-' + g.codigo)
                .attr('codigo', g.codigo)
                .addClass('card-tipo text-center justify-content-between align-items-center')
                .text(g.nome + ' ')
                .append(
                    $('<img>')
                        .addClass('icon-x')
                        .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
                ).click(removeTipo);

            let tiposBTN = $('<span>')
                .attr('id', 'btn-tipo-' + g.codigo + '')
                .addClass('card-tipo-filter botao_tipo_busca text-center justify-content-between align-items-center ')
                .text(g.nome)
                .attr('codigo', g.codigo)
                .attr('url', g.url_agigavel)
                .click(function () {
                    tiposToggle(tiposBTN, g);
                });

            $('#container-btn').append(tiposBTN);
        });
    }



    //atualizar Condomínios
    $('#condominio').empty();
    $('#condominio').append('<option codigo="0" url="todos-os-condominios">Todos</option>');
    if (typeof pramsReferencias.url.condominio !== 'undefined' && pramsReferencias.url.condominio != 'todos-os-condominios') {

        $.each(pramsReferencias.geral.condominios, function (i, cond) {

            if (pramsReferencias.url.condominio[0] == cond.nomeUrl) {

                imovel.codigocondominio = cond.codigo;
                imovel.condominio = { codigo: cond.codigo, nome: cond.nome, nomeUrl: cond.nomeUrl };

                $('#condominio').append('<option selected="selected" nome="' + cond.nome + '" codigo="' + cond.codigo + '" url="' + cond.nomeUrl + '" value="' + cond.codigo + '">' + cond.nome + '</option>');

            } else {

                $('#condominio').append('<option  nome="' + cond.nome + '" codigo="' + cond.codigo + '" url="' + cond.nomeUrl + '"  value="' + cond.codigo + '">' + cond.nome + '</option>');
            }
        });

    } else {

        imovel.codigocondominio = 0;
        imovel.condominio = { codigo: 0, nome: "", nomeUrl: "todos-os-condominios" };

        // $('#condominio').append('<option codigo="0" url="todos-os-condominios">Todos</option>');
        $.each(pramsReferencias.geral.condominios, function (i, cond) {
            $('#condominio').append('<option nome="' + cond.nome + '" codigo="' + cond.codigo + '" url="' + cond.nomeUrl + '"  value="' + cond.codigo + '">' + cond.nome + '</option>');
        });
    }

    //atualizar Condomínios
    $('.chosen').chosen();


    //ATUALIZAR SELECT DE OPÇÃO DE IMOVEL
    if (typeof pramsReferencias.url.opcaoimovel !== 'undefined' && pramsReferencias.url.opcaoimovel != 'todas-as-opcoes') {

        let ObjOpcaoimovel = $('#opcaoimovel');
        ObjOpcaoimovel.children().each(function (i, val) {

            if (pramsReferencias.url.opcaoimovel == $(val).attr('url')) {
                $(val).attr('selected', 'selected');

                imovel.codigoOpcaoimovel = $(val).val();
                imovel.opcaoimovel = { codigo: $(val).val(), nome: $(val).attr('url'), nomeUrl: $(val).attr('url') };

                if (imovel.opcaoimovel.nome == 'apenas-lancamentos') {

                    let lancamnento = $('<span>')
                        .attr('id', 'id-tag-lancamento-' + imovel.opcaoimovel.codigo)
                        .addClass('card-tipo c-lancamentos text-center justify-content-between align-items-center')
                        .text((imovel.opcaoimovel.nome == 'apenas-lancamentos' ? 'Apenas Lançamentos' : '') + ' ')
                        .attr('codigo', imovel.opcaoimovel.codigo)
                        .attr('nome-amigavel', imovel.opcaoimovel.nomeUrl)
                        .append(
                            $('<img>')
                                .addClass('icon-x')
                                .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
                        ).click(function () {
                            removerLancamento();
                            $(this).remove();
                        });

                    $("#container-parametros").append(lancamnento);
                }
            }

        })

    } else {

        imovel.codigoOpcaoimovel = 0;
        imovel.opcaoimovel = { codigo: 0, nome: "", nomeUrl: "todas-as-opcoes" };
    }


    //    ATUALIZA OS OS PARAMETROS QUARTOS/SUITES/BANHEIROS/

    if (typeof pramsReferencias.url.param !== 'undefined') {

        $.each(pramsReferencias.url.param, function (i, p) {

            if (p.indexOf("quartos") == 2 || p.indexOf("quarto") == 2) {

                $("#btn-q-" + p.substr(0, 1) + "").addClass('quar-active listagem_filtro_item_active');

                imovel.numeroquartos = p;

            } else if (p.indexOf("vagas") == 2 || p.indexOf("vaga") == 2) {

                $("#btn-vaga-" + p.substr(0, 1) + "").addClass('vagas-active listagem_filtro_item_active');
                imovel.numerovagas = p;

            } else if (p.indexOf("banheiros") == 2 || p.indexOf("banheiro") == 2) {

                $("#btn-b-" + p.substr(0, 1) + "").addClass('ban-active listagem_filtro_item_active');
                imovel.numerobanhos = p;

            } else if (p.indexOf("suites") == 2 || p.indexOf("suite") == 2) {

                $("#btn-s-" + p.substr(0, 1) + "").addClass('suite-active listagem_filtro_item_active');
                imovel.numerosuite = p;

            } else {

                $('#' + p + '').children().addClass('imovel-check-active');

                imovel.caracteristicas.push(p);

            }
        });
    } else {

    }

    //ATUALIZA VALOR DA VARIAVEL
    imovel.valorde = pramsReferencias.url.valor[0];
    imovel.valorate = pramsReferencias.url.valor[1];
    imovel.areade = parseFloat(pramsReferencias.url.area[0] * 100);
    imovel.areaate = parseFloat(pramsReferencias.url.area[1] * 100);

    $('#input_valor_min').val((imovel.valorde == 0 ? '' : imovel.valorde));
    $('#input_valor_max').val((imovel.valorate == 0 ? '' : imovel.valorate));

    $('#input_area_min').val((imovel.areade == 0 ? '' : imovel.areade / 100));
    $('#input_area_max').val((imovel.areaate == 0 ? '' : imovel.areaate / 100));

    var urlAtual = window.location.href;
    var urlClass = new URL(urlAtual);
    var pagina = urlClass.searchParams.get("pagina");

    let carac_extras = urlClass.searchParams.get("extras");

    var ordenacaourl = urlClass.searchParams.get("ordenacao");
    imovel.ordenacao = (ordenacaourl ? ordenacaourl : imovel.ordenacao );


    if (carac_extras) {
        imovel.extras = carac_extras.split(',');
    }

    if (pagina == "null" || pagina == undefined) {
        pagina = 1;
    }

    imovel.numeropagina = pagina;
    let codigoParametro = urlClass.searchParams.get("codigos");

    if (codigoParametro != null && codigoParametro != undefined && codigoParametro != 'null') {
        retornarImoveisPeloCoigo(codigoParametro);
        return false;
    }

    // CARREGA OS IMOVEIS PELA URL
    retornarImoveisDisponiveisPaginacao(pagina);

}





$('#condominio').change(function () {

    let codC = $(this).val();
    let condo = {};
    $(this).children().each(function (index, element) {


        if (codC == $(element).val()) {

            condo.codigo = $(element).attr('codigo');
            condo.nomeUrl = $(element).attr('url');
            condo.nome = $(element).attr('nome');
        }


    });

    imovel.codigocondominio = condo.codigo;
    imovel.condominio = condo;
    imovel.numeropagina = 1;

    retornarImoveisDisponiveis();
});


//ALTERAR O OPÇÕES DE BUSCA -- LANÇAMENTO - AVULSO ETC...
$('#opcaoimovel').change(function () {

    let opimovel = $(this);

    opimovel.children().each(function (i, val) {

        if ($(opimovel).val() == $(val).attr('value')) {

            imovel.codigoOpcaoimovel = $(val).attr('value')
            imovel.opcaoimovel = { codigo: $(val).attr('value'), nome: $(val).attr('url'), nomeUrl: $(val).attr('url') };

            if (imovel.opcaoimovel.nome == 'apenas-lancamentos') {

                let lancamnento = $('<span>')
                    .attr('id', 'id-tag-lancamento-' + imovel.opcaoimovel.codigo)
                    .addClass('card-tipo c-lancamentos text-center justify-content-between align-items-center')
                    .text((imovel.opcaoimovel.nome == 'apenas-lancamentos' ? 'Apenas Lançamentos' : '') + ' ')
                    .attr('codigo', imovel.opcaoimovel.codigo)
                    .attr('nome-amigavel', imovel.opcaoimovel.nomeUrl)
                    .append(
                        $('<img>')
                            .addClass('icon-x')
                            .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
                    ).click(function () {
                        removerLancamento();
                        $(this).remove();
                    });

                $("#container-parametros").append(lancamnento);

            } else {

                $('#id-tag-lancamento-2').remove();
            }

        }

    })

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
});


$('#input_valor_min').mask("###.###.##0,00", { reverse: true });
$('#input_valor_max').mask("###.###.##0,00", { reverse: true });

$('#input_valor_min').change(function () {
    imovel.valorde = $(this).val();
    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
});

$('#input_valor_max').change(function () {
    imovel.valorate = $(this).val();
    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
});

$('#input_area_min').change(function () {
    imovel.areade = ($(this).val() == '' ? 0 : parseFloat($(this).val()) * 100);

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
});

$('#input_area_max').change(function () {
    imovel.areaate = ($(this).val() == '' ? 0 : parseFloat($(this).val()) * 100);

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
});


$('.buttom_finalidade_busca_home').click(function () {

    $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');

    if ($(this).children().children().attr('data-campofinalidade') == 'alugar') {


        $('.buttom_finalidade_busca_home').removeClass('btn-active-busca');
        $('#id-tag-lancamento-aba-2').remove();
        // $(".btn-venda").addClass('btn-active-busca');

        $(this).addClass('btn-active-busca');

        finalidade = 1;

        imovel.finalidade = 'aluguel';
        imovel.numeropagina = 1;
        imovel.numeroregistros = numeroRegistrosBusca;
        imovel.opcaoimovel = 0;
        imovel.codigoOpcaoimovel = 0;

        retornarImoveisDisponiveis();
        $('#id-tag-lancamento-2').remove();


        habilitarCampoParaLancamentos();

    } else if ($(this).children().children().attr('data-campofinalidade') == 'comprar') {

        $(this).addClass('btn-active-busca');
        $('#id-tag-lancamento-aba-2').remove();


        finalidade = 2;

        imovel.finalidade = 'venda';
        imovel.numeropagina = 1;
        imovel.numeroregistros = numeroRegistrosBusca;
        imovel.opcaoimovel = 0;
        imovel.codigoOpcaoimovel = 0;

        retornarImoveisDisponiveis();

        $('#id-tag-lancamento-2').remove();

        habilitarCampoParaLancamentos();


    } else if ($(this).children().children().attr('data-campofinalidade') == 'lancamentos') {

        $(this).addClass('btn-active-busca');

        finalidade = '';

        imovel.finalidade = 'venda';
        imovel.numeropagina = 1;
        imovel.numeroregistros = numeroRegistrosBusca;
        imovel.codigoOpcaoimovel = 2
        imovel.opcaoimovel = { codigo: 2, nome: 'Lançamentos', nomeUrl: 'apenas-lancamentos' };

        imovel.numeroquartos = '0-quartos'; //OPCIONAL - Enviar nº de quartos a partir, 0 para todos ou negativo para exato
        imovel.numerovagas = 0; //OPCIONAL - Enviar nº de vagas a partir, 0 para todos ou negativo para exato
        imovel.numerobanhos = 0; //OPCIONAL - Enviar nº de banheiros a partir, 0 para todos ou negativo para exato
        imovel.numerosuite = 0; //OPCIONAL - Enviar nº de suítes a partir, 0 para todos ou negativo para exato
        imovel.numerovaranda = 0; //OPCIONAL - Enviar nº de varandas a partir, 0 para todos
        imovel.numeroelevador = 0; //OPCIONAL - Enviar nº de elevadores a partir, 0 para todos
        imovel.valorde = 0; //OPCIONAL - Enviar valor a partir, 0 para todos
        imovel.valorate = 0; //OPCIONAL - Enviar valor até, 0 para todos
        imovel.areade = 0; // OPCIONAL - Enviar área interna a partir, 0 para todos
        imovel.areaate = 0; //OPCIONAL - Enviar área interna até, 0 para todos
        imovel.areaexternade = 0; // OPCIONAL - Enviar área externa a partir, 0 para todos
        imovel.areaexternaate = 0; // OPCIONAL - Enviar área externa até, 0 para todos

        $('.btn-quartos').removeClass('quar-active listagem_filtro_item_active');
        $('.btn-banheiro').removeClass('ban-active listagem_filtro_item_active');
        $('.btn-vagas').removeClass('vagas-active listagem_filtro_item_active');
        $('.btn-suite').removeClass('suite-active listagem_filtro_item_active');

        $('#input_valor_min').val('');
        $('#input_valor_max').val('');
        $('#input_area_min').val('');
        $('#input_area_max').val('');



        $('#id-tag-lancamento-2').remove();
        $('#id-tag-lancamento-aba-2').remove();

        let lancamnento = $('<span>')
            .attr('id', 'id-tag-lancamento-aba-' + imovel.opcaoimovel.codigo)
            .addClass('card-tipo c-lancamentos text-center justify-content-between align-items-center')
            .text('Apenas Lançamentos')
            .attr('codigo', imovel.opcaoimovel.codigo)
            .attr('nome-amigavel', imovel.opcaoimovel.nomeUrl)
            .append(
                $('<img>')
                    .addClass('icon-x')
                    .attr('src', retornarVariavelLocal() + 'assets/icons/icon-x-mini.svg')
            ).click(function () {

                $('#id-tag-lancamento-aba-2').remove();
                removerLancamento();

            });

        $("#container-parametros").append(lancamnento);

        desabilitarCampoParaLancamentos()


        retornarImoveisDisponiveis();
    }
});


//ACAO DO BOTAO DE QUARTOS
$('.btn-quartos').click(function () {

    if ($(this).hasClass('quar-active')) {

        $(this).removeClass('quar-active listagem_filtro_item_active');
        $('.btn-quartos').removeClass('quar-active listagem_filtro_item_active');

        if (imovel.numeroquartos = parseInt($(this).text().replace(/([^\d])+/gim, ''))) {
            imovel.numeroquartos = '0-quartos';

        } else {
            imovel.numeroquartos = parseInt($(this).text().replace(/([^\d])+/gim, ''));
            imovel.numeroquartos = imovel.numeroquartos + '-quartos';
        }

    } else {

        $('.btn-quartos').removeClass('quar-active listagem_filtro_item_active');
        $(this).addClass('quar-active listagem_filtro_item_active');

        imovel.numeroquartos = parseInt($(this).text().replace(/([^\d])+/gim, ''));
        imovel.numeroquartos = imovel.numeroquartos + '-quartos';
    }

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
});

//ACAO DO BANHEIRO
$('.btn-banheiro').click(function () {

    if ($(this).hasClass('ban-active')) {

        $(this).removeClass('ban-active listagem_filtro_item_active');
        $('.btn-banheiro').removeClass('ban-active listagem_filtro_item_active');

        if (imovel.numerobanhos = parseInt($(this).text().replace(/([^\d])+/gim, ''))) {
            imovel.numerobanhos = '0-banheiros';

        } else {
            imovel.numerobanhos = parseInt($(this).text().replace(/([^\d])+/gim, ''));
            imovel.numerobanhos = imovel.numerobanhos + '-banheiros';
        }

    } else {

        $('.btn-banheiro').removeClass('ban-active listagem_filtro_item_active');
        $(this).addClass('ban-active listagem_filtro_item_active');

        imovel.numerobanhos = parseInt($(this).text().replace(/([^\d])+/gim, ''));
        imovel.numerobanhos = imovel.numerobanhos + '-banheiros';
    }

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();

});

//ACAO DE VAGAS
$('.btn-vagas').click(function () {

    if ($(this).hasClass('vagas-active')) {

        $(this).removeClass('vagas-active listagem_filtro_item_active');
        $('.btn-vagas').removeClass('vagas-active listagem_filtro_item_active');

        if (imovel.numerovagas = parseInt($(this).text().replace(/([^\d])+/gim, ''))) {
            imovel.numerovagas = '0-vagas';

        } else {
            imovel.numerovagas = parseInt($(this).text().replace(/([^\d])+/gim, ''));
            imovel.numerovagas = imovel.numerovagas + '-vagas';
        }

    } else {
        $('.btn-vagas').removeClass('vagas-active listagem_filtro_item_active');
        $(this).addClass('vagas-active listagem_filtro_item_active');

        imovel.numerovagas = parseInt($(this).text().replace(/([^\d])+/gim, ''));
        imovel.numerovagas = imovel.numerovagas + '-vagas';
    }

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();

});

//ACAO DO BOTAO SUITE
$('.btn-suite').click(function () {

    if ($(this).hasClass('suite-active')) {

        $(this).removeClass('suite-active listagem_filtro_item_active');
        $('.btn-suite').removeClass('suite-active listagem_filtro_item_active');

        if (imovel.numerosuite = parseInt($(this).text().replace(/([^\d])+/gim, ''))) {
            imovel.numerosuite = 0 + '-suites';

        } else {

            imovel.numerosuite = parseInt($(this).text().replace(/([^\d])+/gim, ''));
            imovel.numerosuite = imovel.numerosuite + '-suites';

        }

    } else {
        $('.btn-suite').removeClass('suite-active listagem_filtro_item_active');
        $(this).addClass('suite-active listagem_filtro_item_active');

        imovel.numerosuite = parseInt($(this).text().replace(/([^\d])+/gim, ''));
        imovel.numerosuite = imovel.numerosuite + '-suites';
    }

    imovel.numeropagina = 1;
    retornarImoveisDisponiveis();
});


//Pega todos os dados da URL
function carregarUrl() {

    return $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-parametros-url', //ImovelController
        async: true,
        data: {
            'finalidade': 0,
            'codigocidade': 0,
            'opcaoimovel': 0,
        }
    })
}

//Pegar parametros gerais para comparar o filtro do cliente
function retornarParametrosGerais() {

    return $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-parametros-gerais', //ImovelController
        async: true,
        data: {
            'finalidade': 0,
            'codigocidade': 0,
            'opcaoimovel': 0,
        }
    })
}


function retornarTiposDisponiveis() {
    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-tipos-disponiveis', //ImovelController
        async: true,
        data: {
            'finalidade': 0,
            'codigocidade': 0,
            'opcaoimovel': 0,
        },
        beforeSend: function () {

        }
    }).done(function (tipos) {


        console.log(tipos);

        //   $.each(tipos.lista, function (key, t) {
        //    });

    }).then(function () {


    }).always(function () {

        $('#id-gif').hide();
    });
}

function retornarBairrosDispoiveis() {


    return false;
    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-bairros-disponiveis', //ImovelController
        async: true,
        data: {
            'finalidade': 0,
            'codigocidade': 0,
            'opcaoimovel': 0,
        },
        beforeSend: function () {

        }
    }).done(function (bairros) {



        console.log(bairros);

        //    $.each(bairros.lista, function (key, t) {
        //
        //   });

    }).then(function () {


    }).always(function () {

        $('#id-gif').hide();
    });
}

function retornarCidadesDisponiveis() {

    return $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-cidades-disponiveis', //ImovelController
        async: true,
        data: {
            'finalidade': 0,
            'codigocidade': 0,
            'opcaoimovel': 0,
        },
        beforeSend: function () {

        }
    }).done(function (bairros) {


        console.log(bairros);

        //    $.each(bairros.lista, function (key, t) {
        //
        //        $('#carrossel_destaques_imoveis').slick('slickAdd', t);
        //    });

    }).then(function () {


    }).always(function () {

        $('#id-gif').hide();
    });
}




$('#btn-tipo-toggle').click(function () {
    $('#container-btn-hide').fadeToggle();
});

$(".corpo-check").click(function () {



    let caract = $(this);
    if (caract.children().hasClass('imovel-check-active')) {

        caract.parent().attr('id');
        caract.children().removeClass('imovel-check-active');

        if (imovel.caracteristicas.length == 1) {
            imovel.caracteristicas = [];

        } else {

            let novoarr = [];
            $.each(imovel.caracteristicas, function (i, c) {
                if (c != caract.attr('id')) {

                    novoarr.push(c);
                }
            });

            imovel.caracteristicas = novoarr;
        }

        imovel.numeropagina = 1;
        retornarImoveisDisponiveis();

    } else {

        $(this).children().addClass('imovel-check-active');
        imovel.caracteristicas.push($(this).attr('id'));

        imovel.numeropagina = 1;
        retornarImoveisDisponiveis();
    }
});

// $('#carregar-mais').click(function () {
//     imovel.numeropagina++;
//     retornarImoveisDisponiveisPaginacao();

// });

$("#ordenacao").change(function () {

    imovel.numeropagina = 1;
    imovel.ordenacao = $(this).val();
    retornarImoveisDisponiveis();

});

$("#ordenacao-mobile").change(function () {
    imovel.numeropagina = 1;
    imovel.ordenacao = $(this).val();
    retornarImoveisDisponiveis();

});


function atualizarPaginacao(imoPaginacao) {



    $('.container-paginacao').empty();

    let numeroPagiana = Math.ceil(parseInt(imoPaginacao.quantidade) / 20);

    for (let i = 1; i <= numeroPagiana; i++) {

        if ((i + 2) == parseInt(imovel.numeropagina) || (i + 1) == parseInt(imovel.numeropagina) || i == parseInt(imovel.numeropagina) || (i - 2) == parseInt(imovel.numeropagina) || (i - 1) == parseInt(imovel.numeropagina)) {

            let btnPage = $('<div>')
                .addClass('btn-paginacao ' + (imovel.numeropagina == i ? 'active' : ''))
                .append($('<span>').text(i));

            $(btnPage).click(function () { retornarImoveisDisponiveisPaginacao(i) });

            $('.container-paginacao').append(btnPage);
        }

    }


    $('#btn-end').empty();

    let btn = $('<div>').attr('id', 'ultimaPagina').addClass('btn-paginacao');
    $(btn).append($('<span>').addClass('carousel_setinha_listagem').text('›'));
    $(btn).click(function () {
        retornarImoveisDisponiveisPaginacao(numeroPagiana)
    });

    $('#btn-end').append(btn);



    //mostrar os botões
    $('#container_geral_paginacao').css('display', 'flex');

}

$('#primeiraPagina').click(function () {
    retornarImoveisDisponiveisPaginacao(1);
})


$('#input_codigo').change(function () {
    retornarImoveisPeloCoigo($(this).val())

    // window.location.href = retornarVariavelLocal()+'venda?codigos='+ $(this).val();
})


function buscarPorCodigoInput(c) {

    if (ajaxID == 0) {
        return false;
    }

    if (c == '') {

        $('.container-result-codigo').css('display', 'none');
        $('.container-result-codigo').empty();

        return false;
    }


    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'retornar-imoveis-codigo', //ImovelController
        async: true,
        data: {
            'codigo': c,
            'pagina': 1,
            //'finalidade': imovel.finalidade
        },
        beforeSend: function () {

            ajaxID = 0;
            $('.container-result-codigo').css('display', 'block');
            $('.container-result-codigo').empty();

        }

    }).fail(function () {

        console.log("error ao carregaso  favoritos");

    }).done(function (imovel) {


        if (imovel.quantidade == 0) {

            let alert = '<div class="container-alert">' +
                '<div class="alert-imoveis">' +
                '<span class="material-symbols-outlined">public</span> <span>Código não encontrado </span></br>' +
                '</div>' +
                '</div>';

            $('.container-result-codigo').append(alert);
        }


        $('#texto-topo-busca').text(imovel.quantidade);

        $.each(imovel.lista, function (key, imo) {

            let ob = '<a href="' + retornarVariavelLocal() + "imovel/" + imo.url_amigavel + '/' + imo.codigo + '">' +
                '<div class="card-codigo">' +
                '<div class="container-img">' +
                '<img loading="lazy" src="' + imo.urlfotoprincipalp + '" />' +
                '</div>' +
                '<div class="contain">' +
                '<h2>' + imo.tipo + ' | ' + imo.bairro + '</h2>' +
                '<span>' + retornarValor(imo.valor) + '</span>' +
                '</div>' +
                '</div>' +
                '</a>';


            $('.container-result-codigo').append(ob);


        });
    }).then(function () {

        ajaxID = 1;

        $('.modal-loader').css('display', 'none');

    }).always(function () {

    });
}


function scrollTopBusca() {

    let targetOffset = $('.texto-topo-busca').offset().top;
    $('html, body').animate({
        scrollTop: targetOffset
    }, 500);

}





/*
 *  ====================
 *      Customização 
 *  ====================
 */

function getBairrosApi() {

    $('.cont-bairro').text(0);

    if (imovel.codigocidade != '0') {

        $.ajax({
            method: "POST",
            url: retornarVariavelLocal() + 'retornar-bairros-disponiveis', //ImovelController
            async: true,
            data: imovel,
            beforeSend: function () {
                $('.lista-bairros ul').empty();
            }
        }).done(function (bairros) {

            $.each(bairros.lista, function (key, bairro) {

                // let bairroOption = $('<option>');
                // bairroOption.attr('url', bairro.urlAmigavel);
                // bairroOption.attr('cod_bairro', bairro.codigo);
                // bairroOption.attr('nome_amigavel', bairro.urlAmigavel);
                // bairroOption.attr('nome_origianl', bairro.cidade);
                // bairroOption.attr('nome_cidade', bairro.urlCidadeAmigavel);
                // bairroOption.text(bairro.nome);

                let option = '<li><input id="' + bairro.urlAmigavel + '"  type="checkbox" id="check-' + bairro.urlAmigavel + '" class="check-box-bairros" data-codigo="' + bairro.codigobairro + '" value="' + bairro.urlAmigavel + '" url="' + bairro.urlAmigavel + '" cod_bairro="' + bairro.codigobairro + '" nome_amigavel="' + bairro.urlAmigavel + '" nome_origianl="' + bairro.nomebairro + '" nome_cidade="' + bairro.nomecidade + '"><label for="' + bairro.urlAmigavel + '">' + bairro.nomebairro + '</label></li>';

                option = $(option).click(function () {
                    // Suponha que o contêiner tenha a classe "container"
                    var quantidadeBairrosMarcados = $('.lista-bairros input[type="checkbox"]:checked').length;
                    $('.cont-bairro').text(quantidadeBairrosMarcados);
                    if ($(this).children('input').is(':checked')) {
                        adicionarBairro($(this).children('input'))
                    } else {
                        removerBairro(option);
                    }
                });


                $('.lista-bairros ul').append(option);

                // $('#bairro').append('<option onClick="getBairros"  url="' + bairro.url_amigavel + '" id-cond="' + bairro.codigo + '" value="' + bairro.url_amigavel + '">' + bairro.nome + '</option>');
            });

        }).then(function () {

        }).always(function () {

        });

    } else {

        $('.lista-bairros ul').empty();

    }
}




$('#cidade').change(function () {

    //Atualizar
    $('.count-bairros').text('0');

    //LIMPA OS BAIRROS
    imovel.endereco = '';
    imovel.bairros = [];
    imovel.bairros.push({
        cidade: "brasil",
        codigocidade: '',
        codigo: '',
        estado: "",
        nome: "",
        nomeUrl: "todos-os-bairros",
        regiao: "brasil"
    });

    obj_cidade.cidade = $(this).val();

    $('#cidade option').each(function (cont, city) {

        if ($(city).attr('url') == obj_cidade.cidade) {
            obj_cidade.cod_cidade = $(this).attr('id-cidade');
            obj_cidade.codigocidade = $(this).attr('id-cidade');
            obj_cidade.nome_amigavel = $(this).attr('url');
            obj_cidade.cidadeNome = $(this).attr('data-nome');
        }
    })

    $('.card-tipo').remove();

    $('#endereco').val('');
    $('#lista-endereco').empty();
    $('#lista-endereco-top').empty();

    imovel.cidades = {
        codigo: obj_cidade.cod_cidade,
        codigocidade: obj_cidade.cod_cidade,
        estado: "",
        estadoUrl: "",
        nome: obj_cidade.cidadeNome,
        nomeUrl: obj_cidade.nome_amigavel
    }

    imovel.codigocidade = obj_cidade.cod_cidade;
    // imovel.bairros = obj_cidade;


    getBairrosApi();
    retornarImoveisDisponiveis();
    carregarCondominios();
})


//CARREGAR OS CONDOMINIOS
function carregarCondominios() {

    let paramCondominio = { ...imovel };
    paramCondominio.finalidade = '0';
    paramCondominio.numeroregistros = 1000;
    paramCondominio.retornoReduzido = 'true';

    $.ajax({
        method: "POST",
        url: retornarVariavelLocal() + 'get-condominios', //ImovelController
        async: true,
        data: paramCondominio,
        beforeSend: function () {
            $('#condominio').empty();
            $('#condominio').append('<option value="0">Carregando...</option>');
        }
    }).done(function (cond) {

        $('#condominio').empty();
        $('#condominio').append('<option value="0">Todos</option>');

        $.each(cond.lista, function (key, c) {

            $('#condominio').append('<option url="' + c.url_amigavel + '" id-cond="' + c.codigo + '" value="' + c.url_amigavel + '">' + c.nome + '</option>');
        });

    }).then(function () {



    }).always(function () {

    });
}




function adicionarBairro(addBairo) {


    imovel.bairros = []
    var checkboxesMarcados = $('.lista-bairros input[type="checkbox"]:checked');

    checkboxesMarcados.each(function (key, bairro) {

        obj_bairro.nome = $(bairro).attr('nome_origianl');
        obj_bairro.cod_bairro = $(bairro).attr('cod_bairro');
        obj_bairro.nome_cidade = $(bairro).attr('nome_cidade');
        obj_bairro.nome_cidade_original = $(bairro).attr('nome_cidade');
        obj_bairro.nome_amigavel = $(bairro).attr('url');
        obj_bairro.nomeUrl = $(bairro).attr('url');
        obj_bairro.nome_origianl = $(this).attr('nome_origianl');


        imovel.bairros.push({
            cidade: obj_bairro.nome_cidade,
            codigo: obj_bairro.cod_bairro,
            nomeOriginalCidade: obj_bairro.nome_origianl,
            //      estado:obj_bairro.,
            nome: obj_bairro.nome,
            nomeUrl: obj_bairro.nome_amigavel,
            //      regiao: obj_bairro.
        });
    });


    $('.count-bairros').text(imovel.bairros.length);

    $('#lista-endereco').empty();
    $('#lista-endereco-top').empty();


    $('#endereco').val('');
    imovel.endereco = '';

    retornarImoveisDisponiveis();
}




var $listaBairros = $('.lista-bairros');
var $btnToggle = $('.btn-toggle');

// Função para alternar a visibilidade da lista de bairros
$btnToggle.on('click', function (e) {

    if ($('.lista-bairros ul li').length == '0') {
        mostrarMensagem('Selecione uma Cidade para carregar os Bairros.'); //alertError
    }

    $listaBairros.toggle();
    e.stopPropagation(); // Previne que o clique se propague para o document
});

// Função para fechar a lista de bairros ao clicar fora dela
$(document).on('click', function (e) {
    if (!$listaBairros.is(e.target) && $listaBairros.has(e.target).length === 0 && !$btnToggle.is(e.target)) {
        $listaBairros.hide();
    }
});

// Impede que cliques dentro da lista de bairros fechem a lista
$listaBairros.on('click', function (e) {
    e.stopPropagation();
});





$.ajax({
    method: "POST",
    url: retornarVariavelLocal() + 'retornar-campos-extas-disponiveis',
    async: true,
    data: {},
    beforeSend: function () {

        $('#container-caracterisicas-extas').append('<span>Carregando opções...</span>');
    }
}).done(function (caracteristicas) {

    $('#container-caracterisicas-extas').empty();

    let urlAtual = window.location.href;
    let url_caracteritica = new URL(urlAtual);
    var carac_extras = url_caracteritica.searchParams.get("extras");

    if (carac_extras) {
        carac_extras_teste = carac_extras.split(',')
    } else {
        carac_extras_teste = [];
    }


    $(caracteristicas.lista).each(function (key, caracteristica) {

        let carac_extras = $('<div data-extras="' + caracteristica.codigo + '" class="corpo-check-extra d-flex">' +
            '<div class="imovel-check d-flex justify-content-center align-items-center ' + (checkCaracteristicasExtras(carac_extras_teste, caracteristica.codigo) == true ? 'imovel-check-active' : '') + '">' +
            '<img class="lazyload" data-src="' + retornarVariavelLocal() + 'assets/icons/icon-check-white.svg" /></div>' +
            caracteristica.nome +
            '</div>').click(function () {

                let extra = $(this).children();

                if (extra.hasClass('imovel-check-active')) {

                    extra.parent().attr('data-extras');
                    extra.removeClass('imovel-check-active');

                    if (imovel.extras.length == 1) {

                        imovel.extras = [];

                    } else {

                        let novoarr = [];
                        $.each(imovel.extras, function (i, c) {
                            if (c != extra.parent().attr('data-extras')) {

                                novoarr.push(c);
                            }
                        });

                        imovel.extras = novoarr;
                    }

                    imovel.numeropagina = 1;
                    retornarImoveisDisponiveis();

                } else {

                    extra.addClass('imovel-check-active');
                    imovel.extras.push(extra.parent().attr('data-extras'));

                    imovel.numeropagina = 1;
                    retornarImoveisDisponiveis();
                }
            });



        $('#container-caracterisicas-extas').append(carac_extras);
    })


}).then(function () {
}).always(function () { });


//CARACTERISTICAS EXTRAS
function marcarCaracteristicasExtras(param) {

    let caract = $(this);

    if (caract.hasClass('imovel-check-active')) {

        caract.parent().attr('id');
        caract.removeClass('imovel-check-active');

        if (imovel.caracteristicas.length == 1) {

            imovel.caracteristicas = [];

        } else {

            let novoarr = [];
            $.each(imovel.caracteristicas, function (i, c) {
                if (c != caract.parent().attr('id')) {

                    novoarr.push(c);
                }
            });

            imovel.caracteristicas = novoarr;
        }

        imovel.numeropagina = 1;
        retornarImoveisDisponiveis();

    } else {

        $(this).addClass('imovel-check-active');
        imovel.caracteristicas.push($(this).parent().attr('id'));

        imovel.numeropagina = 1;
        retornarImoveisDisponiveis();
    }
}


function checkCaracteristicasExtras(caracteristiacas_extras, opcaoMarcada) {

    let validao = false;

    $(caracteristiacas_extras).each(function (i, element) {
        if (parseInt(element) == opcaoMarcada) {
            validao = true;
        }
    })

    return validao;
}
