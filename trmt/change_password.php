<?php
declare(strict_types=1);

include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if($auth->isUserConnected()){
    $user = $auth->getUser();

    if(isset($_POST['oldPassword'], $_POST['newPassword'], $_POST['newPasswordRepeat'])
        && !empty($_POST['oldPassword']) && !empty($_POST['newPassword']) && !empty($_POST['newPasswordRepeat'])){
        $oldPassword = WebPage::escapeString($_POST['oldPassword']);
        $newPassword = WebPage::escapeString($_POST['newPassword']);
        $newPasswordRepeat = WebPage::escapeString($_POST['newPasswordRepeat']);

        $req = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM Users
            WHERE userId = :userId AND password = :password
        SQL);
        $req->execute(['userId' => $user->getUserId(), 'password' => $oldPassword]);
        if($req->rowCount() > 0){
            if($newPassword === $newPasswordRepeat){
                $req2 = MyPDO::getInstance()->prepare(<<<SQL
                    UPDATE Users
                    SET password = :password 
                    WHERE userId = :userId;
                SQL);
                $req2->execute(['userId' => $user->getUserId(), 'password' => $newPassword]);
                header('Location: ../profile.php');
            } //else header('Location: ../profile_change_password.php?err_repeatPassword');
        } //else header('Location: ../profile_change_password.php?err_oldPassword');
    } //else header('Location: ../profile_change_password.php?err_infos');
} //else header('Location: ../connexion.php');
