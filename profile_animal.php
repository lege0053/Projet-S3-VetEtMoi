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

$animalId = $_GET['id'];

$animal = Animal::createFromId($animalId);

$age = date_diff(date_create($animal->getBirthDay()), date_create("now"))->format("%y ans %m mois");


$webPage = new WebPage("Profil de {$animal->getName()}");

//test
    $futurRDV = "Mercredi 2 Octobre";
    $dernierRDV = "Jeudi 25 Octobre";


$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">{$webPage->getIcon('cat', 35)}Le profil de {$animal->getName()}</h3>
</div>

<div class="d-flex flex-row justify-content-center" style="background-color: #DDDDDD; border-radius: 10px">
    {$webPage->getImgCarre("dog", "", 300)}
    <div class="d-flex flex-column justify-content-left">
        <div class="d-flex flex-column justify-content-left"> 
            <a style="color: #02897A; font-weight: bold;">Nom
            <a style="color: #262626; font-weight: bold;">{$animal->getName()}
        </div>
        <div class="d-flex flex-column justify-content-left">
            <a style="color: #02897A; font-weight: bold;">Age
            <a style="color: #262626; font-weight: bold;">{$age}
        </div>
        <div class="d-flex flex-column justify-content-left">
            <a style="color: #02897A; font-weight: bold;">Date de Naissance
            <a style="color: #262626; font-weight: bold;">{$animal->getBirthDay()}
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