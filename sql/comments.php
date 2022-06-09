<?php

    class Comments{
        public int $clientId;
        public int $restaurantId;
        public string $comment;
        public int $rating;
        public string $published;

        public function __construct(int $clientId, int $restaurantId, string $comment, int $rating, string $published)
        {
            $this->clientId = $clientId;
            $this->restaurantId = $restaurantId;
            $this->comment = $comment;
            $this->rating = $rating;
            $this->published = $published;
        }

        static function getComments($db){
            $stmt = $db->prepare('SELECT * FROM Comments JOIN Client USING (clientID) WHERE restaurantId = ?');
            $stmt->execute(array($_GET['id']));
            return $stmt->fetchAll();
        }

        static function setComments($db){
            if(isset($_POST['commentSubmit'])){
    
                $clientId = $_POST['clientId'];
                $restaurantId = $_POST['restaurantId'];
                $date = $_POST['date'];
                $comment = $_POST['comment'];
                $rating = $_POST['rating'];
                
    
                $stmt = $db->prepare('INSERT INTO Comments (clientId, restaurantId, comment, rating, published) VALUES (?, ?, ?, ?, ?)');
    
                $stmt->execute(array($clientId, $restaurantId, $comment, intval($rating), $date));
    
                echo "<meta http-equiv='refresh' content='0'>";
    
            }
        }

        static function getRatings($db){
            $stmt = $db->prepare('SELECT rating FROM Comments JOIN Client USING (clientID) WHERE restaurantId = ?');
            $stmt->execute(array($_GET['id']));
            return $stmt->fetchAll();
        }

    }



?>
