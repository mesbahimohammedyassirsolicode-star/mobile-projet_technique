<?php
require_once 'recipe.php';

class gestionrecipe
{
public static string $datafile=__DIR__ ."/../data/data.json";

public function getALL()
{
    $jsondata=file_get_contents(self::$datafile);
    $data=json_decode($jsondata,true);
    $recipes=[];
    foreach($data as $item)
        {
            $recipe= new recipe($item['name'],$item['description'],$item['id']);
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
        "id"=>$id,
        "name"=>$recipes->getName(),
        "description"=>$recipes->getDescription()
            ];

    
$jsondata=json_encode($data,JSON_PRETTY_PRINT);
file_put_contents(self::$datafile,$jsondata);
}

}







?>