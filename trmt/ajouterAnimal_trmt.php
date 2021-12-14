<?php
declare(strict_types=1);

require "autoload.php";

if(isset($_POST['nom'], $_POST['race'], $_POST['genre'], $_POST['species'], $_POST['dress'], $_POST['birth'], $_POST['userId'], $_POST['threatId'])
    && !empty($_POST['nom']) && !empty($_POST['race']) && !empty($_POST['genre']) && !empty($_POST['species']) && !empty($_POST['dress']) && !empty($_POST['birth']) && !empty($_POST['userId']) && !empty($_POST['threatId'])) {

    $nom = WebPage::escapeString($_POST['nom']);
    $race = WebPage::escapeString($_POST['race']);
    $genre = WebPage::escapeString($_POST['genre']);
    $species = WebPage::escapeString($_POST['species']);
    $dress = WebPage::escapeString($_POST['dress']);
    $poids = WebPage::escapeString($_POST['poids']) ?? null;
    $birth = WebPage::escapeString($_POST['birth']);
    $userId = WebPage::escapeString($_POST['userId']);
    $threatId = WebPage::escapeString($_POST['threatId']);
    $tatoo = WebPage::escapeString($_POST['tatoo']) ?? null;
    $chip = WebPage::escapeString($_POST['chip']) ?? null;

    //Création d'un animalId
    $req1 = MyPDO::getInstance()->prepare(<<<SQL
        SELECT animalId
        FROM Animal
        ORDER BY 1;
    SQL);
    $req1->execute();
    $newAnimalId = strval($req1->rowCount() + 1);

    //Insertion du nouvel Animal dans la bd
    $req2 = MyPDO::getInstance()->prepare(<<<SQL
        INSERT INTO Animal(animalId, name, birthDay, userId, threatId, genderId, raceId, dress, weight, tatoo, chip)
        VALUES (:newAnimalId, :nom, STR_TO_DATE(:birth, '%d/%m/%Y'), :userId, :threatId, :genre, :race, :dress, :poids, :tatoo,:chip);
    SQL);
    $req2->execute(['newAnimalId' => $newAnimalId, 'nom' => $nom, 'birth' => $birth, 'userId' => $userId, 'threatId' => $threatId, 'genre' => $genre, 'race' => $race, 'dress' => $dress, 'poids' => $poids, 'tatoo' => $tatoo, 'chip' => $chip]);
    header('Location: ../fiche_client_animal.php?userId='.$userId.'&animalId='.$newAnimalId);
} else echo json_encode(['error' => 'lack_of_information']);