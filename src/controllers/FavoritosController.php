<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\Helper;
use \src\handlers\Imovel;
use src\models\CmsConfiguracao;
use src\models\CmsPagina;
use src\models\CmsPaginaConteudoImagem;
use src\models\CmsScriptsExternos;
use src\models\Imob_imovel;
use \src\models\ImovelDAO;
use \src\handlers\UrlEncode;

use src\models\Anunciar;
use src\models\Configuracoe;
use src\models\Favorito;
use \src\models\Script;


class FavoritosController extends Controller
{

    public function __construct()
    {
        $conf = CmsConfiguracao::first()->toArray();
        Helper::siteEmManutencao($conf);
    }


    public function index()
    {
        $dados = [];
        $dados['configuracoes'] = CmsConfiguracao::first()->toArray();
        $dados['configuracoes']['redes_social'] = CmsPaginaConteudoImagem::select("*")
            ->where('cod_pagina_conteudo', 45)
            ->orderBy('ordem_imagem_conteudo', 'asc')
            ->get()
            ->toArray();

        $dados['script'] = CmsScriptsExternos::first()->toArray();
        $dados['cms_pagina'] = CmsPagina::select("*")
            ->where('cms_pagina.cod_pagina', 11)
            ->first()
            ->toArray();


        $dados['cms_pagina']['favicon'] = $dados['configuracoes']['favicon'];

        $this->render('favoritos', $dados);
    }

    public function addFavoritos()
    {

        $_SESSION['favoritos'][] = $_POST['codigo'];

        header('Content-Type: application/json');
        echo json_encode($_SESSION['favoritos']);
    }

    public function removerFavoritos()
    {


        $codigo = $_POST['codigo'];
        $codigo = array($codigo);


        $_SESSION['favoritos'] = array_diff($_SESSION['favoritos'], $codigo);

        header('Content-Type: application/json');
        echo json_encode($_SESSION['favoritos']);
    }

    function getFavoritos()
    {

        $codigos = '';

        $novo = array();
        $cont = 0;

        if (isset($_SESSION['favoritos']) && !empty($_SESSION['favoritos'])) {

            foreach ($_SESSION['favoritos'] as $key => $value) {

                $novo[] = $value;
                $cont++;

            }

            for ($i = 0; $i < count($novo); $i++) {
                $codigos .= $novo[$i] . ',';
            }
        } else {
            $_SESSION['favoritos'] = array();
        }

        $_SESSION['favoritos'] = $novo;
        $_SESSION['cont-favoritos'] = $cont;


        $imo = new Imovel();
        $imo->setFinalidade('');
        $imo->setNumeroregistros(20);
        $imo->setCodigosimoveis($codigos);


        $imoDao = new Imob_imovel();
        $imovel = $imoDao->getImovelPorCodigo($imo);



        $url = new UrlEncode();

        foreach ($imovel['lista'] as $key => $i) {
            $imovel['lista'][$key]['url_amigavel'] = $url->amigavelURL($i['titulo']);
            $imovel['lista'][$key]['fotos'] = json_decode($i['fotos']);
            $imovel['lista'][$key]['fotos360'] = json_decode($i['fotos360']);

        }

        if (isset($_SESSION['favoritos']) && !empty($_SESSION['favoritos'])) {

            $imovel['favoritos'] = $_SESSION['favoritos'];

        } else {
            $imovel['favoritos'] = 0;

        }


        header('Content-Type: application/json');
        echo json_encode($imovel);
    }

}
