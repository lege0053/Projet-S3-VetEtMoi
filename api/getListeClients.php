<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

header('Content-type: application/json');

$rq = MyPDO::getInstance()->prepare(<<<SQL
    SELECT userId, firstName, lastName FROM Users
    WHERE isVeto = 0;
SQL);
$rq->execute();
$array = $rq->fetchAll();
if($array)
    echo json_encode($array);
else
    echo json_encode(["error" => "no_client_found"]);