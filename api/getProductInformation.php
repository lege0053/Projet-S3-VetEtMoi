<?php declare(strict_types=1);
require_once "../src/MyPDO.php";

header('Content-Type: application/json');
if (isset($_GET['productName']) && !empty($_GET['productName'])) {
    $productName = $_GET['productName'];
    $req = MyPDO::getInstance()->prepare(<<<SQL
        SELECT * FROM ActeOuProduit
        WHERE name = :name
    SQL);
    $req->execute(['name' => $productName]);
    $array = $req->fetchAll();

    if($array)
        echo json_encode($array);
    else{
        echo json_encode(['error' => 'product_not_found']);
    }
} else {
    echo json_encode(['error' => 'lack_of_information']);
}