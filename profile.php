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
    <div style="background-color: #DDDDDD; border-radius: 10px">
        <div class="d-flex pb-4 justify-content-center">
            <h2 style="font-weight: bold;">Mon Profil</h2>
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
        </div>
HTML);

echo $webPage->toHTML();