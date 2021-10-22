<?php
declare(strict_types=1);

require "autoload.php";

$webPage = new WebPage("Conseils");

echo $webPage->toHTML();