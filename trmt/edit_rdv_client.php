<?php
declare(strict_types=1);
include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if ($auth->isUserConnected()) {
    $user = $auth->getUser();

    if (isset($_POST['meetingId'], $_POST['meetingDate'], $_POST['animalId'])
        && !empty($_POST['meetingId']) && !empty($_POST['meetingDate']) && !empty($_POST['animalId'])) {
        $meetingId = WebPage::escapeString($_POST['meetingId']);
        $meetingDate = WebPage::escapeString($_POST['meetingDate']);
        $animalId = WebPage::escapeString($_POST['animalId']);

        $req2 = MyPDO::getInstance()->prepare(<<<SQL
            UPDATE MEETING
            SET meetingDate = ?,
                animalId = ?
            WHERE meetingId = ?;
        SQL
        );
        $req2->execute([$meetingDate, $animalId, $meetingId]);
        header('Location: ../profile.php');
    }else header('Location: ../prisederdv.php?err_infos');
}else header('Location: ../connexion.php');