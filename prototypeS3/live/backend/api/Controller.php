<?php
require_once __DIR__ . "/../classes/gestionrecipe.php";
header("Content:Type applictaion/json");
class ControllerRecipe
{
    public function listall()
    {
    $gestionrecipe=new gestionrecipe();
    $recipes=$gestionrecipe->getALL();
    $result=[];
    foreach($recipes as $recipe)
        {
            $result[]=[
            "id"=>$recipe->getid(),
            "name"=>$recipe->getName(),
            "description"=>$recipe->getDescription()
            ];
        }
        echo json_encode($result);

    }
    public function createRecipe()
    {
            $jsondata=file_get_contents("php://input");
            $data=json_decode($jsondata,true);
            $gestionrecipe=new gestionrecipe();
            $recipe=new recipe($data['name'],$data['description']);
            $gestionrecipe->create($recipe);
            echo json_encode($recipe);
    }
    
}
    $controller= new ControllerRecipe();

    if($_SERVER['REQUEST_METHOD']==="POST")
        {
            $controller->createRecipe();
        }else{
        $controller=$controller->listall();

        }








?>