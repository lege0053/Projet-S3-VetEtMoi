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

$content = <<<HTML

    <div style="width: 100%; display: flex; justify-content: center;">
    <div class="main-ui-class">
            <span class="title">Panel Vétérinaire</span>
            
    </div>
        
    </div>

HTML;

$webPage->appendContent($content);



echo $webPage->toHTML();
