<?php
require_once __DIR__ . "/../dao/RecipesDao.php";
require_once __DIR__ . "/./BaseService.php";

class RecipeService extends BaseService
{
    private RecipesDao $dao;
    public function __construct(RecipesDao $RecipesDao)
    {
        $this->dao = $RecipesDao;
    }
    public function getAll(): array
    {
        return $this->dao->getAll();
    }
    public function create(Recipe $Recipe): void
    {
        $this->dao->create($Recipe);
    }
}