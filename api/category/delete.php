<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../models/category.php';

    // Instantiate DB & Connect
    $db = new Database();
    $connect = $db->connect();

    // instantiate category object
    $category = new Category($connect);

    $data = json_decode(file_get_contents('../../category.json'));

    $category->id = $data->id;

    if($category->delete()) {
        echo json_encode([
            'message' => 'Item Deleted'
        ]);
    } else {
        echo json_encode([
            'message' => 'Item Not Deleted'
        ]);
    }