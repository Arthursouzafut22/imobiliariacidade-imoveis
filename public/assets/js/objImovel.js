var imovel = {};

imovel.finalidade = 'venda'; //OBRIGATÓRIO - Enviar 1 para ALUGUEL ou 2 para VENDA
imovel.codigounidade = ''; //OPCIONAL - Enviar código da unidade ou vazio para todas
imovel.codigocondominio = 0; // OPCIONAL - Enviar o código do condomínio (lista de condomínios em Imovel/RetornarCondominiosDisponiveis) ou 0 para todos
imovel.codigoproprietario = 0; // OPCIONAL - Enviar o código do proprietário (lista autocomplete de pessoas em Cliente/App_PesquisarCliente) ou 0 para todos
imovel.codigocaptador = 0; //OPCIONAL - Enviar o código do captador (lista autocomplete de usuários em Usuario/App_RetornarUsuarios) ou 0 para todos
imovel.codigosimovei = 0; //OPCIONAL - Enviar os códigos dos imóveis separados por vírgula (,) ou vazio para todos
imovel.tipos = [];
imovel.codigoTipo = []; //OPCIONAL - Enviar o código do tipo de imóvel selecionado de acordo com a lista existente (RetornarTiposImoveisDisponiveis), para mais de um tipo, separar por vírgula (,) ou vazio para todos
imovel.estado; // OPCIONAL - Enviar a sigla do estado selecionado de acordo com a lista existente (RetornarEstadosDisponiveis) ou vazio para todos
imovel.codigocidade = 0; // OPCIONAL - Enviar o código da cidade selecionada de acordo com a lista existente (RetornarCidadesDisponiveis) ou 0 para todos
imovel.codigoregiao = 0; // OPCIONAL - Enviar o código da região selecionada de acordo com a lista existente (RetornarRegioesDisponiveis) ou 0 para todos
imovel.bairros = [];
imovel.codigosbairros = []; //OPCIONAL - Enviar os códigos dos bairros selecionados de acordo com a lista existente (RetornarBairrosDisponiveis) separados por vírgula (,) ou vazio para todos
imovel.endereco = ''; //OPCIONAL - Enviar parte do logradouro do endereço ou vazio para todos
imovel.edificio = ''; // OPCIONAL - Enviar parte do edifício/torre ou vazio para todos
imovel.numeroquartos = 0; //OPCIONAL - Enviar nº de quartos a partir, 0 para todos ou negativo para exato
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
imovel.extras = []; // OPCIONAL - Enviar código gerado no CRM para o campo extra, separados por vírgula (,) ou vazio para não filtrar
imovel.caracteristicas = [];
imovel.academia; //OPCIONAL - Enviar true ou false
imovel.aceitafinanciamento; //OPCIONAL - Enviar true ou false
imovel.aceitapermuta; //OPCIONAL - Enviar true ou false
imovel.alarme; //OPCIONAL - Enviar true ou false
imovel.arealazer; //OPCIONAL - Enviar true ou false
imovel.areaprivativa; //OPCIONAL - Enviar true ou false
imovel.areaservico; //OPCIONAL - Enviar true ou false
imovel.boxbanheiro; // OPCIONAL - Enviar true ou false
imovel.boxDespejo; //OPCIONAL - Enviar true ou false
imovel.churrasqueira; //OPCIONAL - Enviar true ou false
imovel.circuitotv; //OPCIONAL - Enviar true ou false
imovel.closet; //OPCIONAL - Enviar true ou false
imovel.dce; //OPCIONAL - Enviar true ou false
imovel.exclusivo; //OPCIONAL - Enviar true ou false
imovel.interfone; // OPCIONAL - Enviar true ou false
imovel.jardim; // OPCIONAL - Enviar true ou false
imovel.lavabo; //OPCIONAL - Enviar true ou false
imovel.mobiliado; //OPCIONAL - Enviar true ou false
imovel.naplanta; //OPCIONAL - Enviar true ou false
imovel.playground; //OPCIONAL - Enviar true ou false
imovel.portaoeletronico; //OPCIONAL - Enviar true ou false
imovel.portaria24h; //OPCIONAL - Enviar true ou false
imovel.quadraesportiva; //OPCIONAL - Enviar true ou false
imovel.quadratenis; //OPCIONAL - Enviar true ou false
imovel.salaojogos; //OPCIONAL - Enviar true ou false
imovel.sauna; //OPCIONAL - Enviar true ou false
imovel.varanda; //OPCIONAL - Enviar true ou false
imovel.wifi; //OPCIONAL - Enviar true ou false
imovel.ocupado; //OPCIONAL - Enviar true para imóveis ocupados, ou false para desocupado ou vazio para todos
imovel.alugado; //OPCIONAL - Enviar true ou false
imovel.quartoqtdeexata; //OPCIONAL - Enviar true ou false
imovel.vagaqtdexata; //OPCIONAL - Enviar true ou false
imovel.datacadastroinicio; //OPCIONAL - Enviar data no formato dd/mm/yyyy
imovel.datacadastrofim; //OPCIONAL - Enviar data no formato dd/mm/yyyy
imovel.dataultimaalteracaoinicio; //OPCIONAL - Enviar data no formato dd/mm/yyyy hh:mm:ss
imovel.dataultimaalteracaofim; //OPCIONAL - Enviar data no formato dd/mm/yyyy hh:mm:ss
imovel.destaque = 1; //OPCIONAL - Enviar 1 para simples, 2 para destaque ou 3 para super destaque, 0 para todos
imovel.opcaoimovel = 3; //OPCIONAL - Enviar 1 para somente avulsos, 2 para somente lançamentos, 3 para unidades de lançamentos, 4 para avulsos e lançamentos mãe, 0 para todos (avulsos e lançamentos por tipo e m²)
imovel.codigoOpcaoimovel = {};
imovel.retornomapa; //OPCIONAL - Enviar true ou false, usado para exibir os imóveis no mapa (retorno com até 100 registros e JSON reduzido)
imovel.retornomapaapp = false; //OPCIONAL - Enviar true ou false, usado para exibir os imóveis no mapa (retorno com até 100 registros e JSON reduzido)
imovel.numeropagina = 1; // OBRIGATÓRIO - Usado para paginação, enviar o nº da página atual
imovel.numeroregistros = 16; //OBRIGATÓRIO - Usado máximo de imóveis para retorno, máximo 20
imovel.ordenacao = ''; //OPCIONAL - Tipo de ordenação, codigoasc, codigodesc, valorasc, valordesc, dataatualizacaoasc, dataatualizacaodesc, datainclusaoasc, datainclusaodesc, datavagodesdeasc, datavagodesdedesc, destaque ou vazio para assumir destaque decrescente
imovel.exibircaptadores; //OPCIONAL - Enviar true ou false
imovel.codigoempreendimentomae = ''; //OPCIONAL - Codigo empreendimento mae

