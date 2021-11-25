<?php
declare(strict_types=1);

$auth = new SecureUserAuthentication();
Session::start();
$user = $auth->getUser();

if((isset($_POST['species']) || isset($_POST['animal'])) && isset($_POST['veto']) && isset($_POST['timeslot']) && isset($_POST['date']))
{
    $allChars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $id='';
    for($i=0; $i<12; $i++) {
        $id.= $allChars[random_int(0,61)];
    }

    $req=MyPDO::getInstance()->prepare(<<<SQL
    INSERT INTO Meeting(meetingId, meetingDate, isPayed, price, userId, animalId, vetoId)
    VALUES(?,?,?,?,?,?,?)
    SQL);
    $req->execute([$id, $_POST['date'], 0, null, $user->getUserId(), $_POST['animal'], $_POST['veto']]);
}


