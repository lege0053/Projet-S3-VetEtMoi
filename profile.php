<?php
declare(strict_types=1);
include "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");
$user = $auth->getUser();

$webPage = new WebPage("Profil");
$webPage->appendContent(<<<HTML
    <div class="d-flex flex-column">
        <div class="d-flex" style="justify-content: center; align-items: center; padding-bottom: 80px;">
            <img src="img/animal/cat1.png" height="400">
            {$user->getHTMLProfile()}
        </div>
        <div class="d-flex flex-column pt-5" style="height: 600px; background-color: #E3E3E3;">
            <h1 class="d-flex align-self-center"><b>Prochain Rendez-Vous</b></h1>
        </div>
    </div>
HTML);

echo $webPage->toHTML();