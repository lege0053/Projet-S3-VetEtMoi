<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

header('Content-type: application/json');
if(isset($_GET['userId']) && !empty($_GET['userId'])) {
    $userId = $_GET['userId'];
    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT userId FROM Users
        WHERE userId = :userId
    SQL);
    $rq->execute(["userId" => $userId]);
    $res = $rq->fetch();
    if($res){
        $rq = MyPDO::getInstance()->prepare(<<<SQL
            SELECT a.name, a.birthDay, a.raceId, r.raceName, s.speciesId, s.speciesName FROM Animal a 
                JOIN Race r ON a.raceId = r.raceId
                JOIN Species s ON r.speciesId = s.speciesId
            WHERE a.userId = :userId
        SQL);
        $rq->execute(["userId" => $userId]);
        $array = $rq->fetchAll();
        echo $array ? json_encode($array) : json_encode(["error" => "user_without_animal"]);
    } else echo json_encode(["error" => "no_user_found"]);
} else echo json_encode(["error" => "no_userId"]);