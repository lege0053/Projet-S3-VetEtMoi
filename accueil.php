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
<div class="d-flex justify-content-center">
    <a href="#" class="btn m-1" style="font-weight: bold;background-color: #C20D0D; color: #FFFFFF">En ligne</a>
    <button type="button" class="btn m-1" style="font-weight: bold;background-color: #C20D0D; color: #FFFFFF">03 25 56 35 96</button>
</div>
<div class="d-inline-flex flex-column align-items-center mt-5 ml-5 pl-5">
    <h2>Bienvenue sur le site de la clinique Vet&Moi !</h2>
    <h5>Prenez rendez-vous n'importe quand</h5>
    <a href="#" class="btn m-1" style="font-weight: bold;background-color: #02897A; color: #FFFFFF">Prenez rendez-vous</a>
</div>

HTML;

$webPage->appendContent($html);
echo $webPage->toHTML();