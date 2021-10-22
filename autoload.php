<?php
declare(strict_types=1);

spl_autoload_register(function ($class_name) {
    include_once 'src/' . $class_name . '.php';
});

