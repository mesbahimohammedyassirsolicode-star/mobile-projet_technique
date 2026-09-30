<?php

$url = "http://localhost:8000/backend/api/api.php";

$data = [
    "titre" => "Pizza",
    "category_id" => 2
];

$options = [
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/json",
        "content" => json_encode($data)
    ]
];

$context = stream_context_create($options);

$response = file_get_contents($url, false, $context);

echo $response;