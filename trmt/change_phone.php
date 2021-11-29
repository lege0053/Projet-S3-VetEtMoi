<?php
declare(strict_types=1);

include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if($auth->isUserConnected()){
    $user = $auth->getUser();
    if(isset($_POST['num'])&& !empty($_POST['num'])){
        $num = WebPage::escapeString($_POST['num']);
        $req = MyPDO::getInstance()->prepare(<<<SQL
                        UPDATE Users
                        SET phone = :phone 
                        WHERE userId = :userId;
                    SQL);
        $req->execute(['userId' => $user->getUserId(), 'phone' => $num]);
        $user->flush();
        header('Location: ../profile.php');
    } else header('Location: ../profile_change_phone.php?err_infos');
} else header('Location: ../connexion.php');
