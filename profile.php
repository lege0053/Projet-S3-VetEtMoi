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
    <h3>Bonjour, {$user->getLastName()} {$user->getFirstName()}</h3>
    <form action="trmt/logout.php" method="post">
        <input name="logout" hidden>
       $logoutButton 
    </form>
HTML);

echo $webPage->toHTML();