<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../models/Category.php';

        // Instantiate DB & Connect
        $db = new Database();
        $connect = $db->connect();
    
        // Instantiate category Object
        $category = new Category($connect);

        // get row of item category
        $data = json_decode(file_get_contents('../../category.json'));

        // set properties
        $category->name = $data->name;

        if($category->createCategory()) {
            echo json_encode([
                'message' => 'Item Inserted'
            ]);
        } else {
            echo json_encode([
                'message' => 'Item Not Inserted'
            ]);
        }

?>