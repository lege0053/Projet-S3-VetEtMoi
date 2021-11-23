<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";

header('Content-type: application/json');
if(isset($_GET['vetoId'], $_GET['lowerDate'], $_GET['upperDate'])
    && !empty($_GET['vetoId']) && !empty($_GET['lowerDate']) && !empty($_GET['upperDate'])){

    $vetoId = $_GET['vetoId'];
    $lowerDate = $_GET['lowerDate'];
    $upperDate = $_GET['upperDate'];

    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT userId FROM Users
        WHERE userId = :vetoId
        AND isVeto = 1
    SQL);
    $rq->execute(["vetoId" => $vetoId]);
    $res = $rq->fetch();

    if($res){

        $rq2 = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM TimeSlot
            WHERE timeSlotId IN (SELECT timeSlotId
                                 FROM Horaire
                                 WHERE userId = :vetoId)
            AND timeSlotId NOT IN (SELECT timeSlotId 
                                   FROM Concern
                                   WHERE meetingId IN (SELECT meetingId
                                                       FROM Meeting
                                                       WHERE meetingDate > STR_TO_DATE(:lowerDate, '%Y-%m-%d')
                                                       AND meetingDate < STR_TO_DATE(:upperDate, '%Y-%m-%d')))
        SQL);
        $rq2->execute(["vetoId" => $vetoId, "lowerDate" => $lowerDate, "upperDate" => $upperDate]);
        $array = $rq2->fetchAll();

        if($array)
            echo json_encode($array);
        else echo json_encode(["success" => "no_available_timeslot"]);
    } else echo json_encode(["error" => "no_veto_found"]);
} else echo json_encode(["error" => "no_attribute"]);