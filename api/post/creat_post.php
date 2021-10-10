<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");
    header("Access-Control-Allow-Methods: POST");
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

    $post->title  = $data->title;
    $post->body   = $data->body;
    $post->auther = $data->auther;
    $post->category_id = $data->category_id;

    // create post 
    if($post->creat_post()) {
        echo json_encode(
            array('message' => 'Post Created')
        );
    } else {
        echo json_encode([
            'message' => 'Post Not Created'
        ]);
    }

?>