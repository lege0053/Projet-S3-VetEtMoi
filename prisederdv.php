<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}

$webPage = new WebPage("Prise de Rendez-Vous");

$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">Prendre Rendez-Vous : </h3>
</div>
HTML;

//Tableau de RDV

$webPage->appendContent($html);
echo $webPage->toHTML();