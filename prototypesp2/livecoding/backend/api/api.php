<?php 
require_once '../classess/recipe.php';
header('content-type: application/json;');

$recipes= new recipe( '../data/catagory.json');



if($_SERVER['REQUEST_METHOD' ] === 'GET'){

    echo json_encode($recipes->getALL());
exit;
}

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $data=json_decode(file_get_contents('php://input'),true);
    $titre=trim($data['titre']);
    $id_category=$data['category_id'];
    $recipes->add($titre,$id_category);
}







?>