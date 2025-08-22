<?php

namespace src\handlers;

class Video
{
    public function __contructor()
    {

    }

    public function tratarVideo($paramUrlvideo)
    {        

        $urlvideo = $paramUrlvideo;
        $numero_caracter_url_video = strlen($urlvideo);

        //Se tiver uma URL VÍDEO
        if ($numero_caracter_url_video > 8) {

            //trata videos shorts
            if (strstr($urlvideo, "shorts/")) {

                $url = $urlvideo;
                $primeiro_tratamento = explode('shorts/', $urlvideo);
                $codigo_video = $primeiro_tratamento[1];

            }
            //trata videos embed
            else if (strstr($urlvideo, "embed/")) {

                $url = $urlvideo;
                $primeiro_tratamento = explode('embed/', $urlvideo);
                $codigo_video = $primeiro_tratamento[1];

            }
            else if (strstr($urlvideo, "https://youtu.be")) {

                $url = $urlvideo;
                $primeiro_tratamento = explode('.be/', $urlvideo);
                $codigo_video = $primeiro_tratamento[1];
            } 
            //Se não for link curto faz o tratammento para URL
            else {
                
                $url = $urlvideo;
                $array_video = explode('v=', $urlvideo);
                $codigo_video = $array_video[1];
            }
            
            if (strstr($codigo_video, "&")) {

                $array_segundo_tratamento = explode('&', $codigo_video);
                $codigo_video = $array_segundo_tratamento[0];
            }

            return 'https://www.youtube.com/embed/' . $codigo_video;
            exit;
        }

        return NULL;
    }


}
