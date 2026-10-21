<?php
class recipe
{
    private int $id;
    private  string $nom;
    private string $categorie;

    public function __construct(int $id,string $nom,string $categorie)
    {
        $this->id=$id;
        $this->nom=$nom;
        $this->categorie=$categorie;
    }

    public function getid()
    {
        return $this->id;

    }
    public function getnom()
    {
        return $this->nom;
    }
    public function getcategorie()
    {
        return $this->categorie;
    }



}







?>