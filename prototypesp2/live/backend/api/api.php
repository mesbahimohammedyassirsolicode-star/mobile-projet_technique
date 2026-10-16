<?php
require_once __DIR__ . "/../classes/class.php";
header('Content-Type: application/json;');
$recipes = new reciper(__DIR__ . '/../data/data.json');



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($recipes->getALL());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'] ?? '';
    $categorie = $data['categorie'] ?? '';
    $recipes->add($name, $categorie);

   
}

?>
