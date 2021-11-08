<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("AjouterAnimal");


$form = <<<HTML
<div class="d-flex flex-row justify-content-center mb-5">
    <img src="img/animal/cat1.png" height="250px" class="align-self-center mr-5"/>
    <div class="d-flex flex-column pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
            <form action="trmt/ajouterAnimal_trmt.php" method="post" onsubmit="hash512();">
                <div class="d-flex pb-4 justify-content-center">
                    <h2 style="font-weight: bold;">Ajout d'un animal</h2>
                </div>                 
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getIcon("cat")}
                        <div style="font-weight: bold;">Nom</div>
                    </div>
                    <input type="text" id="nom" name="nom" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Nom" required>
                </div>
                    
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getIcon("cat")}
                        <div style="font-weight: bold;">Date de naissance</div>
                    </div>
                    <input type="date" id="birth" name="birth" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Date de naissance" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div style="font-weight: bold;" class="d-flex flex-row">
                        {$webPage->getIcon("cat")}
                        <div style="font-weight: bold;">Race</div>
                    </div>
                    <input type="text" id="race" name="race" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Race" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        {$webPage->getIcon("cat")}
                        <div style="font-weight: bold;">Commentaire</div>
                    </div>
                    <input type="text" id="comment" name="comment" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Commentaire">
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group d-inline-flex">
                        {$webPage->getHTMLButton(true, "Ajouter")}
                    </div>
                </div>
            </form>
    </div>
</div>
HTML;

$webPage->appendContent($form);
echo $webPage->toHTML();