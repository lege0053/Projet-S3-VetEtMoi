<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Mes Animaux");
$auth = new SecureUserAuthentication();

if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}

/**Recherche des animaux du client**/
$animals = MyPDO::getInstance()->prepare(
    <<<SQL
SELECT * FROM Animal
WHERE userId = ?;
SQL
);
$animals->execute([$auth->getUser()->getUserId()]);
$rep = $animals->fetchAll();

/**Si le client à au moins un animal**/
if ($rep){
    $webPage->appendContent(<<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold; margin-top: 20px;">{$webPage->getIcon('cat', 38)}Mes Formidables Animaux</h3>
</div>

HTML);

    /**Pour chaque animal du client**/
    foreach ($rep as $animal) {
        /**On affiche l'animal**/
        $webPage->appendContent(<<< HTML
<div class="d-flex flex-row justify-content-center">
    <div class="d-flex justify-content-space-between row w-50 p-3" style="background-color: #DDDDDD;border-radius: 15px;">
        {$webPage->getImgCarre("dog", $animal['name'], 200)}
        <div class="d-flex flex-column justify-content-center">
            <a style="color: #02897A; font-weight: bold;">Prochain rendez-vous
            <a style="color: #262626; font-weight: bold;">Mercredi 2 Octobre 2021
            <a style="color: #262626; font-weight: bold; margin-bottom: 10px;">11:00
            <a style="color: #02897A; font-weight: bold;">Dernier rendez-vous
            <a style="color: #262626; font-weight: bold;">Jeudi 25 Octobre 2020
        </div>
        
        <div class="d-flex flex-column" style="margin-top:25%;gap:25px;">
            <form action="profile_animal.php" method="post" style="display: flex; justify-content: center;">
                <input type="hidden" id="info" name="info"  value="{$animal['animalId']}">
                {$webPage->getHTMLButton(true, "Info sur {$animal['name']}", "profile_animal.php", "9px", "10px", "16px")}
            </form>
            <form action="#" method="post" style="display: flex; justify-content: center;">
                <input type="hidden" id="idAnimalForRdv" name="idAnimalForRdv"  value="{$animal['animalId']}">
                {$webPage->getHTMLButton(true, "Rendez-vous", "#", "9px", "10px", "16px")}
            </form>
        </div>
    </div>
</div>
HTML);
}

$webPage->appendContent("</div>");

} else {
    /**Si le client n'a pas d'animal**/
    $webPage->appendContent(<<< HTML
<div class="d-flex flex-row justify-content-space-around mt-5">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h3 style="font-weight: bold;align-self: center;">Vous n'avez pas d'animaux enregistrer...</h3>
        <p class="align-items-center">Venez nous présentez vos animaux directement en clinique pour qu'ils apparaissent !</p>
        <a href="listeAnimal.php" class="btn m-1 mb-5" style="font-weight: bold;background-color: #02897A; color: #FFFFFF">Prenez rendez-vous</a>
    </div>
    <img src="img/animal/diversAnimals.png" width="700" alt="">
</div>
HTML);
}


echo $webPage->toHTML();