<?php
declare(strict_types=1);

spl_autoload_register(function ($class_name) {
    include 'src/' . $class_name . '.php';
});

