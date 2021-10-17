<?php
declare(strict_types=1);

require "autoload.php";
Session::start();

$webPage = new WebPage("Boutique");

echo $webPage->toHTML();