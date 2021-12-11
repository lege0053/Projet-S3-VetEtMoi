<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";
include_once "../src/User.php";

header("Content-Type: application/json");

if(isset($_GET['vetoId']) && !empty($_GET['vetoId'])) {
    $vetoId = $_GET['vetoId'];

    $checkVeto = MyPDO::getInstance()->prepare(<<<SQL
        SELECT userId FROM Users
        WHERE isVeto = 1
        AND userId = :vetoId
    SQL);
    $checkVeto->execute(['vetoId' => $vetoId]);

    if($checkVeto->fetch()){

        $rq = MyPDO::getInstance()->prepare(<<<SQL
                                            SELECT * FROM Meeting m
                                            JOIN Concern c ON m.meetingId = c.meetingId
                                            JOIN TimeSlot t ON c.timeSlotId = t.timeSlotId
                                            WHERE m.vetoId = :vetoId
                                        SQL);
        $rq->execute(['vetoId' => $vetoId]);
        $array = $rq->fetchAll();
        if($array){
            echo json_encode($array);
        }
        else {
            echo json_encode(['error' => 'no_meeting_and_timeslot_found']);
        }

    }
    else{
        echo json_encode(['error' => 'user_is_not_veto']);
    }
}
else {
    echo json_encode(["error" => "lack_of_information"]);
}