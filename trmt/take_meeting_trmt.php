<?php
declare(strict_types=1);
include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if($auth->isUserConnected()) {
    $user = $auth->getUser();
    $userId = $user->getUserId();

    if (isset($_GET['vetoId'], $_GET['animalId'], $_GET['chooseDate'], $_GET['timeSlotId'], $_GET['speciesId'])
        && !empty($_GET['vetoId']) && !empty($_GET['chooseDate']) && !empty($_GET['timeSlotId']) && !empty($_GET['speciesId'])) {
        $vetoId = WebPage::escapeString($_GET['vetoId']);
        $animalId = WebPage::escapeString($_GET['animalId']);
        $chooseDate = WebPage::escapeString($_GET['chooseDate']);
        $timeSlotId = WebPage::escapeString($_GET['timeSlotId']);
        $speciesId = WebPage::escapeString($_GET['speciesId']);

        //Création d'un meetingID
        $allChars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $meetingId='';
        for($i=0; $i<12; $i++) {
            $meetingId.= $allChars[random_int(0,61)];
        }

        if($animalId == -1){
            $animalId = null;
        }

        //Insertion du nouveau Meeting dans la bd
        $req = MyPDO::getInstance()->prepare(<<<SQL
            INSERT INTO Meeting(meetingId, meetingDate, userId, animalId, vetoId, speciesId)
            VALUES (:meetingId, STR_TO_DATE(:meetingDate, '%d/%m/%Y'), :userId, :animaId, :vetoId, :speciesId)
        SQL);
        $res = $req->execute(['meetingId' => $meetingId, 'meetingDate' => $chooseDate, 'userId' => $userId, 'animaId' => $animalId, 'vetoId' => $vetoId, 'speciesId' => $speciesId]);
        if($res) {
            $req2 = MyPDO::getInstance()->prepare(<<<SQL
                INSERT INTO Concern(meetingId, timeSlotId)
                VALUES(:meetingId, :timeSlotId)
            SQL);
            $res2 = $req2->execute(['meetingId' => $meetingId, 'timeSlotId' => $timeSlotId]);
            if($res2)
                echo json_encode(['success' => 'success_take_meeting']);
            else
                echo json_encode(['error' => 'error']);
        }
        else
            echo json_encode(['error' => "meeting_already_existing"]);
    }else echo json_encode(['error' => 'lack_of_information']);
    //echo json_encode($_POST);
}else echo json_encode(["error" => "user_not_connected"]);