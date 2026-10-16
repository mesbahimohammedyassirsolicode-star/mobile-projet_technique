
<?php

class reciper
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function getALL(): array
    {
        $data = file_get_contents($this->file);
        $content = json_decode($data, true);

        return is_array($content) ? $content : [];
    }

    public function add($name, $categories)
    {
        $recipes = $this->getALL();

        $ids = array_column($recipes, 'id');
        $newid = count($ids) > 0 ? max($ids) + 1 : 1;

        $recipes[] = [
            'id' => $newid,
            'name' => $name,
            'categorie' => $categories
        ];

        file_put_contents(
            $this->file,
            json_encode(
                $recipes,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );
        echo json_encode(  $recipes,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE  );
    }
}
?>
