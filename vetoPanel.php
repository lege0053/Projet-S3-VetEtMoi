<?php
declare(strict_types=1);

include_once "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected())
    header('Location: connexion.php');
$user = $auth->getUser();
if(!$user->isVeto())
    header('Location: profile.php');

$webPage = new WebPage("Panel Vétérinaire");



echo $webPage->toHTML();
