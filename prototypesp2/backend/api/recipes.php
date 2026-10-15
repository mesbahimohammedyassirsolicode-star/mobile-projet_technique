<?php
require_once __DIR__ . '/../classes/Recipe.php';
header('Content-Type: application/json; charset=utf-8');
$recipes = new Recipe(__DIR__ . '/../data/recipes.json');



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($recipes->getAll(), JSON_UNESCAPED_UNICODE);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $titre = trim($data['titre'] ?? '');
    $categoryId = filter_var($data['category_id'] ?? null, FILTER_VALIDATE_INT);

   

    if ($recipes->add($titre, $categoryId)) {
        echo json_encode([
            'success' => true,
            'message' => 'Recipe ajoutée avec succès'
        ], JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Impossible d’enregistrer la recette.'], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

http_response_code(405);
header('Allow: GET, POST');
echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.'], JSON_UNESCAPED_UNICODE);
