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
    <style>
        body {
            background-image: url("img/bg_simple.png");
            background-color: #f5f5f5;
            background-size: 100%;
            background-repeat: no-repeat;
        }
    </style>
    HTML);
    $webPage->appendContent("<br><br><br><br>");
    $webPage->appendContent($userAuth->loginForm('trmt/connexion_trmt.php'));
    echo $webPage->toHTML();
}