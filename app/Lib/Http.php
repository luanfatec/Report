<?php

use function PHPSTORM_META\type;

require_once __DIR__ . "/../Common/Environmento.php";
Environment::load(__DIR__ . "/../../");

class HTTPRequest {

    private $url;

    /**
     * Contrutor
     * Está iniciando o link de destino da API da King Voice.
     */
    public function __construct()
    {
        $this->url = getenv("CTL_LINK");
    }

    /**
     * Função de recuperação de dados na API King Voice.
     *
     * @param string $method
     * @param string $url
     * @param array $data
     * @param boolean $verify
     * @param array $headers
     * @param boolean $verbose
     * @return string
     */
    private function accept($method = "GET", $url="", $data = [], $verify = true, $headers = [], $verbose = false)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST   => $method, 
            CURLOPT_VERBOSE         => $verbose,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_SSL_VERIFYPEER  => $verify,
            CURLOPT_HTTPHEADER      => $headers,
            CURLOPT_POSTFIELDS      => $data
        ]);

        // Executa a requisição;
        $output = curl_exec($curl);

        curl_close($curl);
        return $output;
    }

    /**
     * Função responsável pela recuperação do token ou gerar um novo token.
     *
     * @param array $data
     * 
     */
    public function login(array $data)
    {
        $response = $this->accept($method="POST",
            $url=$this->url . "/login", 
            $data=json_encode($data), $verify=false, 
            $headers=array("Content-Type:application/json"),
        );

        return json_decode($response);
    }

    /**
     * Função responsável pela recuperação das estatisticas com detalhes
     *
     * @param array $data
     * @param string $token
     */
    public function getStatisticsDetails($data, $token)
    {
        
        $header = array (
            "Content-Type:application/json",
            "token:$token"
        );
        
        $response = $this->accept($method="GET", 
            $url=$this->url . "/estatistica_detalhada/relatorio?" . http_build_query($data), 
            $data=http_build_query($data), $verify=false, $headers=$header,
            $verbose=false
        );
        
        return json_decode($response);
    }

    /**
     * Função responsável pela recuperação das estatisticas por fila.
     *
     * @param array $data
     * @param string $token
     */
    public function getStatisticsQueues($data, $token)
    {
        
        $header = array (
            "Content-Type:application/json",
            "token:$token"
        );
        
        $response = $this->accept($method="GET", 
            $url=$this->url . "/estatistica_fila/relatorio?" . http_build_query($data), 
            $data=http_build_query($data), $verify=false, $headers=$header,
            $verbose=false
        );
        
        return json_decode($response);
    }

    /**
     * Função responsável pela recuperação de chamas abandonadas.
     *
     * @param array $data
     * @param string $token
     */
    public function getAbandoned($data, $token)
    {
        $header = array (
            "Content-Type:application/json",
            "token:$token"
        );
        
        $response = $this->accept($method="GET", 
            $url=$this->url . "/abandonadas/relatorio?" . http_build_query($data), 
            $data=http_build_query($data), $verify=false, $headers=$header,
            $verbose=false
        );

        return json_decode($response);
    }

    /**
     * Função responsável pela recuperação das filas existentes na central.
     *
     * @param array $data
     * @param string $token
     * 
     */
    public function getQueuesApi($token)
    {
        $header = array (
            "Content-Type:application/json",
            "token:$token"
        );

        $response = $this->accept($method="GET", 
            $url=$this->url . "/filas", $verify=false, $data=false, $headers=$header, $verbose=false
        );
        
        return json_decode($response);
    }

    /**
     * Função responsável pela recuperação do totalizador de chamadas.
     *
     * @param array $data
     * @param string $token
     * 
     */
    public function getTotalizer($data, $token)
    {
        $header = array (
            "Content-Type:application/json",
            "token:$token"
        );

        $response = $this->accept($method="GET", 
            $url=$this->url . "/totalizador/relatorio?" . http_build_query($data),
            $verify=false, $data=http_build_query($data), $headers=$header, $verbose=false
        );
        
        return json_decode($response);
    }

    /**
     * Função responsável pela recuperação da Agenda.
     *
     * @param array $data
     * @param string $token
     */
    public function getSchedule($data, $token)
    {
        $header = array (
            "Content-Type:application/json",
            "token:$token"
        );

        $response = $this->accept($method="GET", 
            $url=$this->url . "/agenda?" . http_build_query($data),
            $verify=false, $data=http_build_query($data), $headers=$header, $verbose=false
        );
        
        return json_decode($response);
    }

    /**
     * Função responsável pela recuperação historico de atendidas.
     *
     * @param array $data
     * @param string $token
     */
    public function getHistoriesAttended($data, $token)
    {
        $header = array (
            "Content-Type:application/json",
            "token:$token"
        );

        $response = $this->accept($method="GET", 
            $url=$this->url . "/atendidas/relatorio?" . http_build_query($data),
            $verify=false, $data=http_build_query($data), $headers=$header, $verbose=false
        );
        
        return json_decode($response);
    }
}
