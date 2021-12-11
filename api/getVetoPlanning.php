<?php
declare(strict_types=1);

include_once "../src/MyPDO.php";
include_once "../src/User.php";

header("Content-Type: application/json");

$year = isset($_GET['year']) && !empty($_GET['year']) ? $_GET['year'] : date('o');
$week = isset($_GET['week']) && !empty($_GET['week']) ? $week = $_GET['week'] : date('W');
if($week > 53) echo json_encode(["error" => "week_number_greater_than_53"]);
if(isset($_GET['vetoId']) && !empty($_GET['vetoId'])) {
    $vetoId = $_GET['vetoId'];

    $checkVeto = MyPDO::getInstance()->prepare(<<<SQL
        SELECT userId FROM Users
        WHERE isVeto = 1
        AND userId = :vetoId
    SQL);
    $checkVeto->execute(['vetoId' => $vetoId]);

    if($checkVeto->fetch()){

        $lowerDate = date("Y-m-d", strtotime("o".$year."W".$week."1") );
        $upperDate = date("Y-m-d", strtotime("o".$year."W".$week."6") );

        $rq = MyPDO::getInstance()->prepare(<<<SQL
                                            SELECT * FROM Meeting m
                                            JOIN Concern c ON m.meetingId = c.meetingId
                                            JOIN TimeSlot t ON c.timeSlotId = t.timeSlotId
                                            WHERE m.vetoId = :vetoId
                                            AND t.timeSlotId IN (SELECT timeSlotId 
                                                                   FROM Concern
                                                                   WHERE meetingId IN (SELECT meetingId
                                                                                       FROM Meeting
                                                                                       WHERE meetingDate > STR_TO_DATE(:lowerDate, '%Y-%m-%d')
                                                                                       AND meetingDate <= STR_TO_DATE(:upperDate, '%Y-%m-%d')))
                                            ORDER BY meetingDate
                                        SQL);
        $rq->execute(['vetoId' => $vetoId, 'lowerDate' => $lowerDate, 'upperDate' => $upperDate]);
        $array = $rq->fetchAll();
        if($array){
            echo json_encode($array);
        }
        else echo json_encode(['error' => 'no_meeting_and_timeslot_found']);
    } else echo json_encode(['error' => 'user_is_not_veto']);
} else echo json_encode(["error" => "lack_of_information"]);