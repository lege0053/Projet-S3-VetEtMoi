<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Boutique");
$webPage->appendToHead(<<< HTML
    <style>
        body {
            background-image: url("img/bg_simple.png");
            background-color: #f5f5f5;
            background-size: 99%;
            background-repeat: no-repeat;
        }
    </style>
    HTML);

echo $webPage->toHTML();