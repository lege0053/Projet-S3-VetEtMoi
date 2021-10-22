<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Boutique");

echo $webPage->toHTML();