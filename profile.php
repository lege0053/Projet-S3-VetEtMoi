<?php
declare(strict_types=1);
include "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header("Location: connexion.php");

$user = $auth->getUser();

$webPage = new WebPage("Profil");
$webPage->appendContent(<<<HTML
    <h3>Bonjour, {$user->getLastName()} {$user->getFirstName()}</h3>
HTML);

echo $webPage->toHTML();