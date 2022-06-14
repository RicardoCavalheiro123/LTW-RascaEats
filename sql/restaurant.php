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
            $stmt = $db->prepare('SELECT DISTINCT restaurantId, restaurantName, adress, restaurant.category AS category, phoneNumber, rating, ownerId, restaurant.photo AS photo FROM Restaurant WHERE restaurantName like ? OR category like ? 
            UNION select DISTINCT restaurantId, restaurantName, adress, restaurant.category AS category, phoneNumber, rating, ownerId, restaurant.photo AS photo from dish JOIN restaurant USING (restaurantId) WHERE dishName LIKE ? limit ?');
            $stmt->execute(array($search . '%', $search . '%', $search . '%', $count));

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
        static function setRating($restaurantId, float $newRating, PDO $db) {

            $stmt = $db->prepare('UPDATE Restaurant SET rating = ? WHERE restaurantId = ?');
            $stmt->execute(array($newRating, $restaurantId));

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

        static function getRating($db, $restaurantId){
            $stmt = $db->prepare('SELECT sum(rating) AS sum FROM Comments WHERE RestaurantId = ?');
            $stmt->execute(array($restaurantId));
            $sum = $stmt->fetch()['sum'];

            $stmt = $db->prepare('SELECT count(*) AS count FROM Comments WHERE RestaurantId = ?');
            $stmt->execute(array($restaurantId));
            $count = $stmt->fetch()['count'];

            $sum = number_format($sum,1);
            
            if($sum != 0.0){
                $rating = number_format($sum / $count,1);
            }
            else{
                $rating = number_format(0,1);
            }

            Restaurant::setRating($restaurantId,$rating,$db);
            
            return $rating;
        }
        static function checkOrder($db, $restaurantId, $clientId){
            $stmt = $db->prepare('SELECT Distinct restaurantId FROM CurrentRequest JOIN Dish USING (dishId) JOIN Request USING (requestId) WHERE restaurantId = ? AND clientId = ?');
            $stmt->execute(array($restaurantId, $clientId));

            $orders = $stmt->fetchAll();

            if(count($orders) > 0) return true;

            return false;
        }


        static function getFavorites($db, $clientId){
            $stmt = $db->prepare('SELECT Restaurant.restaurantId AS restaurant, restaurantName, adress, category, phoneNumber, rating, ownerId, photo FROM FavRestaurant JOIN Restaurant using(restaurantId) WHERE clientId = ?');
            $stmt->execute(array($clientId));
            return $stmt->fetchAll();
        }


    }

?>