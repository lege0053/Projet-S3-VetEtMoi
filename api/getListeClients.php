<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

$min_value = 0;
$max_value = 25;
if(!isset($_GET['min_value'], $_GET['max_value']) && !empty($_GET['min_value']) && !empty($_GET['max_value'])){
    $min_value = $_GET['min_value'];
    $max_value = $_GET['max_value'];
}

//header('Content-type: application/json');

$rq = MyPDO::getInstance()->prepare(<<<SQL
    SELECT * FROM(SELECT userId, firstName, lastName FROM Users
                  WHERE isVeto = 0)
    WHERE ROWNUMBER >= :min_value AND ROWNUMBER <= :max_value
SQL);
$rq->execute([':min_value' => $min_value, ':max_value' => $max_value]);
$array = $rq->fetchAll();
if($array)
    echo json_encode($array);
else
    echo json_encode(["error" => "no_client_found"]);