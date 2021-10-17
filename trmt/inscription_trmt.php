<?php
declare(strict_types=1);

require "../autoload.php";

Session::start();

if(isset($_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['code'], $_POST['phone'])
&& !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['email']) && !empty($_POST['code']) && !empty($_POST['phone'])) {

    $lastName = htmlspecialchars($_POST['lastName']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['code']);
    $phone = htmlspecialchars($_POST['phone']);

    $check = MyPdo::getInstance()->prepare(<<<SQL
        SELECT * FROM Users
        WHERE email = ?
    SQL);
    $check->execute([$email]);
    $data = $check->fetch();

    if($check->rowCount() == 0) {
        if(strlen($lastName) <= 50) {
            if(strlen($firstName) <= 50) {
                if(strlen($email) <= 50) {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if(true) // PREG MATCH LE PHONE ICI LES AMIS
                        {
                            $allChars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $id='';
                            for($i=0; $i<12; $i++) {
                                $id.= $allChars[random_int(0,61)];
                            }

                            $insert = MyPDO::getInstance()->prepare(
                                'INSERT INTO Users(userId, lastName, firstName, email, password, phone)
                            VALUES(:userId, :lastName, :firstName, :email, :password, :phone)');
                            $insert->execute(['userId' => $id, 'lastName' => $lastName, 'firstName' => $firstName, 'email' => $email, 'password' => $password, 'phone' => $phone]);

                            $_SESSION['userId'] = $id;
                            header('Location: ../profile.php');
                        } else header('Location: ../inscription.php?reg_err=tel');
                    } else header('Location: ../inscription.php?reg_err=mail');
                } else header('Location: ../inscription.php?reg_err=mail_lenght');
            } else header('Location: ../inscription.php?reg_err=prnm_lenght');
        } else header('Location: ../inscription.php?reg_err=nom_lenght');
    } else header('Location: ../inscription.php?reg_err=already');
} else header('Location: ../inscription.php');