<?php

    class Category 
    {
        // DB stuff
        private $connect;
        protected $table = 'category';

        // properties
        public int $id;
        public string $name;
        public string $created_at;

        // methods
        public function __construct($db)
        {
            $this->connect = $db;
        }

        // get categories
        public function read() {
            $query = "SELECT * FROM $this->table ORDER BY created_at";
            $statment = $this->connect->prepare($query);
            $statment->execute();
            return $statment;
        }

        // get one category
        public function readSingle() {
            $query = "SELECT * FROM $this->table WHERE id = ? LIMIT 0,1";
            $statment = $this->connect->prepare($query);
            $statment->bindParam(1, $this->id);
            $statment->execute();
            $row = $statment->fetch(PDO::FETCH_ASSOC);

            // set properties
            if($row) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->created_at = $row['created_at'];
                return true;
            }
            return false;
        }
        
        // create item category
        public function createCategory() {
            $query = "INSERT INTO $this->table SET name = :name";
            $statment = $this->connect->prepare($query);
            
            // clean code 
            $this->name = htmlspecialchars_decode(strip_tags($this->name));
            
            // bind parameters
            $statment->bindParam(':name', $this->name);
            
            if($statment->execute()) {
                return true;
            } else {
                print("error if somthing goes wrong");
                print_r("Error: %s .\n", $statment->error);
                return false;
            }
        }

        // update item category
        public function update() {
            $query = "UPDATE 
                            $this->table 
                        SET 
                            name = :name, 
                            created_at = :created_at
                        WHERE id = :id";
            $statment = $this->connect->prepare($query);

            // clean code
            $this->name = htmlspecialchars_decode(strip_tags($this->name));
            $this->created_at = htmlspecialchars_decode(strip_tags($this->created_at));

            // bind parameters
            $statment->bindParam(':id', $this->id);
            $statment->bindParam(':name', $this->name);
            $statment->bindParam(':created_at', $this->created_at);

            if($statment->execute()) {
                return true;
            } 
            print("error if somthing goes wrong");
            print_r("Error: %s .\n", $statment->error);
            return false;
        }

        // delete item category
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