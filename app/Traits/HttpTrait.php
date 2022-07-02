<?php

require_once __DIR__ . "/../Lib/Http.php";

trait HttpTrait {

    /**
     * Ponte para recuperação ou gerar novo token.
     *
     * @param array $data
     * 
     */
    public function login(array $data)
    {
        $http = new HTTPRequest();
        return $http->login($data);
    } 
    
    /**
     * Ponte para recuperação das estatisticas com detalhes
     *
     * @param array $data
     * @param string $token
     * @return void
     */
    public function getStatisticsDetails($data, $token)
    {
        $http = new HTTPRequest();
        return $http->getStatisticsDetails($data, $token);
    }
    
    /**
     * Ponte para recuperação de estatisticas por fila.
     *
     * @param array $data
     * @param string $token
     * @return void
     */
    public function getStatisticsQueues($data, $token)
    {
        $http = new HTTPRequest();
        return $http->getStatisticsQueues($data, $token);
    }

    /**
     * Ponte para recuperação De chamadas abandonadas.
     *
     * @param array $data
     * @param string $token
     */
    public function getAbandoned($data, $token)
    {
        $http = new HTTPRequest();
        return $http->getAbandoned($data, $token);
    }

    /**
     * Ponte para recuperação das filas existentes.
     *
     * @param array $data
     * @param string $token
     * 
     */
    public function getQueuesApi($token)
    {
        $http = new HTTPRequest();
        return $http->getQueuesApi($token);
    }

    /**
     * Ponte para recuperação do totalizador de cada ramal.
     *
     * @param array $data
     * @param string $token
     */
    public function getTotalizerApi($data, $token)
    {
        $http = new HTTPRequest();
        return $http->getTotalizer($data, $token);
    }

    /**
     * Ponte para recuperação da agenda com todos os ramais existentes.
     *
     * @param array $data
     * @param string $token
     */
    public function getSchedule($data, $token)
    {
        $http = new HTTPRequest();
        return $http->getSchedule($data, $token);
    }
        
    /**
     * Ponte para recuperação do histórico de chamadas atendidas.
     *
     * @param array $data
     * @param string $token
     */
    public function getHistoriesAttended($data, $token)
    {
        $http = new HTTPRequest();
        return $http->getHistoriesAttended($data, $token);
    }
}