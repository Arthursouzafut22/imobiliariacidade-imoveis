<?php

namespace core;

use \src\Config;

class Controller {

    protected function redirect($url) {
  
        header("Location: " . $this->getBaseUrl() . $url);
        exit;
    }

    private function getBaseUrl() {
        $base = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        $base .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != '80') {
            $base .= ':' . $_SERVER['SERVER_PORT'];
        }
        // $base .= Config::BASE_DIR;
        $base  = BASE_URL;

        return $base;
    }

    private function _render($folder, $viewName, $viewData = []) {
        if (file_exists('../src/views/' . $folder . '/' . $viewName . '.php')) {
            extract($viewData);
            $render = fn($vN, $vD = []) => $this->renderPartial($vN, $vD);
            $base = $this->getBaseUrl();
            require '../src/views/' . $folder . '/' . $viewName . '.php';
        }
    }

    private function renderPartial($viewName, $viewData = []) {
        $this->_render('partials', $viewName, $viewData);
    }

    public function render($viewName, $viewData = []) {
        $this->_render('pages', $viewName, $viewData);
    }

    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getRequestData() {

        switch ($this->getMethod()) {
            case 'GET':
                return $_GET;
                break;

            case 'PUT':
            case 'DELETE':

                parse_str(file_get_contents('php://input'), $data);
                return (array) $data;
                break;
            case 'POST':
                $data = json_decode(file_get_contents('php://input'));

                if (is_null($data)) {
                    $data = $_POST;
                }

                return (array) $data;
                break;
            default:
                break;
        }
    }

}
