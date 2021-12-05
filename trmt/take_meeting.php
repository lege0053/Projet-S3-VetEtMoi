<?php
declare(strict_types=1);
include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if($auth->isUserConnected()) {
    $user = $auth->getUser();
    $userId = $user->getUserId();

    if (isset($_POST['vetoId'], $_POST['animalId'], $_POST['chooseDate'], $_POST['timeSlotId'], $_POST['speciesId'])
        && !empty($_POST['vetoId']) && !empty($_POST['chooseDate']) && !empty($_POST['timeSlotId']) && !empty($_POST['speciesId'])) {
        $vetoId = WebPage::escapeString($_POST['vetoId']);
        $animalId = WebPage::escapeString($_POST['animalId']);
        $chooseDate = WebPage::escapeString($_POST['chooseDate']);
        $timeSlotId = WebPage::escapeString($_POST['timeSlotId']);
        $speciesId = WebPage::escapeString($_POST['speciesId']);

        //Création d'un meetingID
        $allChars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $meetingId='';
        for($i=0; $i<12; $i++) {
            $meetingId.= $allChars[random_int(0,61)];
        }

        //Insertion du nouveau Meeting dans la bd
        $req = MyPDO::getInstance()->prepare(<<<SQL
            INSERT INTO Meeting(meetingId, meetingDate, userId, animalId, vetoId, speciesId)
            VALUES (:meetingId, :meetingDate, :userId, :animaId, :vetoId, :speciesId)
        SQL);
        $req->execute(['meetingId' => $meetingId, 'meetingDate' => $chooseDate, 'userId' => $userId, 'animaId' => $animalId, 'vetoId' => $vetoId, 'speciesId' => $speciesId]);
        echo json_encode(['success' => 'success_take_meeting']);
    }else //echo json_encode(['error' => 'lack_of_information']);
    echo json_encode($_POST);
}else echo json_encode(["error" => "user_not_connected"]);