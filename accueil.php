<?php
declare(strict_types=1);

require "autoload.php";
Session::start();

$webPage = new WebPage("Accueil");
$webPage->appendToHead(<<< HTML
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    HTML);

$html= <<< HTML
<div class="d-flex justify-content-center">
    <h3 style="font-weight: bold;">Une Urgence ?</h3>
</div>
<div class="d-flex justify-content-center mb-3">
    <a href="#" class="btn m-1" style="font-weight: bold;background-color: #C20D0D; color: #FFFFFF">En ligne</a>
    <button type="button" class="btn m-1" style="font-weight: bold;background-color: #C20D0D; color: #FFFFFF">03 25 56 35 96</button>
</div>
<div class="d-flex flex-row">
    <div class="d-flex flex-column align-items-center mt-5 ml-5 pl-5">
        <h2 style="font-weight: bold;">Bienvenue sur le site de la clinique Vet&Moi !</h2>
        <h4 style="font-weight: bold;">Prenez rendez-vous n'importe quand</h4>
        <a href="#" class="btn mt-2" style="font-weight: bold;background-color: #02897A; color: #FFFFFF">Prenez rendez-vous</a>
    </div>
    <img src="img/dog_cat.png" class="mx-auto w-25" alt="">
</div>

<div class="d-flex justify-content-center">
    <div class="d-flex flex-column text-center mt-5">
        <h1 style="font-weight: bold;">Espace</h1>
        <div class="d-flex flex-row mt-3">
            <a href="#"><img src="img/partChien.png" alt="" height="200"></a> 
            <a href="#"><img src="img/partCat.png" alt="" height="200"</a> 
            <a href="#"><img src="img/partNac.png" alt="" height="200"></a> 
        </div>
        <h4 style="font-weight: bold;">Vous voulez tout savoir sur votre animal ?</h4>
        <h6 style="font-weight: bold;">cliquez sur le type d’animal pour en apprendre plus !</h6>
        <div class="d-flex flex-column mt-5">
            <div class="d-flex flex-row">
                {$webPage->getSVGMiniLogo()}
                <h4 style="font-weight: bold; color: #055945; border-bottom: 8px solid #02897A;">Nos Derniers Conseils</h4>
            </div>
            <div class="d-flex flex-row mt-3">
                <a href="#"><img src="img/carre_gris.png" alt="" height="200" class="p-2"></a> 
                <a href="#"><img src="img/carre_gris.png" alt="" height="200" class="p-2"></a> 
                <a href="#"><img src="img/carre_gris.png" alt="" height="200" class="p-2"></a> 
            </div>
            <h4 style="font-weight: bold;">Voulez-vous tout savoir sur votre animal ?</h4>
            <h6 style="font-weight: bold;">cliquez sur le type d’animal pour en apprendre plus !</h6>
            <a href="./conseils.php" class="btn m-1 align-self-center mt-2" style="font-weight: bold;background-color: #02897A; color: #FFFFFF">Voir les autres conseils</a>
        </div>
        <div class="d-flex flex-column mt-5">
            <div class="d-flex flex-row">
                {$webPage->getSVGMiniLogo()}
                <h4 style="font-weight: bold; color: #055945; border-bottom: 8px solid #02897A;">Où sommes-nous situé ?</h4>
            </div>
        </div>
    </div>
</div>

HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();