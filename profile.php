<?php
declare(strict_types=1);
include "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");
$user = $auth->getUser();

$webPage = new WebPage("Profil");
$logoutButton = WebPage::getHTMLButton(true, "Se déconnecter");
$webPage->appendContent(<<<HTML
    <form action="trmt/logout.php" method="post">
        <input name="logout" hidden>
       $logoutButton 
    </form>
    <div class="d-flex" style="justify-content: center;">
        <img src="img/animal/cat1.png" height="400">
        {$user->getHTMLProfile()}
    </div>
HTML);

echo $webPage->toHTML();