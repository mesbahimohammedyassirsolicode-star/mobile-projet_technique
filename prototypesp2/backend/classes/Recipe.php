<?php

class Recipe
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    // Read recipes from the JSON file and return them as PHP arrays.
    public function getAll(): array
    {
        $content = file_get_contents($this->file);
        $recipes = json_decode($content ?: '[]', true);

        return is_array($recipes) ? $recipes : [];
    }

    // Add one recipe and automatically choose the next ID.
    public function add(string $titre, int $category_id)
    {
        $recipes = $this->getAll();
        $ids = array_column($recipes, 'id');
        $newId = count($ids) > 0 ? max($ids) + 1 : 1;

        $recipes[] = [
            'id' => $newId,
            'titre' => $titre,
            'category_id' => $category_id
        ];

        return file_put_contents(
            $this->file,
            json_encode($recipes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        ) !== false;
    }
}
