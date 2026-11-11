<?php
require_once __DIR__ . '/../classes/recipe.php';

class RecipesDao
{
    private $datafile;
    public function __construct()
    {
        $this->datafile = __DIR__ . "/../data/data.json";
    }
    public function Readdata()
    {
        $data= file_get_contents($this->datafile);
        if($data===false){
            throw new RuntimeException('no such data');
        }
        $jsondata = json_decode($data, true);

        if (!is_array($jsondata)) {

            throw new RuntimeException("Invalid recipe data");

        }
        return $jsondata;
    }

    public function getALL()
    {
        $data=$this->Readdata();
        $recipes = [];
        foreach ($data as $item)
            {
        $recipes[] = new Recipe($item["id"], $item["name"], $item["description"]);

            }
            return $recipes;
    }

     public function create(Recipe $recipe)
    {
        $data = $this->Readdata();
        $id = count($data) + 1;

        $data[] = [
            "id" => $id,
            "name" => $recipe->getName(),
            "description" => $recipe->getDescription()
        ];
        $jsondata = json_encode($data, JSON_PRETTY_PRINT);
        if ($jsondata == false) {
            throw new RuntimeException("the data is not forma json");
        }
        if (file_put_contents($this->datafile, $jsondata) === false) {
            throw new RuntimeException("error in encoding ");
        };
    }
}













?>