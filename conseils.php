<?php
declare(strict_types=1);
require "autoload.php";
$webPage = new WebPage("Conseils");

$html= <<< HTML
<div>
    <div class="d-flex justify-content-center">
        <div class="d-flex flex-column align-items-center pt-5 mr-5">
            <h2 style="font-weight: bold;">Conseil pour la santé de votre chat</h2>
            <br>
            <p style="font-weight: bold;">Dans cette rubrique, vous trouverez des renseignements 
            sur les différents soins à apporter à votre animal, ainsi que différents conseils pour prendre soins d’eux. 
            Cet espace est accessible à tous les propriétaires, n’hésitez pas à partager.</p>
        </div>
        <img src="img/animal/cat2.png" class="ml-5" style="max-width:26%;" alt="">
    </div>
</div>

<div>
    <div class="d-flex justify-content-center">
        <img src="img/animal/cat2.png" class="ml-5" style="max-width:26%;" alt="">
        <div class="d-flex flex-column align-items-center pt-5 mr-5">
            <h2 style="font-weight: bold;">Conseil pour la santé de votre chat</h2>
            <br>
            <p style="font-weight: bold;">Dans cette rubrique, vous trouverez des renseignements 
            sur les différents soins à apporter à votre animal, ainsi que différents conseils pour prendre soins d’eux. 
            Cet espace est accessible à tous les propriétaires, n’hésitez pas à partager.</p>
        </div>
    </div>
</div>
HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();