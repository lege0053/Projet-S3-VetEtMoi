<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Changement de mot de passe");

$webPage->appendContent(<<<HTML
<div class="d-flex justify-content-center align-items-center" style="gap: 60px;">
    <div class="d-flex flex-column align-items-center" style="gap: 25px;">
        <img src="img/animal/bunny.png" height="300px" class="align-self-center"/>
        <div class="d-flex flex-column align-items-center">
            <span style="font-size: 28px;">La sécurité c'est important</span>
            <span style="font-size: 28px;">Surtout pour Parpint le Lapin</span>
        </div>
    </div>
        <form action="trmt/connexion_trmt.php" method="post" class="main-ui-class" style="gap: 38px;">   
            <span class="title d-flex align-items-center">{$webPage->getIcon("lock", 32)} Modification du Mot de Passe</span>              
            {$webPage->getHTMLInput("Ancien Mot de Passe", "password", "oldPassword", "oldPassword", "Ancien Mot de Passe", '', true, false, "lock")}
            {$webPage->getHTMLInput("Nouveau Mot de Passe", "password", "newPassword", "newPassword", "Nouveau Mot de Passe", '', true, false, "lock")}
            {$webPage->getHTMLInput("Répétez votre Nouveau Mot de Passe", "password", "newPasswordRepeat", "newPasswordRepeat", "Répétez votre Nouveau Mot de Passe", '', true, false, "lock")}
            <div class="d-flex flex-row justify-content-center">
                {$webPage->getHTMLButton(true, "Modifier le Mot de Passe", "trmt/change_password.php")}
            </div>
        </form>
</div>
HTML);
echo $webPage->toHTML();