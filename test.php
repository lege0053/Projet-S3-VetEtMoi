<?php
declare(strict_types=1);

include "src/WebPage.php";

$p = new WebPage("Test");

$content = <<<HTML
    {$p->getHTMLInput("Titre", "text", "titre", "titre", "placeholder")}
    {$p->getHTMLButton(false, "SIMPLE BUTTON", "https://google.fr/")}
HTML;

$p->appendContent($content);

echo $p->toHTML();