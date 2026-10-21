<?php
require_once 'class.php';

class reciper
{
private string $file;


public function __construct(string $file)
{
    $this->file=$file;
}

public function getALL()
{
    $data=file_get_contents($this->file);
    $content=json_decode($data);

    return is_array($content) ? $content:[];
}

public function add($nom,$categorie)
{
$recipes=$this->getALL();
$ids=array_column($recipes,'id');
$newid=count($ids)>0 ? max($ids) +1:1;
$recipes[]=[

    'id'=>$newid,
    'nom'=>$nom,
    'categorie'=>$categorie

];
file_put_contents(
   $this->file,json_encode($recipes,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo json_encode($recipes,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

}







}












?>