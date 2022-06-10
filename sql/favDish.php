<?php

    function setFavDish($db){
        if(isset($_POST['favDishSubmit'])){
            $clientId = $_POST['clientId'];
            $dishId = $_POST['dishId'];
            $stmt = $db->prepare('INSERT INTO FavDish (clientId, dishId) VALUES (?, ?)');

            $stmt->execute(array($clientId, $dishId));

        }
    }

    function deleteFavDish($db){
        if(isset($_POST['favDishSubmit'])){
            $clientId = $_POST['clientId'];
            $dishId = $_POST['dishId'];
            $stmt = $db->prepare('DELETE FROM FavDish WHERE clientId = ? AND dishId = ?');

            $stmt->execute(array($clientId,$dishId));
        }
    }

    function checkFavDish($db, $id){
        $stmt = $db->prepare('SELECT * FROM favDish WHERE dishId = ? AND clientId = ?' );
        $stmt->execute(array($id,$_SESSION['id']));

        $result = $stmt->fetchAll();

        if(count($result) > 0) return true;
    }

    

?>