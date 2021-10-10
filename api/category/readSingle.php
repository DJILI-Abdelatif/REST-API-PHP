<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/JSON");

    require_once '../../config/database.php';
    require_once '../../models/category.php';

    // instantiate DB & Connect
    $db = new Database();
    $connect = $db->connect();
    
    // instantiate category object
    $category = new Category($connect);

    // get the id
    $category->id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : die();

    if($category->readSingle()) {
        // create an array 
        $category_arr = [
            'id' => $category->id,
            'name' => $category->name,
            'created_at' => $category->created_at
        ];
        echo json_encode($category_arr);
    }

?>