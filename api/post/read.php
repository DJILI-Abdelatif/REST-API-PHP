<?php

    // Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json");

    include_once '../../config/database.php';
    include_once '../../models/post.php';

    // Instantiate DB & Connect
    $db = new Database();
    $connect = $db->connect();

    // Instantiate Post Object
    $post = new Post($connect);

    // POST Query
    $result = $post->read();

    // Get Row Count
    $num = $result->rowCount();

    // check if any post
    if($num > 0) {
        $post_arr = [];
        $post_arr['data'] = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $post_item = [
                'id'            => $id,
                'title'         => $title,
                'body'          => html_entity_decode($body),
                'auther'        => $auther,
                'category_id'   => $category_id,
                'category_name' => $category_name
            ];
        // push to data
        array_push($post_arr['data'], $post_item);

        }

        // turn JSON code
        echo json_encode($post_arr);
    
    } else {
        // No Posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }


?>