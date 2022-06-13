<?php

    class Restaurant {
        public int $restaurantId;
        public string $restaurantName;
        public string $address;
        public string $category;
        public int $phoneNumber;
        public $rating;
        public int $ownerId;
        public string $photo;

        public function __construct(int $id, string $name, string $address, string $category, int $phoneNumber, $rating, int $ownerId, string $photo)
        {
            $this->restaurantId = $id;
            $this->restaurantName = $name;
            $this->address = $address;
            $this->category = $category;
            $this->phoneNumber = $phoneNumber;
            $this->rating = $rating;
            $this->ownerId = $ownerId;
            $this->photo = $photo;
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
                    $restaurant['photo'],
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
                $restaurant['photo'],
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
                    $restaurant['photo'],
                );
            }


            return $restaurants;

        }
        static function isRestaurantOwner(Restaurant $restaurant, int $UserId) {
            if($restaurant->ownerId == $UserId) return True;
            else return false;

        }
        static function setRating(Restaurant $restaurant, float $newRating, PDO $db) {
            $oldRestaurantId = $restaurant->restaurantId;
            $stmt = $db->prepare('DELETE FROM Restaurant WHERE restaurantId = ?');
            $stmt->execute(array($restaurant->restaurantId));

            $stmt = $db->prepare('INSERT INTO Restaurant (restaurantId, restaurantName, adress, category, phoneNumber, rating, ownerId, photo) 
            VALUES (?, ?, ?, ?, ?, ? ,?, ?)');

            $stmt->execute(array($oldRestaurantId, $restaurant->restaurantName,$restaurant->address,$restaurant->category,
            $restaurant->phoneNumber,$newRating,$restaurant->ownerId, $restaurant->photo));

        }
        static function getRestaurantsOwned(int $ownerId, $db){
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE ownerId = ?');
            $stmt->execute(array($ownerId));
            return $stmt->fetchAll();
        }
        static function getRestaurantImage($db, $restaurantId){
            $stmt = $db->prepare('SELECT photo FROM Restaurant WHERE RestaurantId = ?');
            $stmt->execute(array($restaurantId));
            return $stmt->fetch();
        }


    }

?>