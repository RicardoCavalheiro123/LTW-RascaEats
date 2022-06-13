<?php

    class Dish{
        public int $dishId;
        public int $restaurantId;
        public string $dishName;
        public float $price;
        public string $category;
        public string $photo;

        public function __construct(int $dishId, int $restaurantId, string $dishName, float $price, string $category, string $photo)
        {
            $this->dishId = $dishId;
            $this->restaurantId = $restaurantId;
            $this->dishName = $dishName;
            $this->price = $price;
            $this->category = $category;
            $this->photo = $photo;
        }

        static function getMenu($db){
            $stmt = $db->prepare('SELECT * FROM Dish WHERE restaurantId = ?');
            $stmt->execute(array($_GET['id']));
            return $stmt->fetchAll();
        }
        static function getDish(PDO $db,int $id) : Dish{
            $stmt = $db->prepare('SELECT * FROM Dish WHERE dishId = ?');
            $stmt->execute(array($id));
            $dish = $stmt->fetch();
            return new Dish(
                $dish['dishId'],
                $dish['restaurantId'],
                $dish['dishName'],
                $dish['price'],
                $dish['category'],
                $dish['photo']
            );
        }

        static function getDishImages($db, $id){
            $stmt = $db->prepare('SELECT photo FROM Dish WHERE restaurantId = ?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        }
        
    }


    

    

?>