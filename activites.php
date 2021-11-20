<?php
declare(strict_types=1);
require "autoload.php";
$webPage = new WebPage("Activités");

$html = <<<HTML
<div class="d-flex flex-column">
    <div class="d-flex flex-row justify-content-center mb-2">
        <h2 style="padding-bottom: 20px;text-align: center">Découvrez Nos Activités !</h2>
    </div>
   <br> 
    <div class="d-flex flex-wrap justify-content-center">
        {$webPage->getActivite("medecine", "#02897A", true)}
        {$webPage->getActivite("chirurgie", "#E3E3E3", false)}
        {$webPage->getActivite("dentiserie", "#02897A", false)}
        {$webPage->getActivite("analyses Biologiques", "#E3E3E3", true)}
        {$webPage->getActivite("imagerie Medicale", "#02897A", false)}
        {$webPage->getActivite("NAC", "#E3E3E3", false)}
        {$webPage->getActivite("hospitalisation", "#02897A", true)}
        {$webPage->getActivite("nutrition", "#E3E3E3", false)}
        {$webPage->getActivite("reproduction", "#02897A", true)}
        {$webPage->getActivite("pharmacie", "#E3E3E3", true)}
        {$webPage->getActivite("urgences", "#02897A", false)}
    </div>
</div>
HTML;
$webPage->appendContent($html);
echo $webPage->toHTML();