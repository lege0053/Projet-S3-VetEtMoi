<?php
declare(strict_types=1);

require_once "autoload.php";

$p = new WebPage("Test");

$content = <<<HTML
    {$p->getHTMLInput("Titre", "text", "titre", "titre", "placeholder")}
    {$p->getHTMLButton(false, "SIMPLE BUTTON", "https://google.fr/")}
<div class="d-flex justify-content-center">
    <img src="img/svg/background-accueil.svg" style="position: absolute; z-index: -1;">
    <div class="d-flex flex-column text-center" style="margin-top: 350px;">
        <h1 style="font-weight: bold; color: white; font-size: 64px; margin-bottom: 80px;">Espace</h1>
        <div class="d-flex flex-row mt-3">
            <a href="#">{$p->getImgCarre("dog", "Chiens")}</a> 
            <a href="#">{$p->getImgCarre("cat", "Chat")}</a>
            <a href="#">{$p->getImgCarre("nac", "NAC")}</a>
        </div>
    </div>
</div>
HTML;

$p->appendContent($content);

echo $p->toHTML();