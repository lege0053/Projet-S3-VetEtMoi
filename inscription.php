<?php
declare(strict_types=1);

require "autoload.php";
init_php_session();

$webPage = new WebPage("Inscription");
$webPage->appendContent(getHeader());
$webPage->appendCssUrl("css/css.css");

$form = <<<HTML
<div class="d-flex flex-row justify-content-center margin-topbottom-art">
    <div class="d-flex flex-column main-background padding-button border-radius-5">
        <div class="login-form">
            <form action="trmt/inscription_trmt.php" method="post" class="padding-button">
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group d-inline-flex">
                        <h2 class="form-title white-text-color">Inscription</h2>
                    </div>
                </div> 
                <div class="form-group d-flex flex-column">
                     <div class="white-text-color">Identifiant</div>
                     <input type="text" name="id" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                </div>
                <div class="d-flex flex-row">
                    <div class="form-group d-flex flex-column margin-right">
                        <div class="white-text-color">Nom</div>
                        <input type="text" name="nom" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                    </div>
                    <div class="form-group d-flex flex-column">
                        <div class="white-text-color">Prénom</div>
                        <input type="text" name="prenom" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                    </div>
                </div>
                <div class="form-group d-flex flex-column">
                     <div class="white-text-color">Adresse Mail</div>
                     <input type="email" name="mail" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                </div>
                <div class="form-group d-flex flex-column">
                     <div class="white-text-color">Répétez Votre Adresse Mail</div>
                     <input type="email" name="repeat_mail" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="white-text-color">Mot de passe</div>
                    <input type="password" name="mdp" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="white-text-color">Répétez Votre Mot de passe</div>
                    <input type="password" name="repeat_mdp" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="white-text-color">Numéro de Téléphone</div>
                    <input type="password" name="tel" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <input type="checkbox" name="conditions_utilisations" class="p-2 button-no-outline no-decoration white-text-color second-main-background border-radius-5" style="outline: 0; border:0;" required>
                    <label for="conditions_utilisations">Accepter les <a href="#">conditions d'utilisations</a></label>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group d-inline-flex">
                        <button type="submit" class="form_submit font-size-15 main-color-background dark-text border-radius-5 padding-button font-weight-bold button " style="outline: 0; border:0;">S'inscrire</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
HTML;


$webPage->appendContent($form);
$webPage->appendContent(getFooter());

echo $webPage->toHTML();