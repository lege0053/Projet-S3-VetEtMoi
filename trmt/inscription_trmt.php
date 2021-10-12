<?php
declare(strict_types=1);

require "../autoload.php";

Session::start();

if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prnm']) && !empty($_POST['prnm'])
    && isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['repeat_mail']) && !empty($_POST['repeat_mail'])
    && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['repeat_mdp']) && !empty($_POST['repeat_mdp'])
    && isset($_POST['tel']) && !empty($_POST['tel']) )
{
    $nom = htmlspecialchars($_POST['nom']);
    $prnm = htmlspecialchars($_POST['prnm']);
    $mail = htmlspecialchars($_POST['mail']);
    $repeat_mail = htmlspecialchars($_POST['repeat_mail']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $repeat_mdp = htmlspecialchars($_POST['repeat_mdp']);
    $tel = preg_replace('/\s+/', '', htmlspecialchars($_POST['tel']));

    $check = MyPDO::getInstance()->prepare(<<<SQL
        SELECT * FROM Utilisateur
        WHERE mail = ?
    SQL);
    $check->execute([$mail]);
    $data = $check->fetch();
    $row = $check->rowCount();

    if($row == 0)
    {
        if(strlen($nom) <= 40)
        {
            if(strlen($prnm) <= 40)
            {
                if(strlen($mail) <= 60)
                {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                    {
                        if(preg_match("/[0-9]{10}/", $tel)) /** A revoir +33 ect */
                        {
                            $mdp = password_hash($mdp, PASSWORD_BCRYPT); /**A voir cryptage SHA12**/
                            $chr='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $id='';
                            for($i=0; $i<12; $i++)
                            {
                                $id.=$chr[random_int(0,62)];
                            }
                            $insert = MyPDO::getInstance()->prepare(
                                'INSERT INTO Utilisateur(id, nom, prnm, mail, mdp, tel)
                            VALUES(?,?, ?, ?, ?, ?)');

                            $insert->execute([$id,$nom, $prnm, $mail, $mdp, $tel]);

                            $get = MyPDO::getInstance()->prepare(<<<SQL
                            SELECT * FROM Utilisateur
                            WHERE mail = ?
                        SQL);
                            $get->execute([$mail]);
                            $data = $get->fetch();

                            $_SESSION['idUtilisateur'] = (int)($data['idUtilisateur']);
                            $_SESSION['isAdmin'] = (int)($data['isAdmin']);
                            header('Location: ../userpage.php');
                        } else header('Location: ../inscription.php?reg_err=tel');
                    } else header('Location: ../inscription.php?reg_err=mail');
                } else header('Location: ../inscription.php?reg_err=mail_lenght');
            } else header('Location: ../inscription.php?reg_err=prnm_lenght');
        } else header('Location: ../inscription.php?reg_err=nom_lenght');
    } else header('Location: ../inscription.php?reg_err=already');
} else header('Location: ../inscription.php');

