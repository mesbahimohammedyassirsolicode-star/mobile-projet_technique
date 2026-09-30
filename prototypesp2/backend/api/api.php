<?php

require_once __DIR__ . '/../classes/Recipe.php';

header("Content-Type: application/json");

$recipe = new Recipe(__DIR__ . '/../database/categories.json');

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (isset($_GET["category_id"])) {

        $category_id = (int) $_GET["category_id"];

        $recipes = $recipe->getByCategory($category_id);

    } else {

        $recipes = $recipe->getAll();

    }

    echo json_encode(
        $recipes,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

}

elseif ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(
        file_get_contents("php://input"),
        true
    );

    if (!isset($data["titre"]) || !isset($data["category_id"])) {

        http_response_code(400);

        echo json_encode([
            "success" => false,
            "message" => "titre et category_id sont obligatoires"
        ]);

        exit;
    }

    $result = $recipe->add(
        $data["titre"],
        (int) $data["category_id"]
    );

    echo json_encode([
        "success" => $result
    ]);
}