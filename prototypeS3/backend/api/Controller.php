<?php
require_once __DIR__ . '/../classes/Gestionrecipe.php';
header("Content-Type: application/json");

class ControllerRecipes
{
public function listAll()
{
    $gestionrecipe = new Gestionrecipe();
    $recipes=$gestionrecipe->getALL();
    $result=[];
    foreach($recipes as $recipe)
        {
            $result[]=[
                "id"=>$recipe->getId(),
                "name"=>$recipe->getName(),
                "Description"=>$recipe->getDescription(),



            ];
        }
    echo json_encode($result);
}
public function creatRecipe()
{
    $jsondata=file_get_contents('php://input');
    $data=json_decode($jsondata,true);
    $gestionrecipe = new Gestionrecipe();
$recipe=new recipe($data('Description'),$data('name'),$data('id'));
$gestionrecipe->create($recipe);
echo json_encode($recipe);

}
}
$controller= new ControllerRecipes();
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $controller->creatRecipe();

}else{
    $controller->listAll();
}



?>