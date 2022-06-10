<?php

    class Dish{
        public int $dishId;
        public int $restaurantId;
        public string $dishName;
        public float $price;
        public string $category;

        public function __construct(int $dishId, int $restaurantId, string $dishName, float $price, string $category)
        {
            $this->dishId = $dishId;
            $this->restaurantId = $restaurantId;
            $this->dishName = $dishName;
            $this->price = $price;
            $this->category = $category;
        }

        static function getMenu($db){
            $stmt = $db->prepare('SELECT * FROM Dish WHERE restaurantId = ?');
            $stmt->execute(array($_GET['id']));
            return $stmt->fetchAll();
        }
    }


    function getImages($db){
        $stmt = $db->prepare('SELECT * FROM DishPhoto');
        $stmt->execute();
        return $stmt->fetchAll();
    }

?>