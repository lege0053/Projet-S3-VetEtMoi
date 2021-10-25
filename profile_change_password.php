<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Changement de mot de passe");

$webPage->appendJsUrl("js/sha512.js");
$webPage->appendJs(<<<JS
    function hash512() {
    
        let oldPass = document.getElementById('oldPassword').value.toString();
        let newPass = document.getElementById('newPassword').value.toString();
        let newPassRepeat = document.getElementById('newPasswordRepeat').value.toString();
        
        if(newPass == newPassRepeat){
            document.getElementById('oldPasswordCode').value = Sha512.hash(oldPass);
            document.getElementById('newPasswordCode').value = Sha512.hash(newPass);
            document.getElementById('newPasswordRepeatCode').value = Sha512.hash(newPassRepeat);
            
            console.log(document.getElementById('newPasswordCode').value);
            console.log(document.getElementById('newPasswordCode').value);
            console.log(document.getElementById('newPasswordCode').value);
            
            return true;
        }else{
            document.querySelector("#err_same_pass").removeAttribute("hidden");
            return false;
        }
        
    
        
    }
JS);

$webPage->appendContent(<<<HTML
<div class="d-flex justify-content-center align-items-center" style="gap: 60px;">
    <div class="d-flex flex-column align-items-center" style="gap: 25px;">
        <img src="img/animal/bunny.png" height="300px" class="align-self-center"/>
        <div class="d-flex flex-column align-items-center">
            <span style="font-size: 28px;">La sécurité c'est important</span>
            <span style="font-size: 28px;">Surtout pour Parpint le Lapin</span>
        </div>
    </div>
        <form action="trmt/change_password.php" method="post" class="main-ui-class" style="gap: 38px;" onsubmit="return hash512();">   
            <span class="title d-flex align-items-center">{$webPage->getIcon("lock", 32)} Modification du Mot de Passe</span>              
            {$webPage->getHTMLInput("Ancien Mot de Passe", "password", "", "oldPassword", "Ancien Mot de Passe", '', true, false, "lock")}
            {$webPage->getHTMLInput("Nouveau Mot de Passe", "password", "", "newPassword", "Nouveau Mot de Passe", '', true, false, "lock")}
            {$webPage->getHTMLInput("Répétez votre Nouveau Mot de Passe", "password", "", "newPasswordRepeat", "Répétez votre Nouveau Mot de Passe", '', true, false, "lock")}
            <input type="text" id="oldPasswordCode" name="oldPassword" value="" hidden>
            <input type="text" id="newPasswordCode" name="newPassword" value="" hidden>
            <input type="text" id="newPasswordRepeatCode" name="newPasswordRepeat" value="" hidden>
            <span id="err_same_pass" style="color: #b00006; font-weight: bold;" hidden>Les 2 mots de passe sont différents</span>
            <div class="d-flex flex-row justify-content-center">
                {$webPage->getHTMLButton(true, "Modifier le Mot de Passe")}
            </div>
        </form>
</div>
HTML);
echo $webPage->toHTML();