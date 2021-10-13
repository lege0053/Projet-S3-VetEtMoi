<?php
declare(strict_types=1);

require "autoload.php";
Session::start();

$webPage = new WebPage("Connexion");
$webPage->appendToHead(<<< HTML
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    HTML);

$form = <<<HTML
<div class="d-flex flex-row justify-content-center mb-5">
    <img src="img/peroquet.png" height="250px" class="align-self-center mr-5"/>
    <div class="d-flex flex-column w-50 pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
            <form action="trmt/connexion_trmt.php" method="post">   
                <div class="d-flex pb-4 mt-2 justify-content-center">
                    <h2 style="font-weight: bold;">Modification de mon Adresse</h2>
                </div>                 
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                       
                        <div style="font-weight: bold;">Code postale</div>
                    </div>
                    <input type="texte" name="CP" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Code postale" required>
                </div>
                <div class="form-group d-flex flex-column">
                    <div style="font-weight: bold;" class="d-flex flex-row">
                        
                        <div>Ville</div>
                    </div>
                    <input type="text" name="ville" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Ville" required>
                </div>

                <div class="form-group d-flex flex-column">
                    <div style="font-weight: bold;" class="d-flex flex-row">
                        
                        <div>Numéro et Rue </div>
                    </div>
                    <input type="text" name="adress" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Numero et Rue" required>
        
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group d-inline-flex mt-3">
                        {$webPage->getHTMLButton(true, "Modifier l'Adresse", "#")}
                    </div>
                </div>
            </form>
    </div>
</div>
HTML;

$webPage->appendContent($form);
echo $webPage->toHTML();