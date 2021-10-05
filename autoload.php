<?php
spl_autoload_register(function ($class_name) {
    if(file_exists("src/$class_name.php")) {
        require_once 'src/'.$class_name . '.php';
    }
    else {
        echo "Fichier introubable.";
    }

});