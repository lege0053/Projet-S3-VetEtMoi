<?php
declare(strict_types=1);

require "autoload.php";
Session::start();

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

$rqt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT SHA2(lastName, 512) FROM Users
    WHERE email = "bob";
SQL);
$rqt->execute();
$a = $rqt->fetch();
var_dump($a);

echo $webPage->toHTML();