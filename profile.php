<?php
declare(strict_types=1);
include "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");

$webPage = new WebPage("Profil");
setlocale(LC_ALL, 'fr_FR', 'French_France', 'French');
date_default_timezone_set('Europe/Paris');

$webPage->appendCss(<<<CSS
    .rdv-item{
        background-color: #C9C9C9;
        border-radius: 10px;
        padding: 0px 0px 0px 25px;
        margin: 10px;
        display: flex;
        justify-content: space-between;
        flex-grow: 1;
        align-items: center;
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
        flex-grow: 1;
    }
    .rdv{
        display: flex;
        flex-direction: column;
        width: 800px;
        background: #DDDDDD;
        margin: 0;
        padding: 0;
        border-radius: 20px;
    }
CSS
);

$user = $auth->getUser();
$rdvList = $user->getMeetings();
$rdvHTML = "<span>Vous n'avez aucun rendez-vous</span>";
if($rdvList){
    $rdvs = "";
    foreach($rdvList as $rdv){
        $animal = $rdv->getAnimal();
        $id = $animal->getAnimalId();
        $date = ucwords(utf8_encode(strftime("%A %d %b %Y - %H:%M", strtotime($rdv->getDateTime()))));
        $rdvs .= "<div class='rdv-item'>
                    <span>{$date}</span>
                    <span>{$animal->getName()}</span>
                    <div style='display: flex;'>
                        {$webPage->getHTMLButton(false, "Modifier", "profile_animal.php?id=$id", "12px", "25px", "18px")}
                        <form action='trmt/delete_meeting_trmt.php' method='post' name='delete_meeting_{$rdv->getMeetingId()}' style='margin: 0; padding: 0;'>
                            <input type='text' name='meetingId' value='{$rdv->getMeetingId()}' hidden>
                            {$webPage->getHTMLButton(true, "Supprimer", "", "12px", "25px", "18px")}
                        </form>
                    </div>
                  </div>";
    }
    $rdvHTML = <<< HTML
        <div class="rdv">
            <div class="rdv-head">
                <span>Date</span>
                <span>Nom de l'animal</span>
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