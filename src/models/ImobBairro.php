<?php

namespace src\models;

// use \core\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class ImobBairro extends EloquentModel
{
    // some attributes here…
    protected $table = 'imob_bairro';
    public $timestamps = false;

    public function __construct()
    {
        parent::__construct();
    }


    public function retornarBairrosDisponiveis($params)
    {
        $dados = [];

        $dados['lista'] = $this->select([
            'imob_cidade.nome as nomecidade',
            'imob_cidade.nome as cidade',
            'imob_bairro.nome as nomebairro',
            'imob_bairro.codigo as codigobairro',
            'imob_cidade.estado',
        ])
            ->join('imob_cidade', 'imob_bairro.codigocidade', '=', 'imob_cidade.codigo')
            ->when(isset($params['codigocidade']), function ($query) use ($params) {
                $query->where('imob_cidade.codigo', '=', $params['codigocidade']);
            })
            ->orderBy('nomebairro', 'asc')
            ->get();

        return $dados;
    }
    public function retornarBuscaBairros($finalidade, $codigoBairro, $codigoTiposArray)
    {
        $dados = [];

        $finalidade = ($finalidade == 1 ? 'aluguel' : 'venda');

        // Pegando o primeiro bairro
        $dados['bairro'] = ImobBairro::select([
            'imob_bairro.nome as nomebairro',
            'imob_bairro.codigo as codigobairro',
            'imob_bairro.nomeurlamigavel as bairro_urlamigavel', // Pegando o nome amigável corretamente
            'imob_cidade.nome as nomecidade',
            'imob_cidade.nomeurlamigavel as cidade_urlamigavel'  // Campo nomeurlamigavel
        ])
            ->join('imob_cidade', 'imob_bairro.codigocidade', '=', 'imob_cidade.codigo')
            ->where('imob_bairro.codigo', '=', $codigoBairro)
            ->first(); // Aqui pega apenas o primeiro resultado

        // Pegando os tipos de imóvel
        $dados['tipos'] = Imob_tipoimovel::select([
            'imob_tipoimovel.nome as nometipo',
            'imob_tipoimovel.codigo as codigotipomovel',
            'imob_tipoimovel.nomeurlamigavel' // Campo nomeurlamigavel
        ])
            ->whereIn('imob_tipoimovel.codigo', $codigoTiposArray)
            ->orderBy('nometipo', 'asc')
            ->get();

        $filtros = [];
        // return $dados['bairro'];

        // Verifica se o bairro foi encontrado
        if ($dados['bairro'] != null) {
            $bairroKey = $dados['bairro']->nomebairro;

            $filtros = [
                'bairro' => [
                    'nome' => $dados['bairro']->nomebairro,
                    'url_amigavel' => $dados['bairro']->bairro_urlamigavel,
                ],
                'filtros' => []
            ];

            foreach ($dados['tipos'] as $tipo) {
                $filtros['filtros'][] = [
                    'url' => BASE_URL . $finalidade . '/' . $tipo->nomeurlamigavel . '/' .
                        $dados['bairro']->cidade_urlamigavel . '/' .
                        $dados['bairro']->bairro_urlamigavel,
                    'titulo' => $tipo->nometipo . ' no bairro ' . $dados['bairro']->nomebairro
                ];
            }
        }


        return $filtros;
    }
}
