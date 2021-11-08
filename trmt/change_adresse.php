<?php
declare(strict_types=1);

include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if($auth->isUserConnected()){
    $user = $auth->getUser();

    if(isset($_POST['CP'], $_POST['ville'], $_POST['adress'])
        && !empty($_POST['CP']) && !empty($_POST['ville']) && !empty($_POST['adress'])){
        $cp = WebPage::escapeString($_POST['CP']);
        $city = WebPage::escapeString($_POST['ville']);
        $rue = WebPage::escapeString($_POST['adress']);

        $req = MyPDO::getInstance()->prepare(<<<SQL
            UPDATE Users
            SET cp= :cp,
                city= :city,
                rue= :rue

        SQL);
        $req->execute(['userId' => $user->getUserId(), 'cp' => $cp, 'city' => $city, 'rue' => $rue]);
        header('Location: ../profile.php');
    } else header('Location: ../profile_change_adresse.php?err_infos');
} else header('Location: ../connexion.php');
