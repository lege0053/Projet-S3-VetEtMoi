<?php
declare(strict_types=1);
include_once "../autoload.php";

$auth = new SecureUserAuthentication();
if ($auth->isUserConnected()) {
    $user = $auth->getUser();

    if (isset($_POST['nom'], $_POST['species'], $_POST['race'], $_POST['gender'], $_POST['dress'], $_POST['poids'], $_POST['threat'], $_POST['birth'], $_POST['tatoo'],$_POST['chip'], $_POST['userId'])
        && !empty($_POST['nom']) && !empty($_POST['species']) && !empty($_POST['race'] && !empty($_POST['gender'])) && !empty($_POST['threat']) && !empty($_POST['birth']) && !empty($_POST['userId'])) {
        $nom = WebPage::escapeString($_POST['nom']);
        $species = WebPage::escapeString($_POST['species']);
        $race = WebPage::escapeString($_POST['race']);
        $gender = WebPage::escapeString($_POST['gender']);
        $threat =  WebPage::escapeString($_POST['threat']); #Peut-être null
        $dress = WebPage::escapeString($_POST['poids']);  #Peut-être null
        $poids = WebPage::escapeString($_POST['poids']); #Peut-être null
        $birth = WebPage::escapeString($_POST['birth']);
        $tatoo = WebPage::escapeString($_POST['tatoo']); #Peut-être null
        $chip = WebPage::escapeString($_POST['chip']); #Peut-être null
        $proprioId = WebPage::escapeString($_POST['userId']);

        //Création d'un animalId
        $req1 = MyPDO::getInstance()->prepare(<<<SQL
            SELECT MAX(animalId)
            FROM Animal
        SQL);
        $req1->execute();
        $data = $req1->fetch();
        var_dump($data);
        if ($req1->rowCount() > 0) {
            $animalId = $data[0] + 1 ;
        }

        //Insertion du nouvel animal dans la bd
        $req2 = MyPDO::getInstance()->prepare(<<<SQL
            INSERT INTO Animal(animalId, name, birthDay, userId, threatId, genderId, raceId, dress, weight, tatoo, chip)
            VALUES (:animalId, :name, STR_TO_DATE(:birthDay, '%Y/%m/%d'), :userId, :threatId, :genderId, :dress, :weight, :tatoo, :chip)
        SQL);
        $res2 = $req2->execute(['animalId' => $animalId, 'name' => $nom, 'birthDay' => $birth, 'userId' => $proprioId, 'threatId' => $threat, 'genderId' => $gender, 'raceId' => $race, 'dress' => $dress, 'weight' => $poids, 'tatoo' => $tatoo, 'chip' => $chip]);
        header('Location: ../fiche_client_animal.php?success');
    }else header('Location: ../fiche_client_animal.php?err_infos');
}else header('Location: ../connexion.php');