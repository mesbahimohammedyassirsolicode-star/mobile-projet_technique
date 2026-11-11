<?php
class recipe {
    private int $id;
    private $name;
    private $description;
   

    public function __construct($name, $description ,int $id=0) {
       
        $this->name = $name;
        $this->description = $description;
         $this->id = $id;
     
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }
}
  









?>