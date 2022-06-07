<?php 

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../Connection/Sql.php";
require_once __DIR__ . "/../Helpers/FormatHours.php";


class Totalizer extends Connection 
{
    private $table;

    public function __construct()
    {
        $this->table = "ctl_totalizer";
    }

    public function save($data)
    {
        $query = "INSERT INTO $this->table (
            ramal, externas_recebidas_atendidas, externas_recebidas_nao_atendidas, externas_recebidas_tempo, externas_realizadas_atendidas,
            externas_realizadas_nao_atendidas, externas_realizadas_tempo, internas_recebidas_atendidas, internas_recebidas_nao_atendidas,
            internas_recebidas_tempo, internas_realizadas_atendidas, internas_realizadas_nao_atendidas, transferidas_recebidas, 
            transferidas_recebidas_tempo, transferidas_realizadas, data_agrupada
          ) VALUES (
            :ramal, :externas_recebidas_atendidas, :externas_recebidas_nao_atendidas, :externas_recebidas_tempo, :externas_realizadas_atendidas,
            :externas_realizadas_nao_atendidas, :externas_realizadas_tempo, :internas_recebidas_atendidas, :internas_recebidas_nao_atendidas,
            :internas_recebidas_tempo, :internas_realizadas_atendidas, :internas_realizadas_nao_atendidas, :transferidas_recebidas, 
            :transferidas_recebidas_tempo, :transferidas_realizadas, :data_agrupada
        );";

        $stmt = $this->db()->prepare($query);
        $stmt->bindValue("ramal", $data->ramal);
        $stmt->bindValue("externas_recebidas_atendidas", intval($data->externas_recebidas_atendidas));
        $stmt->bindValue("externas_recebidas_nao_atendidas", intval($data->externas_recebidas_nao_atendidas));
        $stmt->bindValue("externas_recebidas_tempo", FormatDate::formatHours(str_replace(",", ".", $data->externas_recebidas_tempo|0)));
        $stmt->bindValue("externas_realizadas_atendidas", intval($data->externas_realizadas_atendidas));
        $stmt->bindValue("externas_realizadas_nao_atendidas", intval($data->externas_realizadas_nao_atendidas));
        $stmt->bindValue("externas_realizadas_tempo", FormatDate::formatHours(str_replace(",", ".", $data->externas_realizadas_tempo|0)));
        $stmt->bindValue("internas_recebidas_atendidas", intval($data->internas_recebidas_atendidas));
        $stmt->bindValue("internas_recebidas_nao_atendidas",intval($data->internas_recebidas_nao_atendidas));
        $stmt->bindValue("internas_recebidas_tempo", FormatDate::formatHours(str_replace(",", ".", $data->internas_recebidas_tempo|0)));
        $stmt->bindValue("internas_realizadas_atendidas", intval($data->internas_realizadas_atendidas));
        $stmt->bindValue("internas_realizadas_nao_atendidas", intval($data->internas_realizadas_nao_atendidas));
        $stmt->bindValue("transferidas_recebidas", intval($data->transferidas_recebidas));
        $stmt->bindValue("transferidas_recebidas_tempo", FormatDate::formatHours(str_replace(",", ".", $data->transferidas_recebidas_tempo|0)));
        $stmt->bindValue("transferidas_realizadas", intval($data->transferidas_realizadas));
        $stmt->bindValue("data_agrupada", date("Y-m-d", strtotime(str_replace("/", "-", $data->data_agrupada))) );        

        $stmt->execute();

        return $stmt;
    }
}