<?php

namespace src\models;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Imob_condominio extends EloquentModel
{

    protected $table = 'imob_condominio';

    public function __construct()
    {
        parent::__construct();
    }

    public function retornarCondominiosDisponiveis()
    {
        $dados = [];

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
        ->where('cod_pagina_conteudo', 45)
        ->orderBy('ordem_imagem_conteudo', 'asc')
        ->get()
        ->toArray();
        
        $dados['cms_pagina'] = CmsPagina::select("*")
        ->where('cms_pagina.cod_pagina', 14) // 14 = listagem de condominios
        ->join('cms_pagina_conteudo', 'cms_pagina.cod_pagina', 'cms_pagina_conteudo.cod_pagina')
        ->first()
        ->toArray();

        $dados['lista'] = $this->select()->orderBy('nome', 'asc')->get()->toArray();
        return $dados;
    }

    public function retornarCondominiosDisponiveisPaginacao($params)
    {       
        //PAGINAÇÃO A BUSCA
        $paginaAtual = $params['numeropagina'];
        $registrosPorPagina = $params['numeroregistros'];
        $offset = ($paginaAtual - 1) * $registrosPorPagina;

        $paramCidade = $params['codigocidade'] ;
        $paramBairros = $params['codigobairro'] ;


        $dados['lista'] = $this->select()
        ->when($paramCidade !=  0, function ($query) use ($paramCidade) {
                $query->where('codigocidade', '=',$paramCidade);
            })
            ->when($paramBairros != 0, function ($query) use ($paramBairros) {
                $query->where('codigobairro', '=',  $paramBairros);
            })
        ->orderBy('nome', 'asc')
        ->selectRaw(expression: 'COUNT(*) OVER () as total_registros')
        ->skip($offset)
        ->take($registrosPorPagina)
        ->get()
        ->toArray();
        return $dados;
    }


    public function retornarDetalheCondominiosDisponiveis($codigo)
    {
        
        $dados =  $this->select(['*',
            'imob_condominio.nome',
            'imob_condominio.urlvideo',

            'imob_condominio.urlfotoprincipal',
            'imob_condominio.areainterna',
            'imob_condominio.numerosuites',
            'imob_condominio.numerovagas',
            'imob_condominio.numerobanhos',
            'imob_condominio.numeroquartos',
            'imob_condominio.aguaindividual',
            'imob_condominio.alarme',
            'imob_condominio.aquecedoreletrico',
            'imob_condominio.aquecedorgas',
            'imob_condominio.aquecedoreletrico',
            'imob_condominio.aquecedorsolar',
            'imob_condominio.boxdespejo',
            'imob_condominio.cercaeletrica',
            'imob_condominio.circuitotv',

            'imob_condominio.gascanalizado',
            'imob_condominio.interfone',
            'imob_condominio.jardim',
            'imob_condominio.lavanderia',
            'imob_condominio.portaoeletronico',
            'imob_condominio.portaria24horas',
            'imob_condominio.seguranca24horas',
            'imob_condominio.gramado',

            'imob_condominio.academia',
            'imob_condominio.churrasqueira',
            'imob_condominio.homecinema',
            'imob_condominio.piscina',
            'imob_condominio.playground',
            'imob_condominio.quadraesportiva',
            'imob_condominio.quadratenis',
            'imob_condominio.quadrasquash',

            'imob_condominio.valorvenda',
            'imob_condominio.primeiroquartilvenda',
            'imob_condominio.terceiroquartilvenda',
            'imob_condominio.valoraluguel',
            'imob_condominio.primeiroquartilaluguel',
            'imob_condominio.medianaquartilaluguel',
            'imob_condominio.terceiroquartilaluguel',


            'imob_condominio.endereco',
            'imob_condominio.descricao',
            'imob_condominio.unidadesaluguel',
            'imob_condominio.unidadesvenda',
            'imob_condominio.nome as nomecondominio',
            'imob_condominio.numerovagavisitante',
            'imob_condominio.numeroelevador',
            'imob_condominio.numerotorres',
            'imob_condominio.numeroandares',
            'imob_bairro.nome as bairro',
            // 'imob_tipoimovel.nome as tipo',
            'imob_cidade.nome as cidade',
            'imob_condominio.fotos',
            'imob_condominio.fotos360',
        ])
        ->leftjoin('imob_imovel', 'imob_imovel.codigocondominio', '=', 'imob_condominio.codigo')
        // ->leftjoin('imob_tipoimovel', 'imob_imovel.codigotipo', '=', 'imob_tipoimovel.codigo')
        ->leftjoin('imob_bairro', 'imob_condominio.codigobairro', '=', 'imob_bairro.codigo')
        ->leftjoin('imob_cidade', 'imob_condominio.codigocidade', '=', 'imob_cidade.codigo')
        ->where('imob_condominio.codigo', '=', $codigo)->orderBy('nomecondominio', 'asc')->first();
        
        if($dados){
            return $dados->toArray();
        }
    }
}
