<?php
require_once __DIR__ . '/../Dao/RecipesDao.php';
require_once __DIR__ . '/../classes/recipe.php';

header('Content-Type: application/json; charset=utf-8');

class ControllerRecipes
{
    public function listAll()
    {
        $dao = new RecipesDao();
        $recipes = $dao->getALL();
        $result = [];
        foreach ($recipes as $recipe)
        {
            $result[] = [
                "id" => $recipe->getId(),
                "name" => $recipe->getName(),
                "description" => $recipe->getDescription(),
            ];
        }
        echo json_encode($result);
    }

    public function createRecipe()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!is_array($data) || empty(trim($data['name'] ?? '')) || empty(trim($data['description'] ?? ''))) {
            http_response_code(400);
            echo json_encode(["error" => "Name and description are required"]);
            return;
        }

        $recipe = new Recipe(0, trim($data['name']), trim($data['description']));
        $dao = new RecipesDao();
        $dao->create($recipe);

        http_response_code(201);
        echo json_encode(["message" => "Recipe created"]);
    }
}

try {
    $controller = new ControllerRecipes();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $controller->createRecipe();
    } elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
        $controller->listAll();
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
    }
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode(["error" => $exception->getMessage()]);
}
?>