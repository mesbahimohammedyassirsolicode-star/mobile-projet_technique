<?php
class recipe {
    private int $id;
    private string $name;
    private string $description;
   

    public function __construct($name, $description ,int $id=0) {
       
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
     
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