<?php

namespace src\handlers;

use src\models\Condominio;
use src\models\Consulta;
use src\models\Consultas_auxiliare;

class ToggleQueriesData
{


    public static function deleteDados()
    {
        Consulta::delete()->where('id', '>=',0)->execute();
        Consultas_auxiliare::delete()->where('id', '>=',0)->execute();
    }

    public static function retornarImoveisDiponiveis($imo_model, $params)
    {

        $requestImoveis = [];
        $deletarDados = false;

        $con_md5 = md5($_SERVER["REQUEST_URI"] . str_replace(' ','',json_encode($params)));
        $consultExists = Consulta::select()->where('chamada_md5', '=', $con_md5)->get();

        if (isset($consultExists) && !empty($consultExists)) {
            $deletarDados = Helper::verificarData(Helper::organizarData($consultExists[0]['data']));
        }
        
        if ($deletarDados) {
            ToggleQueriesData::deleteDados();
            $consultExists = [];
        }
      
        if (count($consultExists) == 0) {

            $requestImoveis = $imo_model->retornarImoveisDisponiveis();
            Consulta::insert()
                ->values([
                    'chamada' => $_SERVER["REQUEST_URI"] . json_encode($params),
                    'chamada_md5' => $con_md5,
                    'json' => json_encode($requestImoveis),
                ])->execute();
        } else {

            return json_decode(Consulta::select('json')->where('chamada_md5', '=', $con_md5)->execute()[0]['json']);
        }

        return $requestImoveis;
    }


    public static function retornarTiposDisponiveis($tipos, $params)
    {

        $requestImoveis = [];

        $con_md5 = md5($_SERVER["REQUEST_URI"] . json_encode($params));
        $consultExists = Consultas_auxiliare::select()->where('chamada_md5', '=', $con_md5)->execute();

        if (count($consultExists) == 0) {

            $requestImoveis = $tipos->retornarTiposImoveisDisponiveis();
            Consultas_auxiliare::insert()
                ->values([
                    'chamada' => $_SERVER["REQUEST_URI"] . json_encode($params),
                    'chamada_md5' => $con_md5,
                    'json' => json_encode($requestImoveis),
                ])->execute();
        } else {

            return json_decode(Consultas_auxiliare::select('json')->where('chamada_md5', '=', $con_md5)->execute()[0]['json']);
        }

        return $requestImoveis;
    }


    public static function retornarCondominiosDisponiveis($condominio, $params)
    {

        $requestImoveis = [];

        $con_md5 = md5($_SERVER["REQUEST_URI"] . json_encode($params));
        $consultExists = Consultas_auxiliare::select()->where('chamada_md5', '=', $con_md5)->execute();

        if (count($consultExists) == 0) {

            $requestImoveis = $condominio->retornarCondominiosDisponiveis();

            Consultas_auxiliare::insert()
                ->values([
                    'chamada' => $_SERVER["REQUEST_URI"] . json_encode($params),
                    'chamada_md5' => $con_md5,
                    'json' => json_encode($requestImoveis),
                ])->execute();
        } else {

            return json_decode(Consultas_auxiliare::select('json')->where('chamada_md5', '=', $con_md5)->execute()[0]['json']);
        }

        return $requestImoveis;
    }

    public static function retornarDestaquesDisponiveis($imovel, $params)
    {

        $requestImoveis = [];

        $con_md5 = md5($_SERVER["REQUEST_URI"] . json_encode($params));
        $consultExists = Consultas_auxiliare::select()->where('chamada_md5', '=', $con_md5)->execute();

        if (count($consultExists) == 0) {

            $requestImoveis = $imovel->retornarImoveisDisponiveis();
            Consultas_auxiliare::insert()
                ->values([
                    'chamada' => $_SERVER["REQUEST_URI"] . json_encode($params),
                    'chamada_md5' => $con_md5,
                    'json' => json_encode($requestImoveis),
                ])->execute();
        } else {

            return json_decode(Consultas_auxiliare::select('json')->where('chamada_md5', '=', $con_md5)->execute()[0]['json']);
        }

        return $requestImoveis;
    }

    public static function retornarImoveisSimilaresDisponiveis($imovel, $params)
    {

        $requestImoveis = [];

        $con_md5 = md5($_SERVER["REQUEST_URI"] . str_replace(' ','',json_encode($params)));
        $consultExists = Consultas_auxiliare::select()->where('chamada_md5', '=', $con_md5)->execute();

        if (count($consultExists) == 0) {

            $requestImoveis = $imovel->retornarImoveisDisponiveis();
            Consultas_auxiliare::insert()
                ->values([
                    'chamada' => $_SERVER["REQUEST_URI"] . json_encode($params),
                    'chamada_md5' => $con_md5,
                    'json' => json_encode($requestImoveis),
                ])->execute();
        } else {

            return json_decode(Consultas_auxiliare::select('json')->where('chamada_md5', '=', $con_md5)->execute()[0]['json']);
        }

        return $requestImoveis;
    }

    public static function retornarDetalhesImoveiDisponivel($imovel, $params){

        $requestImoveis = [];

        $con_md5 = md5($_SERVER["REQUEST_URI"] . str_replace(' ','',json_encode($params)));
        $consultExists = Consultas_auxiliare::select()->where('chamada_md5', '=', $con_md5)->execute();

        if (count($consultExists) == 0) {

            $requestImoveis = $imovel->retornarDetalhesImoveiDisponivel();
            Consultas_auxiliare::insert()
                ->values([
                    'chamada' => $_SERVER["REQUEST_URI"] . json_encode($params),
                    'chamada_md5' => $con_md5,
                    'json' => json_encode($requestImoveis),
                ])->execute();
        } else {

            return json_decode(Consultas_auxiliare::select('json')->where('chamada_md5', '=', $con_md5)->execute()[0]['json']);
        }

        return $requestImoveis;


    }
}
