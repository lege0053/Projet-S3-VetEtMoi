<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("ChoixAnimal");
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
    {$webPage->getIcon('cat', 38)}
    <h3 style="font-weight: bold;">Mes Formidables Animaux</h3>
</div>
<div class="d-flex flex-column">
HTML);

    foreach ($rep as $animal) {
    $webPage->appendContent(<<< HTML
<div class="d-flex justify-content-center flex-row">
    <div class="container row p-3 m-3 w-50" style="background-color: #DDDDDD; border-radius: 20px;">
        <img src="img/partChien.png" alt="" style="height: 250px; margin-right: 15px;">
        <div class="d-flex flex-column justify-content-center" style="margin-right: 50px;">
            <a style="color: #02897A; font-weight: bold;">Prochain rendez-vous
            <a style="color: #262626; font-weight: bold;">Mercredi 2 Octobre 2021
            <a style="color: #262626; font-weight: bold; margin-bottom: 10px;">11:00
            <a style="color: #02897A; font-weight: bold;">Dernier rendez-vous
            <a style="color: #262626; font-weight: bold;">Jeudi 25 Octobre 2020
            <a style="color: #262626; font-weight: bold;">11:00
        </div>
        <div class='d-flex flex-column justify-content-center'>
            <a class='button p-2 m-1' href='#'>Info sur {$animal['name']}</a>
            <a class='button justify-content-cente p-2 m-1' href="#">Rendez-Vous</a>
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