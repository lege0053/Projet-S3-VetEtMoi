<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Mes Animaux");
$auth = new SecureUserAuthentication();

if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}
    
$animals = MyPDO::getInstance()->prepare(
    <<<SQL
SELECT * FROM Animal
WHERE userId = ?;
SQL
);
$animals->execute([$auth->getUser()->getUserId()]);
$rep = $animals->fetchAll();

if ($rep){
    $webPage->appendContent(<<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold; margin-top: 20px;">{$webPage->getIcon('cat', 38)}Mes Formidables Animaux</h3>
</div>

HTML);

    foreach ($rep as $animal) {
    $webPage->appendContent(<<< HTML
<div class="d-flex flex-row justify-content-center">
    <div class="d-flex justify-content-space-between row w-50 p-3" style="background-color: #DDDDDD;border-radius: 15px;">
        <img src="img/partChien.png" alt="" style="height: 200px;">
        <div class="d-flex flex-column justify-content-center">
            <a style="color: #02897A; font-weight: bold;">Prochain rendez-vous
            <a style="color: #262626; font-weight: bold;">Mercredi 2 Octobre 2021
            <a style="color: #262626; font-weight: bold; margin-bottom: 10px;">11:00
            <a style="color: #02897A; font-weight: bold;">Dernier rendez-vous
            <a style="color: #262626; font-weight: bold;">Jeudi 25 Octobre 2020
        </div>
        <div class='d-flex flex-column justify-content-center'>
            <a class='button m-1 p-2' href='#'>Info sur {$animal['name']}</a>
            <a class='button m-1 p-2' style="text-align: center" href="#">Rendez-Vous</a>
        </div>
    </div>
</div>
HTML);
}

$webPage->appendContent("</div>");

} else {
    $webPage->appendContent(<<< HTML
<div class="d-flex flex-column align-items-center">
    <br><br>
    <h3 style="font-weight: bold;">Vous n'avez pas d'animaux enregistrer !</h3>
</div>
HTML);
}


echo $webPage->toHTML();