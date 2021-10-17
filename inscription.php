<?php
declare(strict_types=1);

require "autoload.php";
Session::start();

$webPage = new WebPage("Inscription");
$webPage->appendToHead(<<< HTML
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    HTML);

$webPage->appendJsUrl("js/sha512v2.js");
$webPage->appendJs(<<<JS
            function hash512() {
                document.getElementById('code').value = Sha512.hash(document.getElementById('password').value.toString());
            } 
JS);

$form = <<<HTML
<div class="d-flex flex-row justify-content-center mb-5">
    <img src="img/catInsciption.png" height="250px" class="align-self-center mr-5"/>
    <div class="d-flex flex-column pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
            <form action="trmt/inscription_trmt.php" method="post" onsubmit="hash512();">
                <div class="d-flex pb-4 justify-content-center">
                    <h2 style="font-weight: bold;">Inscription</h2>
                </div> 
                <div class="d-flex flex-row">
                    <div class="form-group d-flex flex-column">
                        <div class="d-flex flex-row">
                            {$webPage->getSVGPers()}
                            <div style="font-weight: bold;">Nom</div>
                        </div>
                        <input type="text" id="lastName" name="lastName" class="pt-1 pb-1 pr-2 pl-2 mr-3 rounded" style="outline: 0; border:0; background-color: #C9C9C9;" placeholder="Votre Nom" required>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <div class="d-flex flex-row">
                            {$webPage->getSVGPers()}
                            <div style="font-weight: bold;">Prénom</div>
                        </div>
                        <input type="text" id="firstName" name="firstName" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre Prénom" required>
                    </div>
                </div>                    
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getSVGMail()}
                        <div style="font-weight: bold;">Adresse Mail</div>
                    </div>
                    <input type="email" id="email" name="email" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre Adresse Mail" required>
                </div>
                    
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getSVGMail()}
                        <div style="font-weight: bold;">Répétez Votre Adresse Mail</div>
                    </div>
                    <input type="email" id="repeat_email" name="repeat_mail" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre Adresse Mail" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div style="font-weight: bold;" class="d-flex flex-row">
                        {$webPage->getSVGMdp()}
                        <div>Mot de passe</div>
                    </div>
                    <input type="password" id="password" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre mot de passe" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getSVGMdp()}
                        <div style="font-weight: bold;">Répétez Votre Mot de passe</div>
                    </div>
                    <input type="password" id="repeat_password" name="repeat_password" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre mot de passe" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getSVGTel()}
                        <div style="font-weight: bold;">Numéro de Téléphone</div>
                    </div>
                    <input type="tel" id="phone" name="phone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre numéro de Téléphone" required>
                </div>
                <div class="form-group custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="conditions_utilisations" required>
                       <label class="custom-control-label" style="font-weight: bold;" for = "conditions_utilisations">Accepter les <a href="#" style="text-decoration: none; color: #02897A">conditions d'utilisations</a></label>
                </div>
                <input type="text" id="code" name="code" hidden>
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group d-inline-flex">
                        {$webPage->getHTMLButton(true, "S'inscrire", "#")}
                    </div>
                </div>
            </form>
    </div>
</div>
HTML;

$webPage->appendContent($form);
echo $webPage->toHTML();