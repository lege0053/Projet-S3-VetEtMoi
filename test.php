<?php
declare(strict_types=1);

include "src/WebPage.php";

$p = new WebPage("Test");

$content = <<<HTML
    {$p->getHTMLButton(false, "SIMPLE BUTTON", "https://google.fr/")}
    {$p->getHTMLInput("Titre", "text", "titre", "titre", "placeholder")}
HTML;

$p->appendContent($content);

echo $p->toHTML();