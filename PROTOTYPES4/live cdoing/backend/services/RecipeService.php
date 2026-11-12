<?php
require_once __DIR__ . "/../Dao/RecipesDao.php";
require_once __DIR__ ."/./BaseService.php";
class RecipeService extends BaseService
{
    private RecipesDao $dao;
    public function __construct(RecipesDao $recipesDao)
    {
    $this->dao=$recipesDao;
    }
    public function getAll()
    {
        return $this->dao->getALL();
    }
    public function create (recipe $recipe): void{
        $this->dao->create($recipe);
    }
}











?>