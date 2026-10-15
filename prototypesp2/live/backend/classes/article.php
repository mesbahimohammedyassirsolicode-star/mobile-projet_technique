<?php
class article
{
    private string $id;
    private string $name;
    private string $color;
    private string $icon;
public function __construct($id,$name,$color,$icon)
{
    $this->id=$id;
    $this->name=$name;
    $this->color=$color;
    $this->icon=$icon;
}    
public function getid()
{
return $this->id;
}
public function getname()
{
    return $this->name;

}
public function getcolor()
{
    return $this->color;
}
public function geticon()
{
    return $this->icon;
}



}






?>