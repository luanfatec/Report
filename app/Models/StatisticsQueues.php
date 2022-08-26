<?php


require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../Connection/Sql.php";
require_once __DIR__ . "/../Helpers/FormatHours.php";


class StatisticsQueues extends Connection {

    protected $table;

    public function __construct()
    {
        $this->table = "ctl_statistics_queues";
    }

    public function getToken()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db()->prepare($query);
        $stmt->execute();
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $datas;
    }

    public function save($queue, $params)
    {
	print($params);
	exit;
        $query = "INSERT INTO $this->table (
            fila, data, total_chamadas, porcen_chamadas_atendidas_nivel, maior_tempo_espera, data_maior_espera, total_chamadas_atendidas, 
            porcen_atendidas, total_abandonadas, porcen_abandonadas, total_transbordadas, porcen_transbordadas, 
            total_transferidas, porcen_transferidas, tma,tme, tme_atendidas, tme_abandonadas, tme_transbordadas
        ) VALUES (
            :fila, date(:data), :total_chamadas, :porcen_chamadas_atendidas_nivel, :maior_tempo_espera, :data_maior_espera, :total_chamadas_atendidas, 
            :porcen_atendidas, :total_abandonadas, :porcen_abandonadas, :total_transbordadas, :porcen_transbordadas, 
            :total_transferidas, :porcen_transferidas, :tma, :tme, :tme_atendidas, :tme_abandonadas, :tme_transbordadas
        );";

        $stmt = $this->db()->prepare($query);
        $stmt->bindValue(":fila", $queue);
        $stmt->bindValue(":data", date("Y-m-d", strtotime(str_replace("/", "-", $params->data))));
        $stmt->bindValue(":total_chamadas", intval($params->total_chamadas));
        $stmt->bindValue(":porcen_chamadas_atendidas_nivel", floatval($params->porcen_chamadas_atendidas_nivel));
        $stmt->bindValue(":maior_tempo_espera", FormatDate::formatHours(str_replace(",", ".", $params->maior_tempo_espera|0)));
        $stmt->bindValue(":data_maior_espera", date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $params->data_maior_espera))));
        $stmt->bindValue(":total_chamadas_atendidas", intval($params->total_chamadas_atendidas));
        $stmt->bindValue(":porcen_atendidas", floatval($params->porcen_atendidas));
        $stmt->bindValue(":total_abandonadas", intval($params->total_abandonadas));
        $stmt->bindValue(":porcen_abandonadas", floatval($params->porcen_abandonadas));
        $stmt->bindValue(":total_transbordadas", intval($params->total_transbordadas));
        $stmt->bindValue(":porcen_transbordadas", floatval($params->porcen_transbordadas));
        $stmt->bindValue(":total_transferidas", intval($params->total_transferidas));
        $stmt->bindValue(":porcen_transferidas", floatval($params->porcen_transferidas));
        $stmt->bindValue(":tma", FormatDate::formatHours(str_replace(",", ".", $params->tma|0)));
        $stmt->bindValue(":tme", FormatDate::formatHours(str_replace(",", ".", $params->tme|0)));
        $stmt->bindValue(":tme_atendidas", FormatDate::formatHours(str_replace(",", ".", $params->tme_atendidas|0)));
        $stmt->bindValue(":tme_abandonadas", FormatDate::formatHours(str_replace(",", ".", $params->tme_abandonadas|0)));
        $stmt->bindValue(":tme_transbordadas", FormatDate::formatHours(str_replace(",", ".", $params->tme_transbordadas|0)));
      
        $stmt->execute();

        return $stmt;
    }

}
