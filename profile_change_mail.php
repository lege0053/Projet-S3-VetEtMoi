<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Changement de mail");

$auth = new SecureUserAuthentication();
if($auth->isUserConnected()) {
        $user = $auth->getUser();

<<<<<<< HEAD
        $webPage->appendJsUrl("js/sha512.js");
        $webPage->appendJs(<<<JS
            function hash512() {
                let password = document.getElementById('password').value.toString();
                let newMail = document.getElementById('newMail').value.toString();
                let newMailRepeat = document.getElementById('newMailRepeat').value.toString();
            
                if(newMail != newMailRepeat){
                    document.querySelector("#err_same_mail").removeAttribute("hidden");
                    return false;
                }
                document.getElementsByName('password')[0].value = Sha512.hash(password);
                return true;
            }
        JS);

        $webPage->appendContent(<<<HTML
    <div class="d-flex justify-content-center align-items-center" style="gap: 60px;">
        <div class="d-flex flex-column align-items-center" style="gap: 25px;">
            <img src="img/animal/dog1.png" height="300px" class="align-self-center"/>
            <div class="d-flex flex-column align-items-center">
                <span style="font-size: 28px;">Avoir un mail à jour ça peut aider.</span>
                <span style="font-size: 28px;">Surtout pour Bobby</span>
            </div>
        </div>
            <form action="trmt/change_mail.php" method="post" class="main-ui-class" style="gap: 38px;" onsubmit="return hash512();">   
                <span class="title d-flex align-items-center">{$webPage->getIcon("mail", 32)} Modification de l'adresse mail</span>              
                {$webPage->getHTMLInput("Ancien Mail", "email", "", "", "Ancien Mail", $user->getEmail(), true, false, "mail", true)}
                {$webPage->getHTMLInput("Nouveau Mail", "email", "newMail", "newMail", "Nouveau Mail", '', true, false, "mail")}
                {$webPage->getHTMLInput("Répétez votre Nouveau Mail", "email", "newMailRepeat", "newMailRepeat", "Répétez votre Nouveau Mail", '', true, false, "mail")}
                {$webPage->getHTMLInput("Mot de Passe", "password", "", "password", "Mot de Passe", '', true, false, "lock")}
                <input type="text" id="passwordCode" name="password" value="" hidden>
                <span id="err_same_mail" style="color: #b00006; font-weight: bold;" hidden>Les 2 adresses mail sont différentes</span>
=======
$form = <<<HTML
<div class="d-flex flex-row justify-content-center mb-5">
    <img src="img/animal/dog1.png" height="250px" class="align-self-center mr-5"/>
    <div class="d-flex flex-column w-50 pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
            <form action="trmt/change_mail.php" method="post">   
                <div class="d-flex pb-4 mt-2 justify-content-center">
                    <div class="d-flex flex-row ">
                        {$webPage->getIcon("mail")}
                    </div>
                    <h2 style="font-weight: bold;">Modification de l'adresse mail</h2>
                </div>                 
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getIcon("mail")}
                        <div style="font-weight: bold;">Adresse mail actuelle</div>
                    </div>
                    <input type="email" name="oldMail" id="oldMail" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Votre Adresse mail actuelle" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getIcon("mail")}
                        <div style="font-weight: bold;">Nouvelle Adresse mail</div>
                    </div>
                    <input type="email" name="newMail" id="newMail" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Nouvelle Adresse mail" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getIcon("mail")}
                        <div style="font-weight: bold;">Répéter votre Nouvelle Adresse mail</div>
                    </div>
                    <input type="email" name="repeatNewMail" id="repeatNewMail" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Répéter votre Nouvelle Adresse mail" required>
                </div>
>>>>>>> 510808446538d4feacd80a6a2625e96261cf5a88
                <div class="d-flex flex-row justify-content-center">
                    {$webPage->getHTMLButton(true, "Modifier l'adresse mail")}
                </div>
            </form>
    </div>
    HTML
    );
    echo $webPage->toHTML();
}
else
    header('Location: connexion.php');