<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

$min_offset = 0;
$row_number = 25;
if(isset($_GET['min_offset'], $_GET['row_number']) && !empty($_GET['min_offset']) && !empty($_GET['row_number'])){
    $min_offset = $_GET['min_offset'];
    $row_number = $_GET['row_number'];
}

header('Content-type: application/json');

$rq = MyPDO::getInstance()->prepare(<<<SQL
    SELECT userId, firstName, lastName FROM Users
    WHERE isVeto = 0
    ORDER BY lastName
    LIMIT $min_offset, $row_number
SQL);
$rq->execute();
$array = $rq->fetchAll();
if($array)
    echo json_encode($array);
else
    echo json_encode(["error" => "no_client_found"]);