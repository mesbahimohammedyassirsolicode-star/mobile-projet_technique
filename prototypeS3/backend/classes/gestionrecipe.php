<?php 
require_once 'recipe.php';
class Gestionrecipe
{
    public static $datafile=__DIR__ .'/../data/data.json';

    public function getALL(){
    $jsondata=file_get_contents(self::$datafile);
    $data=json_decode($jsondata,true);
    $recipes=[];
        foreach($data as $item){
            $recipe= new recipe($item('id'),$item('name'),$item('description'));
            $recipes[]=$recipe;
        }
        return $recipes;
    }

    public function create(recipe $recipes)
    {
    $jsondata=file_get_contents(self::$datafile);
    $data=json_decode($jsondata,true);
    $id=count($data)+1;
    $data[]=[
        "id"=>$recipes->getId(),
        "name"=>$recipes->getName(),
        "description"=>$recipes->getDescription()

    ];

    $jsondata=json_encode($data,JSON_PRETTY_PRINT);
    file_put_contents(self::$datafile,$data);
    }
}







?>