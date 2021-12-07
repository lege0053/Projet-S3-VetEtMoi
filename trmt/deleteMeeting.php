<?php
declare(strict_types=1);

include_once "../autoload.php";

$auth = new SecureUserAuthentication();
Session::start();
header('Content-type: application/json');
if(isset($_POST['meetingId']) && !empty($_POST['meetingId']) && $auth->isUserConnected()){
    $user = $auth->getUser();
    $meetingId = $_POST['meetingId'];
    $meeting = Meeting::createFromId($meetingId);

    if($meeting->getUserId() == $user->getUserId()){

        $pdo = MyPDO::getInstance();
        $rq1 = $pdo->prepare(<<<SQL
            DELETE FROM Concern
            WHERE meetingId = :meetingId
        SQL);
        $rq1->execute(['meetingId' => $meetingId]);

        $rq2 = $pdo->prepare(<<< SQL
            DELETE FROM Meeting
            WHERE meetingId = :meetingId
        SQL);
        $rq2->execute(['meetingId' => $meetingId]);
        echo json_encode(["success" => "success_delete_meeting"]);
    } else echo json_encode(["error" => "not_your_meeting"]);
} else echo json_encode(["error" => "no_meeting_id"]);
