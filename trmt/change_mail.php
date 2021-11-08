<?php
declare(strict_types=1);

include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if($auth->isUserConnected()){
    $user = $auth->getUser();

    if(isset($_POST['oldMail'], $_POST['newMail'], $_POST['repeatNewMail'])
        && !empty($_POST['oldMail']) && !empty($_POST['newMail']) && !empty($_POST['repeatNewMail'])){
        $oldMail = WebPage::escapeString($_POST['oldMail']);
        $newMail = WebPage::escapeString($_POST['newMail']);
        $repeatNewMail = WebPage::escapeString($_POST['repeatNewMail']);

        $req = MyPDO::getInstance()->prepare(<<<SQL
            SELECT * FROM Users
            WHERE email = :mail
        SQL);
        $req->execute(['mail' => $newMail]);
        if(!$req->rowCount() > 0){
            if($newMail === $repeatNewMail){
                $req2 = MyPDO::getInstance()->prepare(<<<SQL
                    UPDATE Users
                    SET email= :mail 
                    WHERE userId = :userId;
                SQL);
                $req2->execute(['userId' => $user->getUserId(), 'mail' => $newMail]);
                header('Location: ../profile.php');
            } else header('Location: ../profile_change_mail.php?err_repeatMail');
        } else header('Location: ../profile_change_mail.php?err_newMail_already_exist');
    } else header('Location: ../profile_change_mail.php?err_infos');
} else header('Location: ../connexion.php');
