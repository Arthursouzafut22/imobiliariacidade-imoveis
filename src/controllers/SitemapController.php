<?php
namespace src\controllers;

use \core\Controller;
use \src\Config;
use src\handlers\UrlEncode;
use src\models\CmsPagina;
use src\models\Imob_condominio;
use src\models\Imob_imovel;


class SitemapController extends Controller
{

    public function formatData($param)
    {

        $res = explode('/', $param);
        $aux = explode(' ', $res[2]);
        $res = $aux[0] . '-' . $res[1] . '-' . $res[0];

        return $res;
    }

    public function sitemap_xml()
    {

        // PEGA DO ARQUIVO CONFIG A BASE URL
        $base = BASE_URL;

        // VALORES PADRÕES
        $pagina = 1;
        $finalidade = 0;

        $url = new UrlEncode();

        $paginas = CmsPagina::select([
            'sitemap_pagina_prioridade',
            'url_pagina'
        ])->where('sitemap_pagina','=', 1)->get()->toArray();

        $imoveis = Imob_imovel::select(['titulo','codigo'])->get()->toArray();
        foreach ($imoveis as $key => $imo) {
            $imoveis[$key]['url_pagina'] = $url->amigavelURL($imo['titulo']);
        }
        
        $condominios = Imob_condominio::select(['nome','codigo'])->get()->toArray();
        foreach ($condominios as $key => $conominio) {
            $condominios[$key]['url_pagina'] = $url->amigavelURL($conominio['nome']);
        }

        $dataHoje = date('Y-m-d');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <urlset 
                xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                xmlns:xhtml="http://www.w3.org/1999/xhtml" 
                xsi:schemaLocation=" http://www.sitemaps.org/schemas/sitemap/0.9
                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        foreach ($paginas as $pagina) {

            $xml .= '<url>
                                <loc>' . $base . $pagina['url_pagina'] . '</loc>
                                        <lastmod>' . $dataHoje . '</lastmod>
                                        <changefreq>weekly</changefreq>
                                        <priority>' . $pagina['sitemap_pagina_prioridade'] . '</priority>
                                </url>
                            ';
        }


        foreach ($imoveis as $imovel) {

            $xml .= '<url>
                                <loc>' . $base .'imovel/'. $imovel['url_pagina'] .'/'. $imovel['codigo'].'</loc>
                                        <lastmod>' . $dataHoje . '</lastmod>
                                        <changefreq>weekly</changefreq>
                                        <priority>0.8</priority>
                                </url>
                            ';
        }


        foreach ($condominios as $cond) {

            $xml .= '<url>
                                <loc>' . $base .'condominio/'. $cond['url_pagina'] .'/'. $cond['codigo'].'</loc>
                                        <lastmod>' . $dataHoje . '</lastmod>
                                        <changefreq>weekly</changefreq>
                                        <priority>0.8</priority>
                                </url>
                            ';
        }

        $xml .= '</urlset>';
        $arquivo = fopen('sitemap.xml', 'w');

        $resposta = fwrite($arquivo, data: $xml);
        fclose($arquivo);

        if ($resposta) {

            $response = ['status'=> true, 'mensagem'=> 'Sitemap atualizado com sucesso!'];
            header("Access-Control-Allow-Origin: *");
            header("Content-Type:application/json");
            echo json_encode($response);exit;

        } else {

            $response = ['status'=> false, 'mensagem'=> 'Erro ao atualizar sitemap!'];
            header("Access-Control-Allow-Origin: *");
            header("Content-Type:application/json");
            echo json_encode($response);exit;

        }

       
    }
}
