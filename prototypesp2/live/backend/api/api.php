<?php
require_once __DIR__ . '/../classes/recipe.php';
header('Content-type: application/json');

$recipe=new reciper(__DIR__ . '/../data/data.json');

if($_SERVER['REQUEST_METHOD']==='GET')
    {
        echo json_encode($recipe->getALL());
        exit;
    }



    if($_SERVER['REQUEST_METHOD']==='POST')
        {
        $data=json_decode(file_get_contents('php://input'),true);
        $nom=$data['nom'];
        $categorie=$data['categorie'];
        $recipe->add($nom,$categorie);


        }








?>