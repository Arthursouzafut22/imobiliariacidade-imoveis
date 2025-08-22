<?php

namespace src\handlers;

use \src\Config;
use Exception;
use src\models\CmsConfiguracao;

/**
 * Clase para consumir API Rest
 * Las operaciones soportadas son:
 * 	
 * 	- POST		: Agregar
 * 	- GET		: Consultar
 * 	- DELETE	: Eliminar
 * 	- PUT		: Actualizar
 * 	- PATCH		: Actualizar por parte
 * 
 * Extras
 * 	- autenticaci�n de acceso b�sica (Basic Auth)
 *  	- Conversor JSON
 *
 * @author     	Diego Valladares <dvdeveloper.com>
 * @version 	1.0
 */
class Api {

    public $httpheader = [];

    public function __construct(){

        $config = CmsConfiguracao::select('chave_imoview')->first()->toArray();

        $this->httpheader = [
            'Content-Type: application/json',
            'Chave:' .  $config['chave_imoview'],
        ];
    } 

    public function myUrlEncode($string) {

        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

        return str_replace($entities, $replacements, urlencode($string));
    }

    public function POST($URL, $fields) {

        $URL = $this->myUrlEncode($URL);

        try {

            $ch = curl_init();

            if ($ch === false) {
                throw new Exception('Falha na inicialização');
            }

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->httpheader);
            $response = curl_exec($ch);


            if ($response === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }

            curl_close($ch);
            return $response;
        } catch (Exception $e) {
            trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }
    }

    /**
     * Consultar a un servidor a trav�s del protocolo HTTP (GET).
     * Se utiliza para consultar recursos en una API REST
     *
     * @param string $URL URL recurso, ejemplo: http://website.com/recurso/(id) no obligatorio
     * @param string $TOKEN token de autenticaci�n
     * @return JSON
     */
    public function GET($URL, $fields) {

        $URL = $this->myUrlEncode($URL);

        try {

            $ch = curl_init();

            if ($ch === false) {
                throw new Exception('Falha na inicialização');
            }

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5000);
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->httpheader);
            $response = curl_exec($ch);

// echo "<pre>";;
// $info = curl_getinfo($ch);
//            print_r($info);exit;

            if ($response === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }

            curl_close($ch);
            return $response;

        } catch (Exception $e) {

            // if($e->getCode() == 6){
            //     header('Content-Type: application/json');
            //     echo json_encode('{"error":true}');
            //     exit;
            // }
          
            if($e->getCode() == 22){
                $response = 'imovel nao encontrado';
                return $response;
            }

            trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }
    }

    public function GETGOOGLE($URL) {
        
    
        $URL = $this->myUrlEncode($URL);

        try {

            $ch = curl_init();

            if ($ch === false) {
                throw new Exception('Falha na inicialização');
            }

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->httpheader);
            $response = curl_exec($ch);
            
//echo "<pre>";;
//$info = curl_getinfo($ch);
//print_r($info);exit;

            if ($response === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }

            curl_close($ch);
            return $response;
        } catch (Exception $e) {

       
            trigger_error(sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }
    }

}
