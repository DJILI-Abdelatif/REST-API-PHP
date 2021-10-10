<?php

    class Post
    {
        // DB Stuff 
        private $connect;
        private $table = "post";

        // Post Props
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $auther;
        public $created_at;

        // Constructor
        public function __construct($db)
        {
            $this->connect = $db;
        }

        // Get Posts
        public function read() {
            $query = "SELECT c.name as category_name,
                            p.id,
                            p.category_id,
                            p.title,
                            p.body,
                            p.auther,
                            p.created_at
                        FROM 
                            $this->table  p 
                        LEFT JOIN
                            category c ON p.category_id = c.id
                        ORDER BY p.created_at DESC";
            $statment = $this->connect->prepare($query);
            $statment->execute();
            return $statment;
        }
        
        // Get Post
        public function read_single() {
            $query = "SELECT c.name as category_name,
                            p.id,
                            p.category_id,
                            p.title,
                            p.body,
                            p.auther,
                            p.created_at
                        FROM 
                            $this->table  p 
                        LEFT JOIN
                            category c ON p.category_id = c.id
                        WHERE 
                        p.id = ?
                        LIMIT 0,1";

            $statment = $this->connect->prepare($query);
            $statment->bindParam(1, $this->id);
            $statment->execute();
            $row = $statment->fetch(PDO::FETCH_ASSOC);

            // set properties
            $this->title = $row["title"];
            $this->body = $row["body"];
            $this->auther = $row["auther"];
            $this->category_id = $row["category_id"];
            $this->category_name = $row["category_name"];
        }

        // creat post
        public function creat_post() {
            $query = "INSERT INTO 
                            $this->table 
                        SET 
                            title = :title,
                            body = :body,
                            auther = :auther,
                            category_id = :category_id";
            // prepare statmen 
            $statment = $this->connect->prepare($query);

            // clean code
            $this->title       = htmlspecialchars_decode(strip_tags($this->title));
            $this->body        = htmlspecialchars_decode(strip_tags($this->body));
            $this->auther      = htmlspecialchars_decode(strip_tags($this->auther));
            $this->category_id = htmlspecialchars_decode(strip_tags($this->category_id));

            // bind data
            $statment->bindParam(':title', $this->title);
            $statment->bindParam(':body', $this->body);
            $statment->bindParam(':auther', $this->auther);
            $statment->bindParam(':category_id', $this->category_id);

            // execute query
            if($statment->execute()) {
                return true;
            }

            print("error if somthing goes wrong");
            print_r("Error: %s .\n", $statment->error);
            return false;

        }

        // Update post 
        public function update() {
            $query = "UPDATE 
                            $this->table
                        SET
                            title = :title,
                            body = :body,
                            auther = :auther,
                            category_id = :category_id
                        WHERE 
                            id = :id";

            // prepare statment
            $statment = $this->connect->prepare($query);

            // clean code
            $this->title       = htmlspecialchars_decode(strip_tags($this->title));
            $this->body        = htmlspecialchars_decode(strip_tags($this->body));
            $this->auther      = htmlspecialchars_decode(strip_tags($this->auther));
            $this->category_id = htmlspecialchars_decode(strip_tags($this->category_id));
            $this->id          = htmlspecialchars_decode(strip_tags($this->id));

            // bind parms
            $statment->bindParam(':title', $this->title);
            $statment->bindParam(':body', $this->body);
            $statment->bindParam(':auther', $this->auther);
            $statment->bindParam(':category_id', $this->category_id);
            $statment->bindParam(':id', $this->id);

            if($statment->execute()) {
                return true;
            }

            print("error if somthing goes wrong");
            print_r("Error: %s .\n", $statment->error);
            return false;

        }

        // delete post
        public function delete() {
            $query = "DELETE FROM $this->table WHERE id = :id";

            $statment = $this->connect->prepare($query);

            $statment->bindParam(':id', $this->id);

            if($statment->execute()) {
                return true;
            } 
            
            print("error if somthing goes wrong");
            print_r("Error: %s .\n", $statment->error);
            return false;
        } 

    }

?>