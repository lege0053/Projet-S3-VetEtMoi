<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}

$webPage = new WebPage("Rendez-vous");

//test
    $name = "Rocky";
    $age = "1 an et 2 mois";
    $birthDay = "12/08/2020";
    $futurRDV = "Mercredi 2 Octobre";
    $dernierRDV = "Jeudi 25 Octobre";


$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">{$webPage->getIcon('cat')}Le profil de {$name}</h3>
</div>

<div class="d-flex flex-row pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
    <img src="img/partChien.png" class="mx-auto w-25" alt="">
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

<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">{$webPage->getIcon('watch')}Poser un Rendez-Vous</h3>
</div>
HTML;

//Tableau de RDV

$webPage->appendContent($html);
echo $webPage->toHTML();