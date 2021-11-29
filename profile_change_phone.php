<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Changement d'adresse");

$form = <<<HTML
<div class="d-flex flex-row justify-content-center mb-5">
    <img src="img/animal/parrot.png" height="250px" class="align-self-center mr-5"/>
    <div class="d-flex flex-column w-50 pt-2 pb-2 pr-5 pl-5" style="background-color: #DDDDDD; border-radius: 10px">
            <form action="trmt/change_phone.php" method="post">   
                <div class="d-flex pb-4 mt-2 justify-content-center">
                    <h2 style="font-weight: bold;">Modification de mon numéro de téléphone</h2>
                </div>                 
                <div class="form-group d-flex flex-column">
                    <div class="d-flex flex-row">
                        <div style="font-weight: bold;">Nouveau numéro de téléphone</div>
                    </div>
                    <input type="tel" name="num" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" class="pt-1 pb-1 pr-2 pl-2 rounded" style="outline: 0; border:0;background-color: #C9C9C9;" placeholder="Numéro" required>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group d-inline-flex mt-3">
                        {$webPage->getHTMLButton(true, "Modifier le numéro", "#")}
                    </div>
                </div>
            </form>
    </div>
</div>
HTML;

$webPage->appendContent($form);
echo $webPage->toHTML();