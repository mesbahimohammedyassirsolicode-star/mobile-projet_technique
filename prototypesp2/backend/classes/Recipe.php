<?php

class Recipe
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function getAll(): array
    {
        $data = file_get_contents($this->file);

        return json_decode($data, true);
    }

    public function add(string $titre, int $category_id): bool
    {
        $recipes = $this->getAll();

        if (count($recipes) > 0) {
        $ids = array_column($recipes, 'id');
        $maxId = max($ids);
        $newId = $maxId + 1;
    } else {
        $newId = 1;
    }

        $newRecipe = [
            "id" => $newId,
            "titre" => $titre,
            "category_id" => $category_id
        ];

        $recipes[] = $newRecipe;

        return file_put_contents(
            $this->file,
            json_encode($recipes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        ) !== false;
    }
     public function getByCategory(int $category_id): array
    {
        $recipes = $this->getAll();

        $result = [];

        foreach ($recipes as $recipe) {

            if ($recipe["category_id"] === $category_id) {
                $result[] = $recipe;
            }

        }

        return $result;
    }
}