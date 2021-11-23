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

<div class="d-flex flex-row justify-content-center">
    <div class="d-flex row p-3 align-items-center" style="background-color: #DDDDDD;border-radius: 15px;">
        {$webPage->getImgCarre("{$animal->getSpecieName()}", "{$animal->getName()}", 300)}
        <div class="d-flex flex-column pl-3 pr-3">
            <h3>INFORMATIONS</h3>
            <div class="d-flex flex-row">
                <div class="d-flex flex-column pr-5" style="font-size: 19px;">
                    <a style="color: #02897A; font-weight: bold;">Espèce
                    <a style="color: #262626; font-weight: bold; margin-bottom: 20px;">{$animal->getSpecieName()}
                    <a style="color: #02897A; font-weight: bold;">Nom
                    <a style="color: #262626; font-weight: bold;margin-bottom: 20px;">{$animal->getName()}
                    <a style="color: #02897A; font-weight: bold;">Genre
                    <a style="color: #262626; font-weight: bold;">{$animal->getGenderName()}
                </div>
                <div class="d-flex flex-column" style="font-size: 19px;">
                    <a style="color: #02897A; font-weight: bold;">Race
                    <a style="color: #262626; font-weight: bold; margin-bottom: 20px;">{$animal->getNameRace()}
                    <a style="color: #02897A; font-weight: bold;">Age
                    <a style="color: #262626; font-weight: bold;margin-bottom: 20px;">{$age}
                    <a style="color: #02897A; font-weight: bold;">Date de Naissance
                    <a style="color: #262626; font-weight: bold;">{$animal->getBirthDay()}
                </div>
            </div>
        </div>
    </div>
</div>
HTML;


$webPage->appendContent($html);
echo $webPage->toHTML();