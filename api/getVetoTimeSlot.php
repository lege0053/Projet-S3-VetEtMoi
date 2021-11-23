<?php
declare(strict_types=1);

require_once "../src/MyPDO.php";
require_once "../src/User.php";

header('Content-type: application/json');
if(isset($_GET['vetoId']) && !empty($_GET['vetoId'])){

    $vetoId = $_GET['vetoId'];
    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT userId FROM Users
        WHERE userId = :userId
        AND isVeto = 1
    SQL);
    $rq->execute(["userId" => $vetoId]);
    $array = $rq->fetch();

    if($array){

        $rq2 = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM TimeSlot
            WHERE timeSlotId IN (SELECT timeSlotId FROM Horaire
                                WHERE userId = :vetoId);       
        SQL);
        $rq2->execute(["vetoId" => $vetoId]);
        $timeSlots = $rq2->fetchAll();

        if($timeSlots){
            echo json_encode($timeSlots);
        } else
            echo json_encore(["error" => "no_timeslot_for_this_veto"]);
    } else
        echo json_encode(["error" => "no_veto_found"]);
} else
    echo json_encode(["error" => "no_veto_id_mentioned"]);