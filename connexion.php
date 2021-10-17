<?php
declare(strict_types=1);

require "autoload.php";

$userAuth = new SecureUserAuthentication();

if(AbstractUserAuthentication::isUserConnected()) {
    header("Location: profile.php");
}
else {
    $webPage = new WebPage("Connexion");
    $webPage->appendToHead(<<< HTML
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    HTML);
    $webPage->appendContent($userAuth->loginForm('trmt/connexion_trmt.php'));
    echo $webPage->toHTML();
}