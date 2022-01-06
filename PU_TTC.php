<?php declare(strict_types=1);
require_once "autoload.php";

try {
    if (isset($_GET['q'])) {
        /**
        if (isset($_GET['wait'])) {
            usleep(rand(0, 20) * 100000);
        }
        **/
        $acteOuProduitSelect = (new ActeOuProduit)->createFromId(intval($_GET['q']));
        // En-tete HTTP pour signifier au navigateur client que la réponse est du JSON
        header('Content-Type: application/json');
        echo json_encode($acteOuProduitSelect->getPU_TTC(), JSON_PRETTY_PRINT /* Uniquement pour la présentation dans le sujet */);
    }
}
catch (Exception $e) {
}