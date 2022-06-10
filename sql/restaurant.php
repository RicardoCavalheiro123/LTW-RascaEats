<?php

    class Restaurant {
        public int $restaurantId;
        public string $restaurantName;
        public string $address;
        public string $category;
        public int $phoneNumber;
        public $rating;
        public int $ownerId;

        public function __construct(int $id, string $name, string $address, string $category, int $phoneNumber, float $rating, int $ownerId)
        {
            $this->restaurantId = $id;
            $this->restaurantName = $name;
            $this->address = $address;
            $this->category = $category;
            $this->phoneNumber = $phoneNumber;
            $this->rating = $rating;
            $this->ownerId = $ownerId;
        }

        static function getRestaurants(PDO $db, int $count) : array {
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantName = ? limit ?');
            $stmt->execute(array($count));

            $restaurants = array();
            while($restaurant = $stmt->fetch()) {
                $restaurants[] = new Restaurant(
                    $restaurant['restaurantId'],
                    $restaurant['restaurantName'],
                    $restaurant['adress'],
                    $restaurant['category'],
                    $restaurant['phoneNumber'],
                    $restaurant['rating'],
                    $restaurant['ownerId'],
                );
            }

            return $restaurants;
        }

        static function getRestaurant(PDO $db) : Restaurant {
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantId = ?');
            $stmt->execute(array($_GET['id']));
        
            $restaurant = $stmt->fetch();
        
            return new Restaurant(
                $restaurant['restaurantId'],
                $restaurant['restaurantName'],
                $restaurant['adress'],
                $restaurant['category'],
                $restaurant['phoneNumber'],
                $restaurant['rating'],
                $restaurant['ownerId'],
            );
        }
        
        static function getRestaurantCategory($db, $category) {
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE category = ? limit 3');
            $stmt->execute(array($category));
            return $stmt->fetchAll();
        }
    
        static function getCategories($db){
            $stmt = $db->prepare('SELECT DISTINCT category FROM Restaurant ORDER BY category');
            $stmt->execute();
            return $stmt->fetchAll();
        }

        static function searchRestaurants(PDO $db, string $search, int $count) : array {
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantName like ? limit ?');
            $stmt->execute(array($search . '%', $count));

            $restaurants = array();
            while($restaurant = $stmt->fetch()) {
                $restaurants[] = new Restaurant(
                    $restaurant['restaurantId'],
                    $restaurant['restaurantName'],
                    $restaurant['adress'],
                    $restaurant['category'],
                    $restaurant['phoneNumber'],
                    $restaurant['rating'],
                    $restaurant['ownerId'],
                );
            }


            return $restaurants;

        }
        static function isRestaurantOwner(Restaurant $restaurant, int $UserId) {
            if($restaurant->ownerId == $UserId) return True;
            else return false;

        }


    }

?>