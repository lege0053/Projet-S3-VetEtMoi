<?php
declare(strict_types=1);

require "autoload.php";

$auth = new SecureUserAuthentication();
if(!SecureUserAuthentication::isUserConnected()){
    header("Location: connexion.php");
}

$webPage = new WebPage("ChoixAnimal");
    
$stmt = MyPDO::getInstance()->prepare(
    <<<SQL
SELECT animalId as "id", name
FROM Animal
WHERE userId = ?;
SQL
);
$stmt->execute([$auth->getUser()->getUserId()]);
$rep = $stmt->fetchAll();
if ($rep){

    $webPage->appendContent(<<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;"><svg width="39" height="38" viewBox="0 0 39 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.9473 34.831H9.64259C8.47797 34.8315 7.33862 34.4915 6.36469 33.853C5.39077 33.2144 4.62477 32.305 4.16094 31.2367C3.6971 30.1685 3.55567 28.9879 3.75404 27.8403C3.95241 26.6927 4.48193 25.6282 5.27744 24.7776L7.08004 22.8438C7.95039 21.9111 8.42457 20.6769 8.40263 19.4014C8.38069 18.1259 7.86434 16.9088 6.96243 16.0066L5.1915 14.2357C4.9855 14.0224 4.87152 13.7367 4.87409 13.4402C4.87667 13.1437 4.9956 12.8601 5.20527 12.6504C5.41494 12.4407 5.69858 12.3218 5.99509 12.3192C6.2916 12.3166 6.57726 12.4306 6.79054 12.6366L8.55922 14.4076C9.87547 15.7243 10.6291 17.5007 10.6611 19.3622C10.6932 21.2237 10.0012 23.025 8.73111 24.3863L6.92851 26.3201C6.43553 26.8492 6.10765 27.5107 5.98507 28.2234C5.8625 28.9361 5.95055 29.6691 6.23844 30.3325C6.52633 30.9959 7.00153 31.5609 7.6058 31.9582C8.21007 32.3555 8.91714 32.5679 9.64032 32.5693H10.778C10.7735 32.1079 10.7757 31.5289 10.7961 30.8684C10.8549 29.1495 11.0449 26.8358 11.5877 24.5039C12.1305 22.1857 13.0397 19.7588 14.5958 17.8906C15.9822 16.226 17.8662 15.0295 20.3451 14.7513V8.11089C20.3474 5.38325 22.5616 3.16675 25.2915 3.16675C26.4405 3.16675 27.3723 4.10084 27.3723 5.25206V6.34448H30.0344C31.5271 6.34448 32.909 7.11573 33.6961 8.38456L34.68 9.9723C36.4011 12.752 34.5262 16.3142 31.3439 16.5426V31.3163C31.3439 33.2568 29.772 34.831 27.8314 34.831H26.5807V31.3163C26.581 30.5418 26.4287 29.7748 26.1325 29.0591C25.8363 28.3435 25.4021 27.6932 24.8545 27.1455C24.3069 26.5977 23.6568 26.1632 22.9413 25.8667C22.2258 25.5703 21.4589 25.4177 20.6844 25.4177H18.6986C18.3986 25.4177 18.111 25.5368 17.8989 25.7489C17.6868 25.961 17.5677 26.2486 17.5677 26.5485C17.5677 26.8485 17.6868 27.1361 17.8989 27.3482C18.111 27.5603 18.3986 27.6794 18.6986 27.6794H20.6844C22.6905 27.6794 24.319 29.3078 24.319 31.3163V34.831H11.9473Z" fill="#373737"/></svg>
Choisir le profil pour lequel vous voulez prendre un rendez-vous</h3>
</div>
<div class="d-flex flex-column">
HTML);

    foreach ($rep as $animal) {
    $webPage->appendContent(<<< HTML
<div class="d-flex flex-row justify-content-around pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px; width: 80%">
    <div>
        <img src="img/partChien.png" class="mx-auto w-25" alt="">
    </div>
    <div class="d-flex flex-column justify-content-start">
        <a style="color: #02897A; font-weight: bold;">Prochain rendez-vous
        <a style="color: #262626; font-weight: bold;">Mercredi 2 Octobre 2021
        <a style="color: #262626; font-weight: bold;">11:00
        <a style="color: #02897A; font-weight: bold;">Dernier rendez-vous
        <a style="color: #262626; font-weight: bold;">Jeudi 25 Octobre 2020
    </div>
    <div class='d-flex flex-column justify-content-center'>
        <a class='button' href='profile.php'>Info sur {$animal['name']}</a>
        <a class='button' href="prisederdv.php?id={$animal['id']}">Rendez-Vous</a>
    </div>
</div>

HTML);
}

$webPage->appendContent("</div>");

} else {
    $webPage->appendContent("<h3 style='font-weight: bold;'>Vous n'avez pas d'animaux enregistrer</h3>");
}


echo $webPage->toHTML();