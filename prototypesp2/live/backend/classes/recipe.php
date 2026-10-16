<?php 
class recipe{
    private int  $id;
    private string $name;
    private string $categorie;


    public function __construct(int $id,string $name, string $categorie)
    {
        $this->id=$id;
        $this->name=$name;
        $this->categorie=$categorie;

    }

    public function getid(){
        return $this->id;
    }

    public function getname()
    {
        return $this->name;

    }
    public function getcategorie()
    {
        return $this->categorie;
    }







}








?>