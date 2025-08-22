<?php

namespace src\handlers;
use src\models\CmsPaginaConteudoPerguntaResposta;

class Helper
{
    function __construct()
    {
    }

    function verificarMobile()
    {

        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $iPod = stripos($useragent, "iPod");
        $iPad = stripos($useragent, "iPad");
        $iPhone = stripos($useragent, "iPhone");
        $Android = stripos($useragent, "Android");
        $iOS = stripos($useragent, "iOS");

        $DEVICE = ($iPod || $iPad || $iPhone || $Android || $iOS);

        if (!$DEVICE) { //se for desktop retorna false
            return 0;
        } else { //se for mobile retorna true
            return 1;
        }
    }

    public static function verificarData($data)
    {

        //SE A DATA DO REGISTRO É MAIOR QUE A DATA ATUAL
        if (strtotime(date('Y-m-d')) > strtotime($data)) {
            return true;
        }

        return false;
    }

    public static function organizarData($data)
    {

        $auxiliar = explode(' ', $data)[0];
        // $auxiliar = explode('-',$auxiliar);

        return $auxiliar;
    }

    public static function gerarTabelaParaEnvioDeEmail($data, $assunto, $empresaNome)
    {

        $count = 0;

        $body[] = '<table width="800" border="0" cellspacing="0" cellpadding="7" style="border: 1px solid #1e1e1e ;">
            <tr>
                <td height="30" bgcolor="#1e1e1e">
                <span style="background-color:#1e1e1e; color:#FFF; font-size:16px;">' . $assunto . ' - Enviado pelo site ' . $empresaNome . ' - IP identificação: <strong>' . $_SERVER['REMOTE_ADDR'] . '</strong></span>
            </td>
        </tr>';

        foreach ($data as $field) {

            foreach ($field as $key => $value) {
                $count++;

                if ($count % 2 == 0) {
                    $body[] = '<tr>
                            <td height="30" bgcolor="#EAEAEA"><strong>' . $key . ':</strong> ' . $value . '</td>
                        </tr>';
                } else {
                    $body[] = '<tr>
                            <td height="30"><strong>' . $key . ':</strong> ' . $value . '</td>
                        </tr>';
                }
            }

        }

        $body[] = '</table>';

        $body = implode("", $body);

        return $body;

    }

    function retornarTagDetalheImovel($imovel)
    {

        if ($imovel['aceitapermuta']) {
            return '<span class="badge badge-warning">ACEITA PERMUTA</span>';
        }
        if ($imovel['tempoCadastro'] < 31) {
            return '<span class="badge badge-warning">NOVO</span>';
        } else if ($imovel['valoranterior'] != 'R$ 0,00') {
            return '<span class="badge badge-warning">PREÇO REDUZIDO</span>';
        } else if ($imovel['exclusivo'] == true) {
            return '<span class="badge badge-warning">Exclusivo</span>';
        } else if ($imovel['urlpublica'] != '' && isset($imovel['urlpublica'])) {
            return '<span class="badge badge-warning">TOUR VIRTUAL</span>';
        }
    }

    function retornarDataPorExtensoBlog($dataMysql)
    {

        // Define a localidade para português
        setlocale(LC_TIME, 'pt_BR.utf-8', 'portuguese', 'pt_BR', 'pt_BR.iso-8859-1');

        // Converte a data do formato datetime do MySQL para um timestamp
        $timestamp = strtotime($dataMysql);

        // Formata a data no padrão desejado: "11 de julho de 2023"
        $dataFormatada = date('d', $timestamp) . ' de ' . strftime('%B', $timestamp) . ' de ' . date('Y', $timestamp);

        return $dataFormatada;
    }

    function formatarData($data)
    {

        if($data == '0000-00-00 00:00:00'){
            return null;
        }

        // Verifica se a data é válida e no formato esperado (dd/mm/yyyy)
        $dataObj = \DateTime::createFromFormat('Y-m-d H:i:s', $data);

        // Retorna null se a data não for válida
        if ($dataObj === false) {
            return null;
        }

        // Define os meses em formato abreviado
        $meses = [
            '01' => 'JAN',
            '02' => 'FEV',
            '03' => 'MAR',
            '04' => 'ABR',
            '05' => 'MAI',
            '06' => 'JUN',
            '07' => 'JUL',
            '08' => 'AGO',
            '09' => 'SET',
            '10' => 'OUT',
            '11' => 'NOV',
            '12' => 'DEZ'
        ];

        // Extrai o dia, mês e ano
        $dia = $dataObj->format('d');
        $mes = $dataObj->format('m');
        $ano = $dataObj->format('Y');

        // Constrói o array
        return [
            'dia' => $dia,
            'mes' => $meses[$mes],
            'ano' => $ano
        ];

    }

    function converterDataParaArray($data)
    {

        // Verifica se a data é válida e no formato esperado
        if (\DateTime::createFromFormat('Y-m-d H:i:s', $data) === false) {
            return null; // Retorna null se a data não for válida
        }

        // Cria um objeto DateTime a partir da data
        $dataObj = new \DateTime($data);

        // Define os meses em formato abreviado
        $meses = [
            '01' => 'JAN',
            '02' => 'FEV',
            '03' => 'MAR',
            '04' => 'ABR',
            '05' => 'MAI',
            '06' => 'JUN',
            '07' => 'JUL',
            '08' => 'AGO',
            '09' => 'SET',
            '10' => 'OUT',
            '11' => 'NOV',
            '12' => 'DEZ'
        ];

        // Extrai o dia, mês e ano
        $dia = $dataObj->format('d');
        $mes = $dataObj->format('m');
        $ano = $dataObj->format('Y');

        // Constrói o array
        return [
            'dia' => $dia,
            'mes' => $meses[$mes],
            'ano' => $ano
        ];
    }

    static function retornarBuscasProntasPorBairro($codigoConteudo)
    {

        $dados['lista_buscas_prontas'] = CmsPaginaConteudoPerguntaResposta::select(["titulo_conteudo", "descricao_resposta", "titulo_pergunta"])
            ->join('cms_pagina_conteudo', 'cms_pagina_conteudo_pergunta_resposta.cod_pagina_conteudo', 'cms_pagina_conteudo.cod_pagina_conteudo')
            ->where('cms_pagina_conteudo_pergunta_resposta.cod_pagina_conteudo', $codigoConteudo)
            ->get()
            ->toArray();

        return $dados['lista_buscas_prontas'];

    }

    static function validarCaptcha($postCaptcha, $CAPTCHA_SECRET_KEY_PARAMETRO)
    {
        $autorizado = true;
        $mensagemErro = "";

        if (isset($postCaptcha)) {
            $captcha = $postCaptcha;
        } else {
            $captcha = false;
        }

        if (!$captcha) {
            $autorizado = false;
            $mensagemErro = 'Erro! Captcha não preenchido.';

        } else {

            $respostaCaptcha = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret=" . $CAPTCHA_SECRET_KEY_PARAMETRO . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
            );


            // use json_decode to extract json response
            $respostaCaptcha = json_decode($respostaCaptcha);


            if ($respostaCaptcha->success === false) {
                $autorizado = false;
                $mensagemErro = 'Erro! Captcha inválido.';
            }
        }

        $arrayRetorno = [$autorizado, $mensagemErro];
        return $arrayRetorno;
    }

    static function siteEmManutencao($siteEmManutencao)
    {

        $ips_acesso = str_replace(' ', '', $siteEmManutencao['ip_administrador']);
        $ips_acesso = explode(',', $ips_acesso);

        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP de um proxy compartilhado
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP passado por um proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // IP remoto do usuário
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        //verifcar se está em localhost
        $abienteLocalHost = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ? true : false;

        //não validar IP no localhost
        $autorizacaoPorIp = $abienteLocalHost ? true : in_array(trim($ip), $ips_acesso);

        if ($siteEmManutencao['site_em_manutencao'] && !$autorizacaoPorIp && $abienteLocalHost == false) {
            // include __DIR__ . "../../views/pages/manutencao.php"; 
            header('Location:' . BASE_URL . 'manutencao');
            exit;
        }
    }

    public static function gerarTituloImovel($imovel)
    {

        $titulo = $imovel['tipo'] .
            ($imovel['codigofinalidade'] == '2' ? ' à venda' : ' para alugar') .
            ', ' . $imovel['bairro'] .
            ' - ' . $imovel['cidade'] . '/' . $imovel['estado'];

        return $titulo;
    }

    static function validarAnexo($anexo)
    {
        $arquivo = $anexo;

        // Extensões permitidas
        $extensoesPermitidas = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

        // Obtém a extensão do arquivo enviado (em minúsculas)
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

        // Valida a extensão
        if (!in_array($extensao, $extensoesPermitidas)) {

            return false;

        } else {

            return true;
        }
    }

    static function tratarValoresEmpreendimentos($param)
    {

        $retorno = explode('até', str_replace('m²', '', $param));
        if (count($retorno) > 1) {

            return $retorno[0] . ' - ' . $retorno[1];
        } else {
            return $retorno[0];
        }
    }

    static function getFirstImageListBlog($data)
    {

        // Verifica se a chave 'conteudos_relacionados' existe e é um array
        if (isset($data['conteudos_relacionados']) && is_array($data['conteudos_relacionados'])) {
            foreach ($data['conteudos_relacionados'] as $conteudo) {
                // Verifica se há a chave 'imagens' no conteúdo e se ela é um array
                if (isset($conteudo['imagens']) && !empty($conteudo['imagens']) && is_array($conteudo['imagens'])) {
                    // Retorna a primeira imagem encontrada
                    return $conteudo['imagens'][0] ?? BASE_URL . 'assets/images/imagem-nao-disponivel-'.TEMA_STRING.'.webp';
                }
            }
        }
        // Retorna null se nenhuma imagem for encontrada
        return BASE_URL . 'assets/images/imagem-nao-disponivel-'.TEMA_STRING.'.webp';
    }


    
}