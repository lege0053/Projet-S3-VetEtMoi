<?php declare(strict_types=1);

require_once 'MyPDO.template.php';

MyPDO::setConfiguration('mysql:host=mysql;dbname=defaultNameBase;charset=utf8', 'bob', 'bob');
