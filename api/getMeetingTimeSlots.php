<?php
declare(strict_types=1);

include_once "../src/Meeting.php";

header('Content-type: application/json');
if(isset($_GET['meetingId']) && !empty($_GET['meetingId'])) {
    $meetingId = $_GET['meetingId'];

    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT * FROM TimeSlot
        WHERE timeSlotId IN (SELECT timeSlotId FROM Concern
                            WHERE meetingId = :meetingId);
    SQL);
    $rq->execute(['meetingId' => $meetingId]);
    echo json_encode($rq->fetchAll());

} else
    echo <<<JSON
        {"error": "no_meeting_id"}
    JSON;