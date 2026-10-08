<?php
class recipe
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file= $file;
    }
    public function getALL(): array
    {

        $data=file_get_contents($this->file);
        $content=json_decode($data,true);
        return is_array($content) ? $content:[];

    }
    public function add(string $titre,   $id_category){
    $recipes=$this->getALL();
    $id=array_column($recipes,'id');
    $newid=count($id) >0 ? max($id) +1:1;
    $recipes[]=[

        'id'=>$newid,
        'titre'=>$titre,
        'id_category'=>$id_category
    ];
     file_put_contents(

    $this->file,
        json_encode($recipes ,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)


    );
    echo   json_encode($recipes ,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

}













?>