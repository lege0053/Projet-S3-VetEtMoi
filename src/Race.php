<?php declare(strict_types=1);

$value=$_GET['q'];

$req=MyPDO::getInstance()->prepare(<<<SQL
    SELECT *
    FROM Race
    WHERE speciesId=?
    SQL);

$req->execute([$value]);
echo json_encode($req->fetchAll());