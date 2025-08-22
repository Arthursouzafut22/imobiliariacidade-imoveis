<?php

namespace src\handlers;

class Imovel
{

    private $finalidade = 2; //OBRIGATÓRIO - Enviar 1 para ALUGUEL ou 2 para VENDA
    private $codigounidade = ''; //OPCIONAL - Enviar código da unidade ou vazio para todas
    private $codigocondominio = 0; // OPCIONAL - Enviar o código do condomínio (lista de condomínios em Imovel/RetornarCondominiosDisponiveis) ou 0 para todos
    private $codigoproprietario = 0; // OPCIONAL - Enviar o código do proprietário (lista autocomplete de pessoas em Cliente/App_PesquisarCliente) ou 0 para todos
    private $codigocaptador = 0; //OPCIONAL - Enviar o código do captador (lista autocomplete de usuários em Usuario/App_RetornarUsuarios) ou 0 para todos
    private $codigosimoveis = []; //OPCIONAL - Enviar os códigos dos imóveis separados por vírgula (,) ou vazio para todos
    private $codigoTipo = []; //OPCIONAL - Enviar o código do tipo de imóvel selecionado de acordo com a lista existente (RetornarTiposImoveisDisponiveis), para mais de um tipo, separar por vírgula (,) ou vazio para todos
    private $estado; // OPCIONAL - Enviar a sigla do estado selecionado de acordo com a lista existente (RetornarEstadosDisponiveis) ou vazio para todos
    private $codigocidade = 0; // OPCIONAL - Enviar o código da cidade selecionada de acordo com a lista existente (RetornarCidadesDisponiveis) ou 0 para todos
    private $codigoregiao = 0; // OPCIONAL - Enviar o código da região selecionada de acordo com a lista existente (RetornarRegioesDisponiveis) ou 0 para todos
    private $codigosbairros = []; //OPCIONAL - Enviar os códigos dos bairros selecionados de acordo com a lista existente (RetornarBairrosDisponiveis) separados por vírgula (,) ou vazio para todos
    public $codigoBairro = ''; // PARA FILTRAR CONDOMINIO POR BAIRRO;
    private $endereco = ''; //OPCIONAL - Enviar parte do logradouro do endereço ou vazio para todos
    private $edificio = ''; // OPCIONAL - Enviar parte do edifício/torre ou vazio para todos
    private $numeroquartos = 0; //OPCIONAL - Enviar nº de quartos a partir, 0 para todos ou negativo para exato
    private $numerovagas = 0; //OPCIONAL - Enviar nº de vagas a partir, 0 para todos ou negativo para exato
    private $numerobanhos = 0; //OPCIONAL - Enviar nº de banheiros a partir, 0 para todos ou negativo para exato
    private $numerosuite = 0; //OPCIONAL - Enviar nº de suítes a partir, 0 para todos ou negativo para exato
    private $numerovaranda = 0; //OPCIONAL - Enviar nº de varandas a partir, 0 para todos
    private $numeroelevador = 0; //OPCIONAL - Enviar nº de elevadores a partir, 0 para todos
    private $valorde = 0; //OPCIONAL - Enviar valor a partir, 0 para todos
    private $valorate = 0; //OPCIONAL - Enviar valor até, 0 para todos
    private $areade = 0; // OPCIONAL - Enviar área interna a partir, 0 para todos
    private $areaate = 0; //OPCIONAL - Enviar área interna até, 0 para todos
    private $areaexternade = 0; // OPCIONAL - Enviar área externa a partir, 0 para todos
    private $areaexternaate = 0; // OPCIONAL - Enviar área externa até, 0 para todos
    private $extras = ''; // OPCIONAL - Enviar código gerado no CRM para o campo extra, separados por vírgula (,) ou vazio para não filtrar
    private $academia; //OPCIONAL - Enviar true ou false
    private $aceitafinanciamento; //OPCIONAL - Enviar true ou false
    private $aceitapermuta; //OPCIONAL - Enviar true ou false
    private $alarme; //OPCIONAL - Enviar true ou false
    private $arealazer; //OPCIONAL - Enviar true ou false
    private $areaprivativa; //OPCIONAL - Enviar true ou false
    private $areaservico; //OPCIONAL - Enviar true ou false
    private $boxbanheiro; // OPCIONAL - Enviar true ou false
    private $boxDespejo; //OPCIONAL - Enviar true ou false
    private $churrasqueira; //OPCIONAL - Enviar true ou false
    private $circuitotv; //OPCIONAL - Enviar true ou false
    private $closet; //OPCIONAL - Enviar true ou false
    private $dce; //OPCIONAL - Enviar true ou false
    private $exclusivo; //OPCIONAL - Enviar true ou false
    private $interfone; // OPCIONAL - Enviar true ou false
    private $jardim; // OPCIONAL - Enviar true ou false
    private $lavabo; //OPCIONAL - Enviar true ou false
    private $mobiliado; //OPCIONAL - Enviar true ou false
    private $naplanta; //OPCIONAL - Enviar true ou false
    private $playground; //OPCIONAL - Enviar true ou false
    private $portaoeletronico; //OPCIONAL - Enviar true ou false
    private $portaria24h; //OPCIONAL - Enviar true ou false
    private $quadraesportiva; //OPCIONAL - Enviar true ou false
    private $quadratenis; //OPCIONAL - Enviar true ou false
    private $salaojogos; //OPCIONAL - Enviar true ou false
    private $sauna; //OPCIONAL - Enviar true ou false
    private $varanda; //OPCIONAL - Enviar true ou false
    private $wifi; //OPCIONAL - Enviar true ou false
    private $ocupado; //OPCIONAL - Enviar true para imóveis ocupados, ou false para desocupado ou vazio para todos
    private $alugado; //OPCIONAL - Enviar true ou false
    private $quartoqtdeexata; //OPCIONAL - Enviar true ou false
    private $vagaqtdexata; //OPCIONAL - Enviar true ou false
    private $datacadastroinicio; //OPCIONAL - Enviar data no formato dd/mm/yyyy
    private $datacadastrofim; //OPCIONAL - Enviar data no formato dd/mm/yyyy
    private $dataultimaalteracaoinicio; //OPCIONAL - Enviar data no formato dd/mm/yyyy hh:mm:ss
    private $dataultimaalteracaofim; //OPCIONAL - Enviar data no formato dd/mm/yyyy hh:mm:ss
    private $destaque = 0; //OPCIONAL - Enviar 1 para simples, 2 para destaque ou 3 para super destaque, 0 para todos
    private $opcaoimovel = 0; //OPCIONAL - Enviar 1 para somente avulsos, 2 para somente lançamentos, 3 para unidades de lançamentos, 4 para avulsos e lançamentos mãe, 0 para todos (avulsos e lançamentos por tipo e m²)
    private $retornomapa = false; //OPCIONAL - Enviar true ou false, usado para exibir os imóveis no mapa (retorno com até 100 registros e JSON reduzido)
    private $retornomapaapp = false; //OPCIONAL - Enviar true ou false, usado para exibir os imóveis no mapa (retorno com até 100 registros e JSON reduzido)
    private $numeropagina = 0; // OBRIGATÓRIO - Usado para paginação, enviar o nº da página atual
    private $numeroregistros = 20; //OBRIGATÓRIO - Usado máximo de imóveis para retorno, máximo 20
    private $ordenacao = ''; //OPCIONAL - Tipo de ordenação, codigoasc, codigodesc, valorasc, valordesc, dataatualizacaoasc, dataatualizacaodesc, datainclusaoasc, datainclusaodesc, datavagodesdeasc, datavagodesdedesc, destaque ou vazio para assumir destaque decrescente
    private $exibircaptadores; //OPCIONAL - Enviar true ou false
    private $url = [];
    private $caracteristicas = [];
    private $paramAPI = [];
    private $retornoReduzido = 'true';

    public function __construct()
    {
    }

    public function getParamtrosApi()
    {

        $this->paramAPI['codigosimoveis'] = $this->getCodigosimoveis();
       
        $this->paramAPI['finalidade'] = $this->getFinalidade();
        $this->paramAPI['codigoTipo'] = $this->getCodigoTipo();
        $this->paramAPI['endereco'] = $this->getEndereco();
        $this->paramAPI['codigocidade'] = $this->getCodigoCidade();
        $this->paramAPI['codigosbairros'] = $this->getCodigosbairros();
        $this->paramAPI['opcaoimovel'] = $this->getOpcaoimovel();
        $this->paramAPI['destaque'] = $this->getDestaque();
        $this->paramAPI['numeropagina'] = $this->getNumeropagina();
        $this->paramAPI['numeroregistros'] = $this->getNumeroregistros();
        $this->paramAPI['numeroquartos'] = $this->getNumeroquartos();
        $this->paramAPI['numerobanhos'] = $this->getNumerobanhos();
        $this->paramAPI['numerovagas'] = $this->getNumerovagas();
        $this->paramAPI['numerosuite'] = $this->getNumerosuite();
        $this->paramAPI['valorde'] = $this->getValorde();
        $this->paramAPI['valorate'] = $this->getValorate();
        $this->paramAPI['areade'] = $this->getAreade();
        $this->paramAPI['areaate'] = $this->getAreaate();
        $this->paramAPI['retornomapaapp'] = $this->getRetornomapaapp();
        $this->paramAPI['ordenacao'] = $this->getOrdenacao();
        $this->paramAPI['codigocondominio'] = $this->getCodigocondominio();
        $this->paramAPI['retornodestaque'] = 'true';
        $this->paramAPI['retornoReduzido'] = $this->getRetornoReduzido(); //para busca de condomínio


        return $this->paramAPI;
    }

    public function getParamtrosBanco()
    {

        $this->paramAPI['codigosimoveis'] = $this->getCodigosimoveis();
        $this->paramAPI['codigoempreendimentomae'] = $this->getCodigoEmpreendimentoMae();
        $this->paramAPI['finalidade'] = $this->getFinalidade();
        $this->paramAPI['codigoTipo'] = $this->getCodigoTipo();
        $this->paramAPI['endereco'] = $this->getEndereco();
        $this->paramAPI['codigocidade'] = $this->getCodigoCidade();
        $this->paramAPI['codigosbairros'] = $this->getCodigosbairros();
        $this->paramAPI['opcaoimovel'] = $this->getOpcaoimovel();
        $this->paramAPI['destaque'] = $this->getDestaque();
        $this->paramAPI['numeropagina'] = $this->getNumeropagina();
        $this->paramAPI['numeroregistros'] = $this->getNumeroregistros();
        $this->paramAPI['numeroquartos'] = $this->getNumeroquartos();
        $this->paramAPI['numerobanhos'] = $this->getNumerobanhos();
        $this->paramAPI['numerovagas'] = $this->getNumerovagas();
        $this->paramAPI['numerosuite'] = $this->getNumerosuite();
        $this->paramAPI['valorde'] = $this->getValorde();
        $this->paramAPI['valorate'] = $this->getValorate();
        $this->paramAPI['areade'] = $this->getAreade();
        $this->paramAPI['areaate'] = $this->getAreaate();
        $this->paramAPI['retornomapaapp'] = $this->getRetornomapaapp();
        $this->paramAPI['ordenacao'] = $this->getOrdenacao();
        $this->paramAPI['codigocondominio'] = $this->getCodigocondominio();
        $this->paramAPI['extras'] = $this->getExtras();
        //        $this->paramAPI['codigoBairro'] = $this->getCodbairro();

        $this->paramAPI['retornodestaque'] = 'true';
        $this->paramAPI['retornoReduzido'] = $this->getRetornoReduzido(); //para busca de condomínio


        return $this->paramAPI;
    }


    //CALULA O TEMPO QUE O IMÓVEL FOI CADASTRADO
    public function imovelNovo($data2)
    {


        $data1 = date("d-m-Y");
        $data2 = explode(' ', $data2);

        // transforma a data do formato BR para o formato americano, ANO-MES-DIA
        $data1 = implode('-', array_reverse(explode('/', $data1)));
        $data2 = implode('-', array_reverse(explode('/', $data2[0])));

        // converte as datas para o formato timestamp
        $d1 = strtotime($data1);
        $d2 = strtotime($data2);

        // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
        $dataFinal = ($d2 - $d1) / 86400;




        // caso a data 2 seja menor que a data 1, multiplica o resultado por -1
        if ($dataFinal < 0) {
            $dataFinal *= -1;
        }





        return $dataFinal;
    }

    public function getParamtrosDetalheImovelApi()
    {
        return [
            'codigoImovel' => $this->getCodigosimoveis(),
        ];
    }

    public function setCodigoEmpreendimentoMae($codigomae)
    {
        $this->codigoempreendimentomae = $codigomae;
    }

    public function getCodigoEmpreendimentoMae()
    {
        return $this->codigoempreendimentomae;
    }

    public function setCodbairro($b)
    {
        $this->codigoBairro = $b;
    }

    public function getCodbairro()
    {
        return $this->codigoBairro;
    }

    function setFinalidade($finalidade)
    {

        if ($finalidade == 'Venda' || $finalidade == 'venda' || $finalidade == 'comprar' || $finalidade == 2) {

            $this->finalidade = 2;
        } else if ($finalidade == 'Aluguel' || $finalidade == 'aluguel' || $finalidade == 'alugar' || $finalidade == 1) {

            $this->finalidade = 1;
        } else {

            $this->finalidade = 0;
        }
    }

    function getRetornoReduzido()
    {
        return $this->retornoReduzido;
    }

    function setRetornoReduzido($retornoReduzido)
    {
        $this->retornoReduzido = $retornoReduzido;
    }

    function setCodigounidade($codigounidade)
    {
        $this->codigounidade = $codigounidade;
    }

    function setCodigoproprietario($codigoproprietario)
    {
        $this->codigoproprietario = $codigoproprietario;
    }

    function setCodigocaptador($codigocaptador)
    {
        $this->codigocaptador = $codigocaptador;
    }

    function setCodigosimoveis($codigosimoveis)
    {

        $aux = explode(',', $codigosimoveis);

        foreach ($aux as $cod) {
            if ($cod != '') {

                $this->codigosimoveis[] = $cod;
            }
        }

    }

    function setCodigoTipo($codigoTipo)
    {

        if (isset($codigoTipo[0]['codigo']) && (!empty($codigoTipo[0]['codigo']))) {

            foreach ($codigoTipo as $key => $value) {

                $this->codigoTipo[] = $value['codigo'];
            }

        } else {
            $this->codigoTipo = [];
        }
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
    }

    function setCodigocidade($codigocidade)
    {

        $this->codigocidade = '';

        $this->codigocidade = $codigocidade;
    }

    function setCodigoregiao($codigoregiao)
    {
        $this->codigoregiao = $codigoregiao;
    }

    function setCodigosbairros($codigosbairros)
    {

        if (isset($codigosbairros[0]['codigo']) && (!empty($codigosbairros[0]['codigo']))) {

            foreach ($codigosbairros as $key => $value) {

                $this->codigosbairros[] = $value['codigo'];
            }

        } else {
            $this->codigosbairros = [];
        }



    }

    function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    function setEdificio($edificio)
    {
        $this->edificio = $edificio;
    }

    function setNumeroquartos($numeroquartos)
    {

        if ($numeroquartos == '1-quarto' || $numeroquartos == '1-quartos' || $numeroquartos == '1') {

            $this->numeroquartos = 1;
        } else if ($numeroquartos == '2-quarto' || $numeroquartos == '2-quartos' || $numeroquartos == '2') {

            $this->numeroquartos = 2;
        } else if ($numeroquartos == '3-quarto' || $numeroquartos == '3-quartos' || $numeroquartos == '3') {

            $this->numeroquartos = 3;
        } else if ($numeroquartos == '4-quarto' || $numeroquartos == '4-quartos' || $numeroquartos == '4+') {

            $this->numeroquartos = 4;
        } else {
            $this->numeroquartos = 0;
        }
    }

    function setNumerovagas($numerovagas)
    {

        if ($numerovagas == '0-vaga' || $numerovagas == '0-vagas' || $numerovagas == '0-vagas') {
            $this->numerovagas = 0;
        } else if ($numerovagas == '1-vaga' || $numerovagas == '1-vagas' || $numerovagas == '1') {

            $this->numerovagas = 1;
        } else if ($numerovagas == '2-vaga' || $numerovagas == '2-vagas' || $numerovagas == '2') {

            $this->numerovagas = 2;
        } else if ($numerovagas == '3-vaga' || $numerovagas == '3-vagas' || $numerovagas == '3') {

            $this->numerovagas = 3;
        } else if ($numerovagas == '4-vaga' || $numerovagas == '4-vagas' || $numerovagas == '4+') {

            $this->numerovagas = 4;
        }
    }

    function setNumerobanhos($numerobanhos)
    {

        if ($numerobanhos == '1-banheiro' || $numerobanhos == '1-banheiros' || $numerobanhos == '1') {

            $this->numerobanhos = 1;
        } else if ($numerobanhos == '2-banheiro' || $numerobanhos == '2-banheiros' || $numerobanhos == '2') {

            $this->numerobanhos = 2;
        } else if ($numerobanhos == '3-banheiro' || $numerobanhos == '3-banheiros' || $numerobanhos == '3') {

            $this->numerobanhos = 3;
        } else if ($numerobanhos == '4-banheiro' || $numerobanhos == '4-banheiros' || $numerobanhos == '4+') {

            $this->numerobanhos = 4;
        } else {
            $this->numerobanhos = 0;
        }
    }

    function setNumerosuite($numerosuite)
    {

        if ($numerosuite == '1-suite' || $numerosuite == '1-suites' || $numerosuite == '1') {

            $this->numerosuite = 1;
        } else if ($numerosuite == '2-suite' || $numerosuite == '2-suites' || $numerosuite == '2') {

            $this->numerosuite = 2;
        } else if ($numerosuite == '3-suite' || $numerosuite == '3-suites' || $numerosuite == '3') {

            $this->numerosuite = 3;
        } else if ($numerosuite == '4-suite' || $numerosuite == '4-suites' || $numerosuite == '4+') {

            $this->numerosuite = 4;
        } else {
            $this->numerosuite = 0;
        }
    }

    function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    function setCaracteristicas($caracteristicas)
    {
        if (isset($caracteristicas['caracteristicas'])) {
            foreach ($caracteristicas['caracteristicas'] as $key => $value) {

                // na linha abaixo eu retiro o tracinho, pois no banco de dados MYSQL que é onde eu vou buscar nao tem tracinho, mas na URL deve ter
                // por isso eu faço esse tratamento
                $aux = str_replace('-', '', $value);
                $this->paramAPI[$aux] = true;
                $this->caracteristicas[$aux] = true;
            }
        }
    }

    function setNumerovaranda($numerovaranda)
    {
        $this->numerovaranda = $numerovaranda;
    }

    function setNumeroelevador($numeroelevador)
    {
        $this->numeroelevador = $numeroelevador;
    }

    function setValorde($valorde)
    {
        if ($valorde == '') {
            $valorde = 0;
        }


        $valor_formatado = str_replace(".", "", $valorde);
        $valor_formatado = str_replace(",", ".", $valor_formatado);

        $this->valorde = floatval($valor_formatado);
    }

    function setValorate($valorate)
    {

        if ($valorate == '') {
            $valorate = 0;
        }

        $valor_formatado = str_replace(".", "", $valorate);
        $valor_formatado = str_replace(",", ".", $valor_formatado);

        $this->valorate = floatval($valor_formatado);
    }

    function setAreade($areade)
    {

        $this->areade = $areade;
    }

    function setAreaate($areaate)
    {


        $this->areaate = $areaate;
    }

    function setAreaexternade($areaexternade)
    {
        $this->areaexternade = $areaexternade;
    }

    function setAreaexternaate($areaexternaate)
    {
        $this->areaexternaate = $areaexternaate;
    }

    function setExtras($param)
    {
        $this->extras = $param;
    }

    function setAcademia($academia)
    {
        $this->academia = $academia;
    }

    function setAceitafinanciamento($aceitafinanciamento)
    {
        $this->aceitafinanciamento = $aceitafinanciamento;
    }

    function setAceitapermuta($aceitapermuta)
    {
        $this->aceitapermuta = $aceitapermuta;
    }

    function setAlarme($alarme)
    {
        $this->alarme = $alarme;
    }

    function setArealazer($arealazer)
    {
        $this->arealazer = $arealazer;
    }

    function setAreaprivativa($areaprivativa)
    {
        $this->areaprivativa = $areaprivativa;
    }

    function setAreaservico($areaservico)
    {
        $this->areaservico = $areaservico;
    }

    function setBoxbanheiro($boxbanheiro)
    {
        $this->boxbanheiro = $boxbanheiro;
    }

    function setBoxDespejo($boxDespejo)
    {
        $this->boxDespejo = $boxDespejo;
    }

    function setChurrasqueira($churrasqueira)
    {
        $this->churrasqueira = $churrasqueira;
    }

    function setCircuitotv($circuitotv)
    {
        $this->circuitotv = $circuitotv;
    }

    function setCloset($closet)
    {
        $this->closet = $closet;
    }

    function setDce($dce)
    {
        $this->dce = $dce;
    }

    function setExclusivo($exclusivo)
    {
        $this->exclusivo = $exclusivo;
    }

    function setInterfone($interfone)
    {
        $this->interfone = $interfone;
    }

    function setJardim($jardim)
    {
        $this->jardim = $jardim;
    }

    function setLavabo($lavabo)
    {
        $this->lavabo = $lavabo;
    }

    function setMobiliado($mobiliado)
    {
        $this->mobiliado = $mobiliado;
    }

    function setNaplanta($naplanta)
    {
        $this->naplanta = $naplanta;
    }

    function setPlayground($playground)
    {
        $this->playground = $playground;
    }

    function setPortaoeletronico($portaoeletronico)
    {
        $this->portaoeletronico = $portaoeletronico;
    }

    function setPortaria24h($portaria24h)
    {
        $this->portaria24h = $portaria24h;
    }

    function setQuadraesportiva($quadraesportiva)
    {
        $this->quadraesportiva = $quadraesportiva;
    }

    function setQuadratenis($quadratenis)
    {
        $this->quadratenis = $quadratenis;
    }

    function setSalaojogos($salaojogos)
    {
        $this->salaojogos = $salaojogos;
    }

    function setSauna($sauna)
    {
        $this->sauna = $sauna;
    }

    function setVaranda($varanda)
    {
        $this->varanda = $varanda;
    }

    function setWifi($wifi)
    {
        $this->wifi = $wifi;
    }

    function setOcupado($ocupado)
    {
        $this->ocupado = $ocupado;
    }

    function setAlugado($alugado)
    {
        $this->alugado = $alugado;
    }

    function setQuartoqtdeexata($quartoqtdeexata)
    {
        $this->quartoqtdeexata = $quartoqtdeexata;
    }

    function setVagaqtdexata($vagaqtdexata)
    {
        $this->vagaqtdexata = $vagaqtdexata;
    }

    function setDatacadastroinicio($datacadastroinicio)
    {
        $this->datacadastroinicio = $datacadastroinicio;
    }

    function setDatacadastrofim($datacadastrofim)
    {
        $this->datacadastrofim = $datacadastrofim;
    }

    function setDataultimaalteracaoinicio($dataultimaalteracaoinicio)
    {
        $this->dataultimaalteracaoinicio = $dataultimaalteracaoinicio;
    }

    function setDataultimaalteracaofim($dataultimaalteracaofim)
    {
        $this->dataultimaalteracaofim = $dataultimaalteracaofim;
    }

    function setDestaque($destaque)
    {
        $this->destaque = $destaque;
    }

    function setOpcaoimovel($opcaoimovel)
    {
        $this->opcaoimovel = $opcaoimovel;
    }

    function setRetornomapa($retornomapa)
    {
        $this->retornomapa = $retornomapa;
    }

    function setRetornomapaapp($retornomapaapp)
    {
        $this->retornomapaapp = $retornomapaapp;
    }

    function setNumeropagina($numeropagina)
    {
        $this->numeropagina = $numeropagina;
    }

    function setNumeroregistros($numeroregistros)
    {
        $this->numeroregistros = $numeroregistros;
    }

    function setOrdenacao($ordenacao)
    {
        $this->ordenacao = $ordenacao;
    }

    function setExibircaptadores($exibircaptadores)
    {
        $this->exibircaptadores = $exibircaptadores;
    }

    function getFinalidade()
    {
        return $this->finalidade;
    }

    function getCodigounidade()
    {
        return $this->codigounidade;
    }

    function getPrivatecodigocondominio()
    {
        return $this->codigocondominio;
    }

    function getCodigoproprietario()
    {
        return $this->codigoproprietario;
    }

    function getCodigocaptador()
    {
        return $this->codigocaptador;
    }

    function getCodigosimoveis()
    {
        return $this->codigosimoveis;
    }

    function getCodigoTipo()
    {
        return $this->codigoTipo;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getCodigocidade()
    {
        return $this->codigocidade;
    }

    function getCodigoregiao()
    {
        return $this->codigoregiao;
    }

    function getCodigosbairros()
    {
        return $this->codigosbairros;
    }

    function getEndereco()
    {
        return $this->endereco;
    }

    function getEdificio()
    {
        return $this->edificio;
    }

    function getNumeroquartos()
    {
        return $this->numeroquartos;
    }

    function getNumerovagas()
    {
        return $this->numerovagas;
    }

    function getNumerobanhos()
    {
        return $this->numerobanhos;
    }

    function getNumerosuite()
    {
        return $this->numerosuite;
    }

    function getNumerovaranda()
    {
        return $this->numerovaranda;
    }

    function getNumeroelevador()
    {
        return $this->numeroelevador;
    }

    function getValorde()
    {
        return $this->valorde;
    }

    function getValorate()
    {
        return $this->valorate;
    }

    function getAreade()
    {
        return $this->areade;
    }

    function getAreaate()
    {
        return $this->areaate;
    }

    function getAreaexternade()
    {
        return $this->areaexternade;
    }

    function getAreaexternaate()
    {
        return $this->areaexternaate;
    }

    function getExtras()
    {
        return $this->extras;
    }

    function getAcademia()
    {
        return $this->academia;
    }

    function getAceitafinanciamento()
    {
        return $this->aceitafinanciamento;
    }

    function getAceitapermuta()
    {
        return $this->aceitapermuta;
    }

    function getAlarme()
    {
        return $this->alarme;
    }

    function getArealazer()
    {
        return $this->arealazer;
    }

    function getAreaprivativa()
    {
        return $this->areaprivativa;
    }

    function getAreaservico()
    {
        return $this->areaservico;
    }

    function getBoxbanheiro()
    {
        return $this->boxbanheiro;
    }

    function getBoxDespejo()
    {
        return $this->boxDespejo;
    }

    function getChurrasqueira()
    {
        return $this->churrasqueira;
    }

    function getCircuitotv()
    {
        return $this->circuitotv;
    }

    function getCloset()
    {
        return $this->closet;
    }

    function getDce()
    {
        return $this->dce;
    }

    function getExclusivo()
    {
        return $this->exclusivo;
    }

    function getInterfone()
    {
        return $this->interfone;
    }

    function getJardim()
    {
        return $this->jardim;
    }

    function getLavabo()
    {
        return $this->lavabo;
    }

    function getMobiliado()
    {
        return $this->mobiliado;
    }

    function getNaplanta()
    {
        return $this->naplanta;
    }

    function getPlayground()
    {
        return $this->playground;
    }

    function getPortaoeletronico()
    {
        return $this->portaoeletronico;
    }

    function getPortaria24h()
    {
        return $this->portaria24h;
    }

    function getQuadraesportiva()
    {
        return $this->quadraesportiva;
    }

    function getQuadratenis()
    {
        return $this->quadratenis;
    }

    function getSalaojogos()
    {
        return $this->salaojogos;
    }

    function getSauna()
    {
        return $this->sauna;
    }

    function getVaranda()
    {
        return $this->varanda;
    }

    function getWifi()
    {
        return $this->wifi;
    }

    function getOcupado()
    {
        return $this->ocupado;
    }

    function getAlugado()
    {
        return $this->alugado;
    }

    function getQuartoqtdeexata()
    {
        return $this->quartoqtdeexata;
    }

    function getVagaqtdexata()
    {
        return $this->vagaqtdexata;
    }

    function getDatacadastroinicio()
    {
        return $this->datacadastroinicio;
    }

    function getDatacadastrofim()
    {
        return $this->datacadastrofim;
    }

    function getDataultimaalteracaoinicio()
    {
        return $this->dataultimaalteracaoinicio;
    }

    function getDataultimaalteracaofim()
    {
        return $this->dataultimaalteracaofim;
    }

    function getDestaque()
    {
        return $this->destaque;
    }

    function getOpcaoimovel()
    {
        return $this->opcaoimovel;
    }

    function getRetornomapa()
    {
        return $this->retornomapa;
    }

    function getRetornomapaapp()
    {
        return $this->retornomapaapp;
    }

    function getNumeropagina()
    {
        return $this->numeropagina;
    }

    function getNumeroregistros()
    {
        return $this->numeroregistros;
    }

    function getOrdenacao()
    {
        return $this->ordenacao;
    }

    function getExibircaptadores()
    {
        return $this->exibircaptadores;
    }

    function getCodigocondominio()
    {
        return $this->codigocondominio;
    }

    function setCodigocondominio($codigocondominio)
    {
        $this->codigocondominio = $codigocondominio;
    }



}
