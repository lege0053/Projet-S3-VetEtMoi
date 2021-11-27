<?php
declare(strict_types=1);

include_once "../src/Meeting.php";

header('Content-type: application/json');
if(isset($_POST['meetingId']) && !empty($_POST['meetingId'])) {
    $meetingId = $_POST['meetingId'];

    $rq = MyPDO::getInstance()->prepare(<<<SQL
        SELECT * FROM Meeting
        WHERE meetingId = :meetingId
    SQL);
    $rq->execute(['meetingId' => $meetingId]);
    echo json_encode($rq->fetchAll());

} else
    echo json_encode(['error' => 'no_meeting_id']);