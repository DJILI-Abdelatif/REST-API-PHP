<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../models/post.php';

    // Instantiate DB & Connect
    $db = new Database();
    $connect = $db->connect();

    // Instantiate Post Object
    $post = new Post($connect);

    // get row posted data
    $data = json_decode(file_get_contents("../../input.json"));

    $post->id = $data->id;

    if($post->delete()) {
        echo json_encode([
            'message' => 'Post Deleted'
        ]);
    } else {
        echo json_encode([
            'message' => 'Post Not Deleted'
        ]);
    }
?>