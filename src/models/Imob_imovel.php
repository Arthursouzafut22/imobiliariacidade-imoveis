<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;


class Imob_imovel extends EloquentModel
{
    // some attributes here…
    protected $table = 'imob_imovel';
    private $imovel;

    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    // protected $dateFormat = 'U';
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    public function __construct()
    {
        parent::__construct();
    }

    public function caracteristicasExtras()
    {
        return $this->hasMany(Imob_imovel_caracteristica_extra::class, 'codigoimovel', 'codigo');
    }


    public function retornarImoveisDisponiveis($imovel)
    {
        $dados = [];

        $paramTipos = $imovel->getCodigoTipo();
        $paramCidade = $imovel->getCodigocidade();
        $paramBairros = $imovel->getCodigosbairros();
        $paramQuartos = $imovel->getNumeroquartos();
        $paramBanho = $imovel->getNumerobanhos();
        $paramVagas = $imovel->getNumerovagas();
        $paramSuite = $imovel->getNumerosuite();

        $ordenacao = $imovel->getOrdenacao();

        $paramValorDe = $imovel->getValorde();
        $paramValorAte = $imovel->getValorate();
        $paramAreaDe = $imovel->getAreade();
        $paramAreaAte = $imovel->getAreaate();

        $paramDestaque = $imovel->getDestaque();
        $paramOpcaoImovel = ($imovel->getOpcaoimovel() == '2' ? 1 : 0);//SE A OPÇÃO FOR DOIS, BUSCA APENAS EMPREENDIMENTOS, CASO CONSTRARIO BUSCA IMÓVEIS SIMPLES
        $paramCondominio = $imovel->getCodigocondominio();

        
        //TRATAMENTO DE CARACTERISTICAS
        $caracteristica = $imovel->getCaracteristicas();

        $aceitafinanciamento = (isset($caracteristica['aceitafinanciamento']) ? $caracteristica['aceitafinanciamento'] : false);
        $aceitapermuta = (isset($caracteristica['aceitapermuta']) ? $caracteristica['aceitapermuta'] : false);
        $areaprivativa = (isset($caracteristica['areaprivativa']) ? $caracteristica['areaprivativa'] : false);
        $areaservico = (isset($caracteristica['areaservico']) ? $caracteristica['areaservico'] : false);
        $box = (isset($caracteristica['box']) ? $caracteristica['box'] : false); //boxbanheiro
        $closet = (isset($caracteristica['closet']) ? $caracteristica['closet'] : false);
        $dce = (isset($caracteristica['dce']) ? $caracteristica['dce'] : false);
        $lavabo = (isset($caracteristica['lavabo']) ? $caracteristica['lavabo'] : false);
        $mobiliado = (isset($caracteristica['mobiliado']) ? $caracteristica['mobiliado'] : false);
        $varandagourmet = (isset($caracteristica['varandagourmet']) ? $caracteristica['varandagourmet'] : false);
        $alarme = (isset($caracteristica['alarme']) ? $caracteristica['alarme'] : false);
        $boxdespejo = (isset($caracteristica['boxdespejo']) ? $caracteristica['boxdespejo'] : false);
        $circuitotv = (isset($caracteristica['circuitotv']) ? $caracteristica['circuitotv'] : false);
        $interfone = (isset($caracteristica['interfone']) ? $caracteristica['interfone'] : false);
        $jardim = (isset($caracteristica['jardim']) ? $caracteristica['jardim'] : false);
        $portaoeletronico = (isset($caracteristica['portaoeletronico']) ? $caracteristica['portaoeletronico'] : false);
        $portaria24h = (isset($caracteristica['portaria24horas']) ? $caracteristica['portaria24horas'] : false);
        $exclusivo = (isset($caracteristica['exclusivo']) ? $caracteristica['exclusivo'] : false);
        $naplanta = (isset($caracteristica['naplanta']) ? $caracteristica['naplanta'] : false);
        $alugado = (isset($caracteristica['alugado']) ? $caracteristica['alugado'] : false);
        $academia = (isset($caracteristica['academia']) ? $caracteristica['academia'] : false);
        $churrasqueira = (isset($caracteristica['churrasqueira']) ? $caracteristica['churrasqueira'] : false);
        $piscina = (isset($caracteristica['piscina']) ? $caracteristica['piscina'] : false);
        $playground = (isset($caracteristica['playground']) ? $caracteristica['playground'] : false);
        $quadraesportiva = (isset($caracteristica['quadraesportiva']) ? $caracteristica['quadraesportiva'] : false);
        $quadratenis = (isset($caracteristica['quadratenis']) ? $caracteristica['quadratenis'] : false);
        $salaofestas = (isset($caracteristica['salaofestas']) ? $caracteristica['salaofestas'] : false);
        $salaojogos = (isset($caracteristica['salaojogos']) ? $caracteristica['salaojogos'] : false);
        $sauna = (isset($caracteristica['sauna']) ? $caracteristica['sauna'] : false);
        $hidromassagem = (isset($caracteristica['hidromassagem']) ? $caracteristica['hidromassagem'] : false);
        $wifi = (isset($caracteristica['wifi']) ? $caracteristica['wifi'] : false);
        $homecinema = (isset($caracteristica['homecinema']) ? $caracteristica['homecinema'] : false);

        $caracteristicas_extras = $imovel->getExtras();

        //PAGINAÇÃO A BUSCA
        $paginaAtual = $imovel->getNumeropagina();
        $registrosPorPagina = $imovel->getNumeroregistros();
        $offset = ($paginaAtual - 1) * $registrosPorPagina;

        $dados['lista'] = $this->select([
            'imob_tipoimovel.nome as tipo',
            'imob_bairro.nome as bairro',
            'imob_bairro.codigo as codigobairro',
            'imob_cidade.nome as cidade',
            'imob_imovel.codigofinalidade',
            'imob_imovel.estado',
            'imob_imovel.numeroquartos',
            'imob_imovel.numerovagas',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerosuites',
            'imob_imovel.datahoracadastro',
            'imob_imovel.codigo',
            'imob_imovel.titulo',
            'imob_imovel.fotos',
            'imob_imovel.fotos360',
            'imob_imovel.captadores',
            'imob_imovel.codigo',
            'imob_imovel.areaprincipal as areainterna',
            'imob_imovel.areaprincipaltratado',
            'imob_imovel.valor',
            'imob_imovel.valoranterior',
            'imob_imovel.valortratado',
            'imob_imovel.codigodestaque',
            'imob_imovel.codigomae',
            'imob_imovel.nomeempreendimento',
            'imob_imovel.empreendimento',
            'imob_imovel.empreendimentofilho',
            'imob_imovel.latitude',
            'imob_imovel.longitude',
            'imob_condominio.nome as nomecondominio',
            'imob_condominio.codigo as codigocondominio',
        ])
            ->join('imob_tipoimovel', 'imob_imovel.codigotipo', '=', 'imob_tipoimovel.codigo')
            ->join('imob_bairro', 'imob_imovel.codigobairro', '=', 'imob_bairro.codigo')
            ->join('imob_cidade', 'imob_imovel.codigocidade', '=', 'imob_cidade.codigo')
            ->leftjoin('imob_imovel_caracteristica_extra', 'imob_imovel.codigo', '=', 'imob_imovel_caracteristica_extra.codigoimovel')
            ->leftjoin('imob_condominio', 'imob_imovel.codigocondominio', '=', 'imob_condominio.codigo')
            ->where('codigofinalidade', '=', $imovel->getFinalidade())
            ->when(count($paramTipos) > 0, function ($query) use ($paramTipos) {
                $query->where(function($q) use ($paramTipos) {
                    $q->whereIn('codigotipo', $paramTipos)
                    ->orWhereIn('imob_imovel.codigotipo2', $paramTipos);
                });
            })
            ->when($paramCidade > 0, function ($query) use ($paramCidade) {
                $query->where('imob_cidade.codigo', $paramCidade);
            })
            ->when(count($paramBairros) > 0, function ($query) use ($paramBairros) {
                $query->where(function($q) use ($paramBairros) {
                    $q->whereIn('imob_bairro.codigo', $paramBairros)
                    ->orWhereIn('imob_imovel.codigobairro2', $paramBairros);
                });
            })
            ->when($paramQuartos > 0, function ($query) use ($paramQuartos) {
                $query->where('numeroquartostratado', '=', $paramQuartos);
            })
            ->when($paramBanho > 0, function ($query) use ($paramBanho) {
                $query->where('numerobanhostratado', '=', $paramBanho);
            })
            ->when($paramVagas > 0, function ($query) use ($paramVagas) {
                $query->where('numerovagastratado', '=', $paramVagas);
            })
            ->when($paramSuite > 0, function ($query) use ($paramSuite) {
                $query->where('numerosuitestratado', '=', $paramSuite);
            })
            ->when($paramValorDe > 0, function ($query) use ($paramValorDe) {
                $query->where('valortratado', '>=', $paramValorDe);
            })
            ->when($paramValorAte > 0, function ($query) use ($paramValorAte) {
                $query->where('valortratado', '<=', $paramValorAte);
            })
            ->when($paramAreaDe > 0, function ($query) use ($paramAreaDe) {
                $query->where('imob_imovel.areaprincipaltratado', '>=', $paramAreaDe);
            })
            ->when($paramAreaAte > 0, function ($query) use ($paramAreaAte) {
                $query->where('imob_imovel.areaprincipaltratado', '<=', $paramAreaAte);
            })
            // filtro de lançamentos
            ->where('imob_imovel.empreendimento' ,'=', $paramOpcaoImovel)

            //CARACTERISTICAS EXTRAS
            ->when( $aceitafinanciamento, function ($query) use ($aceitafinanciamento) {
                $query->where('imob_imovel.aceitafinanciamento', '=', $aceitafinanciamento);
            })
            ->when($aceitapermuta, function ($query) use ($aceitapermuta) {
                $query->where('imob_imovel.aceitapermuta', '=', $aceitapermuta);
            })
            ->when($areaprivativa, function ($query) use ($areaprivativa) {
                $query->where('imob_imovel.areaprivativa', '=', $areaprivativa);
            })
            ->when($areaservico, function ($query) use ($areaservico) {
                $query->where('imob_imovel.areaservico', '=', $areaservico);
            })
            ->when($box, function ($query) use ($box) {
                $query->where('imob_imovel.box', '=', $box);
            })
            ->when($closet, function ($query) use ($closet) {
                $query->where('imob_imovel.closet', '=', $closet);
            })
            ->when($dce, function ($query) use ($dce) {
                $query->where('imob_imovel.dce', '=', $dce);
            })
            ->when($lavabo, function ($query) use ($lavabo) {
                $query->where('imob_imovel.lavabo', '=', $lavabo);
            })
            ->when($mobiliado, function ($query) use ($mobiliado) {
                $query->where('imob_imovel.mobiliado', '=', $mobiliado);
            })
            ->when($varandagourmet, function ($query) use ($varandagourmet): void {
                $query->where('imob_imovel.varandagourmet', '=', $varandagourmet);
            })
            ->when($alarme, function ($query) use ($alarme): void {
                $query->where('imob_imovel.alarme', '=', $alarme);
            })
            ->when($boxdespejo, function ($query) use ($boxdespejo): void {
                $query->where('imob_imovel.boxdespejo', '=', $boxdespejo);
            })
            ->when($circuitotv, function ($query) use ($circuitotv): void {
                $query->where('imob_imovel.circuitotv', '=', $circuitotv);
            })
            ->when($interfone, function ($query) use ($interfone): void {
                $query->where('imob_imovel.interfone', '=', $interfone);
            })
            ->when($jardim, function ($query) use ($jardim): void {
                $query->where('imob_imovel.jardim', '=', $jardim);
            })
            ->when($portaoeletronico, function ($query) use ($portaoeletronico) {
                $query->where('imob_imovel.portaoeletronico', '=', $portaoeletronico);
            })
            ->when($portaria24h, function ($query) use ($portaria24h) {
                $query->where('imob_imovel.portaria24horas', '=', $portaria24h);
            })
            ->when($exclusivo, function ($query) use ($exclusivo) {
                $query->where('imob_imovel.exclusivo', '=', $exclusivo);
            })
            ->when($naplanta, function ($query) use ($naplanta) {
                $query->where('imob_imovel.naplanta', '=', $naplanta);
            })
            ->when($alugado, function ($query) use ($alugado) {
                $query->where('imob_imovel.imovelalugado', '=', $alugado);
            })
            ->when($academia, function ($query) use ($academia) {
                $query->where('imob_imovel.academia', '=', $academia);
            })
            ->when($churrasqueira, function ($query) use ($churrasqueira) {
                $query->where('imob_imovel.churrasqueira', '=', $churrasqueira);
            })
            ->when($piscina, function ($query) use ($piscina) {
                $query->where('imob_imovel.piscina', '=', $piscina);
            })
            ->when($playground, function ($query) use ($playground) {
                $query->where('imob_imovel.playground', '=', $playground);
            })
            ->when($quadraesportiva, function ($query) use ($quadraesportiva) {
                $query->where('imob_imovel.quadraesportiva', '=', $quadraesportiva);
            })
            ->when($quadratenis, function ($query) use ($quadratenis) {
                $query->where('imob_imovel.quadratenis', '=', $quadratenis);
            })
            ->when($salaofestas, function ($query) use ($salaofestas) {
                $query->where('imob_imovel.salaofestas', '=', $salaofestas);
            })
            ->when($salaojogos, function ($query) use ($salaojogos) {
                $query->where('imob_imovel.salaojogos', '=', $salaojogos);
            })
            ->when($sauna, function ($query) use ($sauna) {
                $query->where('imob_imovel.sauna', '=', $sauna);
            })
            ->when($hidromassagem, function ($query) use ($hidromassagem): void {
                $query->where('imob_imovel.hidromassagem', '=', $hidromassagem);
            })
            ->when($wifi, function ($query) use ($wifi): void {
                $query->where('imob_imovel.wifi', '=', $wifi);
            })
            ->when($homecinema, function ($query) use ($homecinema): void {
                $query->where('imob_imovel.homecinema', '=', $homecinema);
            })

            ->when($paramDestaque = 0, function ($query) use ($paramDestaque) {
                $query->where('codigodestaque', $paramDestaque);
            })
            ->when($paramCondominio != 0, function ($query) use ($paramCondominio) {
                $query->where('imob_condominio.codigo', '=', $paramCondominio);
            })
           
            
            ->when(count($caracteristicas_extras) > 0, function ($query) use ($caracteristicas_extras) {
                $query->whereHas('caracteristicasExtras', function ($q) use ($caracteristicas_extras) {
                    $q->whereIn('imob_imovel_caracteristica_extra.codigocaracteristicaextra', $caracteristicas_extras)
                        ->groupBy('codigoimovel')
                        ->havingRaw('COUNT(DISTINCT imob_imovel_caracteristica_extra.codigocaracteristicaextra) = ?', [count($caracteristicas_extras)]);
                });
            })
           
            ->when($ordenacao === 'asc' || $ordenacao === 'desc', function ($query) use ($ordenacao) {
                return $query->orderBy('valortratado', $ordenacao)->orderBy('imob_imovel.codigo', 'desc');
            })
            
            // ->orderByRaw("FIELD(imob_imovel.codigodestaque, ?, ?, ?)", [3,2,1])
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->skip($offset)
            ->take($registrosPorPagina)
            ->groupBy('imob_imovel.codigo')
            //->toSql();
            ->get()
            ->toArray();

            //$bindings = $this->getBindings();
            //var_dump($dados['lista'], $bindings);

        return $dados;
    }

    public function retornarImoveisDestaque($imovel)
    {

        $dados = [];
        $dados['lista'] = $this->select([
            'imob_tipoimovel.nome as tipo',
            'imob_bairro.nome as bairro',
            'imob_bairro.codigo as codigobairro',
            'imob_cidade.nome as cidade',
            'imob_imovel.codigofinalidade',
            'imob_imovel.estado',
            'imob_imovel.numeroquartos',
            'imob_imovel.numerovagas',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerosuites',
            'imob_imovel.datahoracadastro',
            'imob_imovel.titulo',
            'imob_imovel.fotos',
            'imob_imovel.fotos360',
            'imob_imovel.captadores',
            'imob_imovel.codigo',
            'imob_imovel.areaprincipal as areainterna',
            'imob_imovel.valor',
            'imob_imovel.valoranterior',
            'imob_imovel.codigodestaque',
            'imob_imovel.codigomae',
            'imob_imovel.nomeempreendimento',
            'imob_imovel.empreendimento',
            'imob_imovel.empreendimentofilho',
            'imob_imovel.latitude',
            'imob_imovel.longitude',
            'imob_condominio.nome as nomecondominio',
            'imob_condominio.codigo as codigocondominio',
        ])
            ->join('imob_tipoimovel', 'imob_imovel.codigotipo', '=', 'imob_tipoimovel.codigo')
            ->join('imob_bairro', 'imob_imovel.codigobairro', '=', 'imob_bairro.codigo')
            ->join('imob_cidade', 'imob_imovel.codigocidade', '=', 'imob_cidade.codigo')
            ->leftjoin('imob_condominio', 'imob_imovel.codigocondominio', '=', 'imob_condominio.codigo')
            ->where('codigofinalidade', '=', $imovel->getFinalidade())
            ->where('codigodestaque', '=', $imovel->getDestaque())
            ->where('imob_imovel.empreendimento',0)
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->skip(($imovel->getNumeropagina() - 1) * $imovel->getNumeroregistros())
            ->take($imovel->getNumeroregistros())
            ->orderBy('imob_imovel.datahoraultimaalteracao', 'desc')
            ->distinct()
            ->get()
            ->toArray();
        return $dados;
    }

    public function getImovelPorCodigo($imovel)
    {

        $dados = [];
        $paramCodigos = $imovel->getCodigosimoveis();

        $dados['lista'] = $this->select([
            'imob_imovel.*',
            'imob_tipoimovel.nome as tipo',
            'imob_tipoimovel.codigo as codigotipo',
            'imob_bairro.nome as bairro',
            'imob_cidade.nome as cidade',
            'imob_cidade.codigo as codigocidade',
            'imob_imovel.urlfotoprincipalp',
            'imob_imovel.numeroquartos',
            'imob_imovel.numerovagas',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerosuites',
            'imob_imovel.datahoracadastro',
            'imob_imovel.titulo',
            'imob_imovel.fotos',
            'imob_imovel.fotos360',
            'imob_imovel.captadores',
            'imob_imovel.codigo',
            'imob_imovel.areaprincipal as areainterna',
            'imob_imovel.valor',
            'imob_imovel.valoranterior',
            'imob_imovel.codigodestaque',
            'imob_imovel.codigomae',
            'imob_imovel.empreendimento',
            'imob_imovel.empreendimentofilho',
            'imob_imovel.latitude',
            'imob_imovel.longitude',
            'imob_imovel.urlvideo',
            'imob_imovel.valoranterior',
            'imob_imovel.urlpublica',
            'imob_imovel.codigofinalidade',
            'imob_imovel.endereco',
            'imob_imovel.estado',
            'imob_imovel.areaprincipal',
            'imob_imovel.arealote',
            'imob_imovel.areaprincipal',
            'imob_imovel.numeroquartos',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerosuites',
            'imob_imovel.descricao',
            'imob_condominio.nome as nomecondominio',
            'imob_condominio.codigo as codigocondominio',
            'imob_imovel.valorcondominio',
            'imob_imovel.valoriptu',
        ])
            ->join('imob_tipoimovel', 'imob_imovel.codigotipo', '=', 'imob_tipoimovel.codigo')
            ->join('imob_bairro', 'imob_imovel.codigobairro', '=', 'imob_bairro.codigo')
            ->join('imob_cidade', 'imob_imovel.codigocidade', '=', 'imob_cidade.codigo')
            ->leftjoin('imob_condominio', 'imob_imovel.codigocondominio', '=', 'imob_condominio.codigo')
            ->whereIn('imob_imovel.codigo', $paramCodigos)
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->get()
            ->toArray();

        return $dados;
    }

    public function retornarDetalhesImoveiDisponivel($imovel)
    {
        $dados = [];

        $dados = $this::select([
            'imob_imovel.*',
            'imob_tipoimovel.nome as tipo',
            'imob_bairro.nome as bairro',
            'imob_cidade.nome as cidade',
            'imob_imovel.numeroquartos',
            'imob_imovel.numerovagas',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerosuites',
            'imob_imovel.datahoracadastro',
            'imob_imovel.titulo',
            'imob_imovel.fotos',
            'imob_imovel.fotos360',
            'imob_imovel.captadores',
            'imob_imovel.codigo',
            'imob_imovel.areaprincipal as areainterna',
            'imob_imovel.valor',
            'imob_imovel.valoranterior',
            'imob_imovel.codigodestaque',
            'imob_imovel.codigomae',
            'imob_imovel.empreendimento',
            'imob_imovel.empreendimentofilho',
            'imob_condominio.nome as nomecondominio'
        ])
            ->join('imob_tipoimovel', 'imob_imovel.codigotipo', '=', 'imob_tipoimovel.codigo')
            ->join('imob_bairro', 'imob_imovel.codigobairro', '=', 'imob_bairro.codigo')
            ->join('imob_cidade', 'imob_imovel.codigocidade', '=', 'imob_cidade.codigo')
            ->leftjoin('imob_condominio', 'imob_imovel.codigocondominio', '=', 'imob_condominio.codigo')
            ->where('imob_imovel.codigo', $imovel->getCodigosimoveis())->first()->toArray();

        return $dados;
    }
    


    public function retornarImoveisEmpreendimentosFilhosDisponiveis($imovel)
    {

        $dados = [];
        $paramCodigos = $imovel->getCodigosimoveis();

        $dados['lista'] = $this->select([
            'imob_imovel.*',
            'imob_tipoimovel.nome as tipo',
            'imob_tipoimovel.codigo as codigotipo',
            'imob_bairro.nome as bairro',
            'imob_cidade.nome as cidade',
            'imob_cidade.codigo as codigocidade',
            'imob_imovel.urlfotoprincipalp',
            'imob_imovel.numeroquartos',
            'imob_imovel.numerovagas',
            'imob_imovel.numerobanhos',
            'imob_imovel.datahoracadastro',
            'imob_imovel.titulo',
            'imob_imovel.fotos',
            'imob_imovel.fotos360',
            'imob_imovel.captadores',
            'imob_imovel.codigo',
            'imob_imovel.areaprincipal as areainterna',
            'imob_imovel.valor',
            'imob_imovel.valoranterior',
            'imob_imovel.codigodestaque',
            'imob_imovel.codigomae',
            'imob_imovel.empreendimento',
            'imob_imovel.empreendimentofilho',
            'imob_imovel.latitude',
            'imob_imovel.longitude',
            'imob_imovel.urlvideo',
            'imob_imovel.valoranterior',
            'imob_imovel.urlpublica',
            'imob_imovel.codigofinalidade',
            'imob_imovel.endereco',
            'imob_imovel.estado',
            'imob_imovel.areaprincipal',
            'imob_imovel.arealote',
            'imob_imovel.areaprincipal',
            'imob_imovel.numeroquartos',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerobanhos',
            'imob_imovel.numerosuites',
            'imob_imovel.descricao',
            'imob_condominio.nome as nomecondominio',
            'imob_condominio.codigo as codigocondominio',
            'imob_imovel.valorcondominio',
            'imob_imovel.valoriptu',
        ])
            ->join('imob_tipoimovel', 'imob_imovel.codigotipo', '=', 'imob_tipoimovel.codigo')
            ->join('imob_bairro', 'imob_imovel.codigobairro', '=', 'imob_bairro.codigo')
            ->join('imob_cidade', 'imob_imovel.codigocidade', '=', 'imob_cidade.codigo')
            ->leftjoin('imob_condominio', 'imob_imovel.codigocondominio', '=', 'imob_condominio.codigo')
            ->whereIn('imob_imovel.codigomae', $paramCodigos)
            ->orderBy('imob_imovel.valor', 'asc')
            ->selectRaw('COUNT(*) OVER () as total_registros')
            ->get()
            ->toArray();

        return $dados;
    }




}