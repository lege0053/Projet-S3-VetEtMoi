<?php
declare(strict_types=1);
include "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");
$user = $auth->getUser();
$rdvList = $user->getMeetings();
$rdv = "<span>Vous n'avez aucun rendez-vous</span>";
if($rdvList){
    $rdvs = "";
    foreach($rdvList as $rdv){
        $rdvs .= "<tr>
                    <td>{$rdv->getDate()}</td>
                    <td>{$rdv->getAnimal()->getName()}</td>
                    <td></td>
                  </tr>";
    }
    $rdvHTML = <<< HTML
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Nom de l'animal</td>
                </tr>
            </thead>
            $rdvs
        </table>

    HTML;

}

$webPage = new WebPage("Profil");
$webPage->appendContent(<<<HTML
    <div class="d-flex flex-column">
        <div class="d-flex" style="justify-content: center; align-items: center; padding-bottom: 80px;">
            <img src="img/animal/cat1.png" height="400">
            {$user->getHTMLProfile()}
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h1 class="title">Prochain Rendez-Vous</h1>
            $rdv
        </div>
    </div>
HTML);

echo $webPage->toHTML();