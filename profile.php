<?php
declare(strict_types=1);
include "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");

$webPage = new WebPage("Profil");
$webPage->appendJsUrl("js/meetingUtils.js");

setlocale(LC_ALL, 'fr_FR', 'French_France', 'French');
date_default_timezone_set('Europe/Paris');

$webPage->appendCss(<<<CSS
    .rdv-item{
        background-color: #C9C9C9;
        border-radius: 10px;
        padding: 0px 0px 0px 25px;
        margin: 10px;
        display: flex;
        align-items: center;
    }
    .rdv-item span {
        flex: 1;
    }
    
    .rdv-head{
        background-color: #C9C9C9;
        border-radius: 10px;
        padding: 0px 0px 0px 25px;
        margin: 10px;
        display: flex;
        flex-grow: 1;
        align-items: center;
        height: 50px;
        font-size: 1.3em;
    }
    
    .rdv-head span{
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .rdv {
        display: flex;
        flex-direction: column;
        width: 900px;
        background: #DDDDDD;
        margin: 0;
        padding: 25px;
        border-radius: 20px;
    }
    .button-delete {
        font-weight: bold;
        letter-spacing: 0.02em;
        border-radius: 10px;
        color: white;
        text-decoration: none;
        background-color: #C20D0D;
        transition: 0.2s background-color ease-in-out;
    }
    .button-delete:hover {
        background-color: #810000;
        text-decoration: none;
        color: white;
    }
CSS
);

$user = $auth->getUser();
$rdvList = $user->getMeetings();
$rdvHTML = "<span>Vous n'avez aucun rendez-vous</span>";
if($rdvList){
    $rdvs = "";
    foreach($rdvList as $rdv){
        $meetingId = $rdv->getMeetingId();
        $animal = $rdv->getAnimal();
        if($animal)
            $animalName = $rdv->getAnimal()->getName();
        else
            $animalName = "Nouvel Animal - ".$rdv->getSpecies()->getSpeciesName();
        $date = ucwords(utf8_encode(strftime("%A %d %b %Y - %H:%M", strtotime($rdv->getDateTime()))));
        $rdvs .= "<div id='meeting-$meetingId' class='rdv-item'>
                    <span>{$date}</span>
                    <span style='display: flex; justify-content: center;'>{$animalName}</span>
                    <span style='display: flex; justify-content: end;'>
                        <input type='button' class='button-delete' onclick='showEditMeetingPopup(\"$meetingId\");' value='Supprimer' style='padding: 12px 25px; font-size: 18px;'>
                    </span>
                  </div>";
    }
    $rdvHTML = <<< HTML
        <div class="rdv">
            <div class="rdv-head">
                <span>Date</span>
                <span>Nom de l'animal</span>
                <span></span>
            </div>
            $rdvs
        </div>
    HTML;
}

$webPage->appendContent(<<<HTML
    <div class="d-flex flex-column">
        <div class="d-flex" style="justify-content: center; align-items: center; padding-bottom: 80px;">
            <img src="img/animal/cat1.png" height="400">
            {$user->getHTMLProfile()}
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h1 class="title">Prochain Rendez-Vous</h1>
            $rdvHTML
        </div>
    </div>
HTML);

echo $webPage->toHTML();