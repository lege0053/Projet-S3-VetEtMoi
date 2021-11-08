<?php
declare(strict_types=1);

require "autoload.php";

if(isset($_POST['nom'], $_POST['birth'], $_POST['race'], $_POST['comment'])
    && !empty($_POST['nom']) && !empty($_POST['birth']) && !empty($_POST['race']) && !empty($_POST['comment'])) {

    $nom = WebPage::escapeString($_POST['nom']);
    $birth = WebPage::escapeString($_POST['birth']);
    $race = WebPage::escapeString($_POST['race']);
    $comment = WebPage::escapeString($_POST['comment']);

}