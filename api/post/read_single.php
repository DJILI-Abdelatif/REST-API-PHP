<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");

    include_once '../../config/database.php';
    include_once '../../models/post.php';

    // instantiate DB & connect
    $db = new Database();
    $connect = $db->connect();

    // instantiate post object
    $post = new Post($connect);

    // get ID
    $post->id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : die();

    $post->read_single();

    // creat array
    $post_arr = [
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'auther' => $post->auther,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name,
    ];

    print_r(json_encode($post_arr));

?>