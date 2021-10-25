<?php
declare(strict_types=1);

require "autoload.php";

$userAuth = new SecureUserAuthentication();

if(AbstractUserAuthentication::isUserConnected()) {
    header("Location: profile.php");
}
else {
    $webPage = new WebPage("Connexion");
    $webPage->appendContent($userAuth->loginForm('trmt/connexion_trmt.php'));
    echo $webPage->toHTML();
}