<?php


class FormatDate {

    public static function formatHours($total)
    {
        $seconds = floor($total); //Converte para inteiro

        $negative = $seconds < 0; //Verifica se é um valor negativo

        if ($negative) {
            $seconds = -$seconds; //Converte o negativo para positivo para poder fazer os calculos
        }

        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);

        $sign = $negative ? '-' : ''; //Adiciona o sinal de negativo se necessário

        return $sign . sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }
}