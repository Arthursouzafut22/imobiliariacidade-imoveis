<?php

namespace src\handlers;

class UrlEncode {

    public $parametrosURL = [];
    public $breadcrumb = [];

    //public $low = array("Á" => "á", "É" => "é", "Í" => "í", "Ó" => "ó", "Ú" => "ú", "Ü" => "ü", "não" => "não", "Ç" => "ç");
//    public $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
//    public $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

    public function __contructor() {
        
    }

    function remove_accent($str) {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return str_replace($a, $b, $str);
    }

    public function amigavelURL($str) {

        return $str = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), str_replace('/', '-', $this->remove_accent($str))));
    }

    public function tirarAcentos($string) {

        return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"), explode(" ", "a A e E i I o O u U n N c C"), $string);
    }

    //SEPARA TODOS OS PARAMETROS INSERIDOS PELA DA URL
    function multiexplode($array) {
        $dados = [];

        foreach ($array as $key => $value) {

            $dados[$key] = explode('/', $value);
        }

        return $dados;
    }

    //PREPARA URL 
    public function prepararUrlApi($url) {
        $dados = str_replace(['/', '+'], "/", $url);
        $this->parametrosURL = $this->multiexplode($dados);
    }

    //RETORNA O TIPO,CIDADES, BAIRROS DA PAGINA COM OS PARAMETROS RECEBIDOS
    //== GERAR UM TITULO ANTES DA RENDERIZAÇÃO DA PÁGINA
    public function gerarTituloPagina() {

        $titulo = '';
        $params = [];

        if (isset($this->parametrosURL['tipos'][0]) || !empty($this->parametrosURL['tipos'][0])) {

            if (isset($this->parametrosURL['tipos']) && !empty($this->parametrosURL['tipos'])) {

                foreach ($this->parametrosURL['tipos'] as $key => $t) {

                    if ($key < count($this->parametrosURL['tipos']) - 1) {

                        if ('imovel' == $t) {

                            $titulo .= 'Imóveis' . ', ';
                        } else {

                            $titulo .= ucwords($t) . ', ';
                        }
                    } else {

                        if ('imovel' == $t) {

                            $titulo .= 'Imóveis';
                        } else {

                            $titulo .= ucwords($t);
                        }
                    }

                    $params['tipos'][$key] = ucwords($t);
                }
            } else {

                if ('imovel' == $t) {

                    $titulo .= 'Imóveis';
                } else {

                    $titulo .= ucwords($t);
                }
            }
        } else {

            $params['tipos'][0] = 'imoveis';
        }

        $contAux = 0;

        if (isset($this->parametrosURL['param'][0]) || !empty($this->parametrosURL['param'][0])) {

            foreach ($this->parametrosURL['param'] as $key => $p) {

                if ($key < count($this->parametrosURL['param']) - 1) {

                    if ($p != '0-quartos' && $p != '0-banheiros' && $p != '0-suites' && $p != '0-vagas') {

                        if ($contAux == 0) {
                            $titulo .= ' com ';
                            $contAux++;
                        }

                        //  $titulo .= str_replace('-', ' ', ucwords($p)) . ', ';
                        // $params['params'][$key] = str_replace('-', ' ', ucwords($p));
                    }
                } else {

                    if ($p != '0-quartos' && $p != '0-banheiros' && $p != '0-suites' && $p != '0-vagas') {

                        if ($contAux == 0) {
                            $titulo .= ' com ';
                            $contAux++;
                        }

                        // $titulo .= str_replace('-', ' ', ucwords($p));
                        // $params['params'][$key] = str_replace('-', ' ', ucwords($p));
                    }
                }
            }
        } else {
            
        }


        if (isset($this->parametrosURL['finalidade'][0]) || !empty($this->parametrosURL['finalidade'][0])) {

            foreach ($this->parametrosURL ['finalidade']as $key => $f) {

                if ($key < count($this->parametrosURL['finalidade']) - 1) {

                    if ($f == 'venda') {

                        $titulo .= ' à ' . $f . ', ';
                        $params['finalidade'][$key] = 'Venda';
                    } else {

                        $params['finalidade'][$key] = 'Aluguel';
                        $titulo .= ' para ' . $f . ', ';
                    }
                } else {

                    if ($f == 'venda') {

                        $titulo .= ' à ' . $f;
                        $params['finalidade'][$key] = 'Venda';
                    } else {

                        $params['finalidade'][$key] = 'Aluguel';
                        $titulo .= ' para ' . $f;
                    }
                }
            }
        } else {
            $params['finalidade'][0] = 'venda';
        }


        if (isset($this->parametrosURL['cidades'][0]) || !empty($this->parametrosURL['cidades'][0])) {

            foreach ($this->parametrosURL['cidades'] as $key => $c) {

                if ($key <= count($this->parametrosURL['cidades']) - 1) {

                    if ($c == REGIAO_LOCALIZACAO_BASE_URL) {

                        $titulo .= REGIAO_LOCALIZACAO_BASE;
                        $params['cidades'][$key] = ' '.STR_REGIAO_LOCALIZACAO_BASE; 
                    } else {

                        $titulo .= ' em ' . ucwords(str_replace('-', ' ', $c)) . ', ';

                        $params['cidades'][$key] = ' em ' . ucwords(str_replace('-', ' ', $c));
                    }
                } else {

                    if ($c == REGIAO_LOCALIZACAO_BASE_URL) {

                        $titulo .= ' '.REGIAO_LOCALIZACAO_BASE;
                        $params['cidades'][$key] = ' '.STR_REGIAO_LOCALIZACAO_BASE;
                    } else {

                        $titulo .= ' em ' . ucwords(str_replace('-', ' ', $c));
                        $params['cidades'][$key] = ' em ' . ucwords(str_replace('-', ' ', $c));
                    }
                }
            }
        } else {
            $params['cidades'][0] = REGIAO_LOCALIZACAO_BASE_URL;
        }


        if (isset($this->parametrosURL['bairros'][0]) || !empty($this->parametrosURL['bairros'][0])) {

            if ($this->parametrosURL['bairros'][0] != 'todos-os-bairros') {

                $titulo .= ' no ';

                foreach ($this->parametrosURL['bairros'] as $key => $b) {

                    if ($key < count($this->parametrosURL['bairros']) - 1) {

                        $titulo .= ucwords(str_replace('-', ' ', $b)) . ', ';
                        $params['bairros'][$key] = ucwords($b);
                    } else {

                        $titulo .= ucwords(str_replace('-', ' ', $b));
                        $params['bairros'][$key] = ucwords($b);
                    }
                }
            } else {
                $titulo .= '';
            }
        } else {
            $params['bairros'][0] = 'todos-os-bairros';
        }

      

        $this->breadcrumb = $params;
        //return $titulo;

        return '';
    }

    public function getParametroDetalheURL($dados) {

        $titulo = '';

        foreach ($this->parametrosURL['imovel'] as $key => $t) {

            if ($key < count($this->parametrosURL['imovel']) - 1) {

                $titulo .= ucwords($t) . ', ';
            } else {

                $titulo .= ucwords($t) . ' de ';
            }
        }
    }

    function gerarUrl($string) {

        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

        return str_replace($entities, $replacements, urlencode($string));
    }

}
