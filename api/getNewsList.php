<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

header('Content-type: application/json');
$req = "SELECT * FROM News";
$whereSequence = "";
$orderBy = " ORDER BY dateNews";
$vetoId = "";
if(isset($_GET['vetoId']) && !empty($_GET['vetoId'])){
    $vetoId = $_GET['vetoId'];
    $whereSequence = " WHERE userId = :vetoId";
}

$rq = MyPDO::getInstance()->prepare($req.$whereSequence.$orderBy);
if($vetoId)
    $rq->execute(['vetoId' => $vetoId]);
else
    $rq->execute();

$array = $rq->fetchAll();
if($array){
    echo json_encode($array);
} else echo json_encode(["error" => "no_news_found"]);