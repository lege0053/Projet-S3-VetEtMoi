<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Mes Animaux");
$auth = new SecureUserAuthentication();
setlocale(LC_ALL, 'fr_FR', 'French_France', 'French');
date_default_timezone_set('Europe/Paris');

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
        $animal = Animal::createFromId($animal['animalId']);
        //Dernier rendez-voys
        try {
            $lastDate = $animal->getLastMeeting();
        } catch (exception $e){
            $lastDate = "Aucun rendez-vous";
        }
        //Prochain rendez-vous
        try {
            $nextDate = $animal->getNextMeeting();
        } catch (exception $e) {
            $nextDate = "Aucun rendez-vous";
        }
        /**On affiche l'animal**/
        $webPage->appendContent(<<< HTML
<style>
.buttonLstAnimals{
    font-weight: bold;
    letter-spacing: 0.02em;
    background-color: #02897A;
    color: white;
    border-radius: 10px;
    transition: 0.2s background-color ease-in-out;
    padding: 13px; 
    width: 100%;
    border:none;
}

.buttonLstAnimals:hover {
    background-color: #055945;
}
</style>
<div class="d-flex flex-row justify-content-center">
    <div class="d-flex justify-content-space-between row w-50 p-3" style="background-color: #DDDDDD;border-radius: 15px;">
        <div class="d-flex flex-row">
            {$webPage->getImgCarre("{$animal->getSpecieName()}", $animal->getName(), 200)}
            <div class="d-flex flex-column justify-content-center" style="margin-left: 15px;">
                <a style="color: #02897A; font-weight: bold;">Prochain rendez-vous
                <a style="color: #262626; font-weight: bold;margin-bottom: 10px;">$nextDate
                <a style="color: #02897A; font-weight: bold;">Dernier rendez-vous
                <a style="color: #262626; font-weight: bold;">$lastDate
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center" style="width: 30%;">
            <a class='button' style="display: flex; justify-content: center; padding: 13px;margin-bottom: 10px;" href="profile_animal.php?id={$animal->getAnimalId()}">Info sur {$animal->getName()}</a>
            <form action="prisederdv.php" method="post">
                <button class="buttonLstAnimals" type="submit" name="animal" value="{$animal->getAnimalId()}">Rendez-vous</button>
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
        <a href="prisederdv.php" class="btn m-1 mb-5" style="font-weight: bold;background-color: #02897A; color: #FFFFFF">Prenez rendez-vous</a>
    </div>
    <img src="img/animal/diversAnimals.png" width="700" alt="">
</div>
HTML);
}


echo $webPage->toHTML();