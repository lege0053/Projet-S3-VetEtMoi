<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}

if ((!isset($_GET["id"])) || !ctype_digit($_GET["id"])) {
    header("Location: listeAnimal.php");
}

$animalId = $_GET['animalId'];

$stmt = MyPDO::getInstance()->prepare(
    <<<SQL
SELECT name as "name", DATE_FORMAT(birthDay, "%d/%c/%Y") as "birthDay"
FROM Animal
WHERE animalId = ?;
SQL
);
$stmt->execute([$animalId]);
$rep = $stmt->fetchAll();

if ($rep){
    foreach ($rep as $reponse) {
        $name = $reponse['name'];
        $birthDay = $reponse["birthDay"];
    }
}


$webPage = new WebPage("Profil de {$name}");

//test
    $futurRDV = "Mercredi 2 Octobre";
    $dernierRDV = "Jeudi 25 Octobre";


$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">{$webPage->getIcon('cat', 35)}Le profil de {$name}</h3>
</div>

<div class="d-flex flex-row pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
    <img src="img/rounded_dog.png" class="mx-auto w-25" alt="">
    <div class="d-flex flex-column justify-content-left">
        <div class="d-flex flex-column justify-content-left"> 
            <a style="color: #02897A; font-weight: bold;">Nom
            <a style="color: #262626; font-weight: bold;">{$name}
        </div>
        <div class="d-flex flex-column justify-content-left">
            <a style="color: #02897A; font-weight: bold;">Age
            <a style="color: #262626; font-weight: bold;">{$age}
        </div>
        <div class="d-flex flex-column justify-content-left">
            <a style="color: #02897A; font-weight: bold;">Date de Naissance
            <a style="color: #262626; font-weight: bold;">{$birthDay}
        </div>
    </div>
    <div class="d-flex flex-column justify-content-left">
        <a style="color: #02897A; font-weight: bold;">Prochain rendez-vous
        <a style="color: #262626; font-weight: bold;">{$futurRDV}
        <a style="color: #262626; font-weight: bold;">11:00
        <a style="color: #02897A; font-weight: bold;">Dernier rendez-vous
        <a style="color: #262626; font-weight: bold;">{$dernierRDV}
    </div>
</div>
HTML;


$webPage->appendContent($html);
echo $webPage->toHTML();