<?php

require_once __DIR__ . "/app/Controllers/GetStatisticsDetailsController.php";
require_once __DIR__ . "/app/Controllers/GetStatisticsQueuesController.php";
require_once __DIR__ . "/app/Controllers/GetAbandonedController.php";
require_once __DIR__ . "/app/Controllers/SaveQueuesController.php";
require_once __DIR__ . "/app/Controllers/GetTotalizerController.php";
require_once __DIR__ . "/app/Controllers/GetScheduleController.php";
require_once __DIR__ . "/app/Controllers/GetAttendedController.php";

$getStatisticsDetailsController = new GetStatisticsDetailsController();
$getStatisticsQueuesController = new GetStatisticsQueuesController();
$getAbandonedController = new GetAbandonedController();
$saveQueuesController = new SaveQueuesController();
$getTotalizerController = new GetTotalizerController();
$getScheduleController = new GetScheduleController();
$getAttendedController = new GetAttendedController();


if (empty($argv[1]))
{
    help();
}

elseif ($argv[1] == "update-db")
{
    // Atualização de produção, por favor, não executar.
    $getStatisticsQueuesController->get();
    //$getTotalizerController->get();
}

elseif ($argv[1] == "save-phones")
{
    $test = $getScheduleController->get();
    print_r($test);
}

elseif ($argv[1] == "save-queues")
{
    if(!empty($argv[2]))
    {
        $saveQueuesController->save($argv[2]);
    }
    else {
        help();
    }
}

elseif ($argv[1] == "test-integration")
{
    // Testes de integração de novas funções.
   $getAttendedController->get();
    
}
else 
{
    help();
}

function help()
{
    print_r("\nArgumento inválido.");
    print_r("\nUtilize 'update-db':  para carregar novos dados na base de dados.");
    print_r("\nUtilize 'save-queues user': para carregar novas filas na base de dados, se existir novas ainda não cadastradas. (Ex: save-queues luan)");
    print_r("\nUtilize 'save-phones': para carregar a agenda telefonicas.");
    print_r("\nUtilize 'test-integration': para testar novas funções.");
    print_r("\n\nImportante lembrar que o update-db irá carregar todos os dados do dia anterior, sendo assim, se já houve carregamento automático, poderá duplicar os dados.");
    print_r("\nAinda estou estudando para tratar esse problema. Ass. Luan\n\n");
}