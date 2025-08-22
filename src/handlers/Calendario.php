<?php

namespace src\handlers;

class Calendario
{
    public function __construct()
    {
    }

    function getCalendario()
    {
        // Arrays de mapeamento de dias da semana e meses para português
        $diasSemana = array(
            'Mon' => 'SEG',
            'Tue' => 'TER',
            'Wed' => 'QUA',
            'Thu' => 'QUI',
            'Fri' => 'SEX',
            'Sat' => 'SAB',
            'Sun' => 'DOM',
        );

        $meses = array(
            'Jan' => 'Jan',
            'Feb' => 'Fev',
            'Mar' => 'Mar',
            'Apr' => 'Abr',
            'May' => 'Mai',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Ago',
            'Sep' => 'Set',
            'Oct' => 'Out',
            'Nov' => 'Nov',
            'Dec' => 'Dez',
        );

        // Cria um array para armazenar os próximos 7 dias
        $nextSevenDays = array();

        // Obtém a data atual
        $currentDate = new \DateTime();

        // Itera pelos próximos 7 dias
        for ($i = 0; $i < 7; $i++) {

            // Formata os dados conforme o padrão 
            $dayKey = $currentDate->format('d');
            $dayOfWeek = $currentDate->format('D');
            $month = $currentDate->format('M');

            $dayData = array(
                "dia" => $diasSemana[$dayOfWeek],
                "diaMes" => $currentDate->format('d'),
                "mes" => $meses[$month],
                "data" => $currentDate->format('d\/m\/Y'),
            );

            // Adiciona os dados ao array
            $nextSevenDays[$dayKey] = $dayData;

            // Adiciona um dia à data atual
            $currentDate->modify('+1 day');
        }

        return $nextSevenDays;
    }


}
