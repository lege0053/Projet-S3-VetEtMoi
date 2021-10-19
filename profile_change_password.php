<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Changement de mot de passe");
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

$form = <<<HTML
<div class="d-flex flex-row justify-content-center mb-5">
    <img src="img/lapin.png" height="250px" class="align-self-center mr-5"/>
    <div class="d-flex flex-column w-50 pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
            <form action="trmt/connexion_trmt.php" method="post">   
                <div class="d-flex pb-4 mt-2 justify-content-center">
                {$webPage->getSVGMdp()}
                    <h2 style="font-weight: bold;">Modification du mot de passe </h2>
                </div>                 
                <div class="form-group d-flex flex-column">
                    <div style="font-weight: bold;" class="d-flex flex-row">
                        {$webPage->getSVGMdp()}
                        <div>Mot de passe Actuel</div>
                    </div>
                    <input type="password" name="mdp" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Nouveau Mot de Passe" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div style="font-weight: bold;" class="d-flex flex-row">
                        {$webPage->getSVGMdp()}
                        <div>Nouveau Mot de Passe</div>
                    </div>
                    <input type="password" name="mdp" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre mot de passe" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div style="font-weight: bold;" class="d-flex flex-row">
                        {$webPage->getSVGMdp()}
                        <div>Répéter le Nouveau Mot de Passe</div>
                    </div>
                    <input type="password" name="mdp" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Répéter le Nouveau Mot de Passe" required>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group d-inline-flex mt-3">
                        {$webPage->getHTMLButton(true, "Modifier le Mot de Passe", "#")}
                    </div>
                </div>
            </form>
    </div>
</div>
HTML;

$webPage->appendContent($form);
echo $webPage->toHTML();