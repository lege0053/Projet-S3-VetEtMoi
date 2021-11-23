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
$webPage->appendJsUrl("js/meetingUtils.js");
$webPage->appendJsUrl("js/ajaxrequest.js");
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
CSS
);

//Meeting
$rdvList = $animal->getAllMeetings();
$rdvHTML = "<span>Vous n'avez aucun rendez-vous</span>";
if($rdvList){
    $rdvs = "";
    foreach($rdvList as $rdv){
        $meetingId = $rdv->getMeetingId();
        $date = ucwords(utf8_encode(strftime("%A %d %b %Y - %H:%M", strtotime($rdv->getDateTime()))));
        $rdvs .= "<div class='rdv-item'>
                    <span>{$date}</span>
                    <span style='display: flex; justify-content: end;'>
                        <input type='button' class='button' onclick='showEditMeetingPopup(\"$meetingId\");' value='Modifier' style='padding: 12px 25px; font-size: 18px; '>
                    </span>
                    <!--<div style='display: flex;'>
                        {$webPage->getHTMLButton(false, "Modifier", "profile_animal.php?id=$animalId", "12px", "25px", "18px")}
                        <form action='trmt/delete_meeting_trmt.php' method='post' name='delete_meeting_{$rdv->getMeetingId()}' style='margin: 0; padding: 0;'>
                            <input type='text' name='meetingId' value='{$rdv->getMeetingId()}' hidden>
                            {$webPage->getHTMLButton(true, "Supprimer", "", "12px", "25px", "18px")}
                        </form>
                    </div>-->
                  </div>";
    }
    $rdvHTML = <<< HTML
        <div class="rdv">
            <div class="rdv-head">
                <span>Date</span>
                <span></span>           
                <span></span>  
            </div>
            $rdvs
        </div>

    HTML;
}


$html= <<< HTML
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

$webPage->appendContent(<<<HTML
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-center">
            <h1 class="title pb-2" style="font-weight: bold;">{$webPage->getIcon('cat', 35)}Le profil de {$animal->getName()}</h1>
        </div>
            $html
        <div class="d-flex flex-column justify-content-center align-items-center pt-5">
            <h1 class="title">Prochain Rendez-Vous</h1>
            $rdvHTML
        </div>
    </div>
HTML);
echo $webPage->toHTML();