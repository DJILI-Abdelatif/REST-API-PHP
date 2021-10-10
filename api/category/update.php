<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");

    include_once '../../config/database.php';
    include_once '../../models/category.php';

    // instantiate DB & connect
    $db = new Database();
    $connect = $db->connect();

    // instatiate category object
    $category = new Category($connect);

    // get data modifid
    $data = json_decode(file_get_contents('../../category.json'));

    // set attributes
    $category->id = $data->id;
    $category->name = $data->name;
    $category->created_at = $data->created_at;

    if($category->update()) {
        echo json_encode([
            'message' => 'Item Updated'
        ]);
    } else {
        echo json_encode([
            'message' => 'Item Not Updated'
        ]);
    }

?>