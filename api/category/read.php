<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");

    include_once '../../config/database.php';
    include_once '../../models/category.php';

    // Instantiate DB & Connect
    $db = new Database();
    $connect = $db->connect();

    // Instantiate categgory Object
    $category = new Category($connect);

    // category query
    $result = $category->read();

    // num row
    $num = $result->rowCount();

    if($num > 0) {

        $category_arr = [];
        $category_arr['data'] = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $category_item = [
                'id' => $id,
                'name' => $name,
                'created_at' => $created_at
            ];

            // push to data
            array_push($category_arr['data'], $category_item);
        }

        echo json_encode($category_arr);

    } else {
        echo json_encode([
            'message' => 'No Categories'
        ]);
    }

?>