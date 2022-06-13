
<?php 

require_once('sql/connection.php');
require_once('sql/restaurant.php');

require_once('templates/comments.php');
require_once('sql/comments.php');
require_once('templates/common.php');

session_start();


$db = getDatabaseConnection();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



if(isset($_POST['editRestaurant'])){
    $restaurant = Restaurant::getRestaurant($db);
    $Restaurant_Name = $_POST['Restaurant_Name'];      
    $Restaurant_Address = $_POST['Address'];   
    $Restaurant_Category = $_POST['Restaurant_Category'];   
    $Restaurant_Phone_Number = $_POST['Phone_Number'];   
    $Restaurant_id = $_GET['id'];
    if($Restaurant_Name != ""){
        $stmt = $db->prepare('
        Update Restaurant set restaurantName = ?
        WHERE restaurantId = ?
      ');
    
        $stmt->execute(array($Restaurant_Name,$Restaurant_id));
        
    }
    if($Restaurant_Address != ""){
        $stmt = $db->prepare('
        Update Restaurant set adress = ?
        WHERE restaurantId = ?
        ');

            $stmt->execute(array($Restaurant_Address,$Restaurant_id));
            
    }
    if($Restaurant_Category != ""){
        $stmt = $db->prepare('
        Update Restaurant set category = ?
        WHERE restaurantId = ?
        ');
        $stmt->execute(array($Restaurant_Category,$Restaurant_id));
    }
    if($Restaurant_Phone_Number != ""){
        $stmt = $db->prepare('
        Update Restaurant set phoneNumber = ?
        WHERE restaurantId = ?
        ');

        $stmt->execute(array($Restaurant_Phone_Number,$Restaurant_id));   
    }
    header("Location: restaurantOfOwner.php?id=$restaurant->restaurantId");
}

if(isset($_POST['deleteDish'])){
    $dish_id = $_GET['dish'];
    $rest_id = $_GET['id'];
    $stmt = $db->prepare('
    Delete from Dish
    WHERE dishId = ?
    ');
    $stmt->execute(array($dish_id));
    echo $_GET['id'];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
 
}
if(isset($_POST['editdish'])){
    $dish_Name = $_POST['dishName'];      
    $dish_Price = $_POST['dishPrice'];   
    $dish_Category = $_POST['dishCategory'];    
    $dish_id = $_GET['dish'];
    $rest_id = $_GET['id'];
    /*$stmt = $db->prepare('
    Update from Dish
    WHERE dishId = ?
    ');
    $stmt->execute(array($dish_id));*/

    if($dish_Name != ""){
        $stmt = $db->prepare('
        Update Dish set dishName = ?
        WHERE dishId = ?
      ');
    
        $stmt->execute(array($dish_Name,$dish_id));
        
        
    }
    if($dish_Price != ""){
        $stmt = $db->prepare('
        Update Dish set price = ?
        WHERE dishId = ?
      ');
    
        $stmt->execute(array($dish_Price,$dish_id));
            
    }
    if($dish_Category != ""){
        $stmt = $db->prepare('
        Update Dish set category = ?
        WHERE dishId = ?
      ');
    
        $stmt->execute(array($dish_Category,$dish_id));
    }
    
    header("Location: editRestaurant.php?id=$rest_id");
 
}
if(isset($_POST['deleteDish'])){
    $dish_id = $_GET['dish'];
    $rest_id = $_GET['id'];
    $stmt = $db->prepare('
    Delete from Dish
    WHERE dishId = ?
    ');
    $stmt->execute(array($dish_id));
    $stmt = $db->prepare('DELETE from DishPhoto where dishId = ?');
    $stmt->execute(array($dish_id));
    echo $_GET['id'];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
 
}
if(isset($_POST['addDish2'])){
    $dish_Name = $_POST['dishName'];      
    $dish_Price = $_POST['dishPrice'];   
    $dish_Category = $_POST['dishCategory'];    
    $rest_id = $_GET['id'];
    $stmt = $db->prepare('INSERT INTO Dish(restaurantId, dishName, price, category) VALUES(?, ?, ?, ?)');
    $stmt->execute(array($rest_id, $dish_Name,$dish_Price,$dish_Category));

    $stmt = $db->prepare('SELECT * FROM Dish WHERE dishName = ? and restaurantId = ?');
    $stmt->execute(array($dish_Name,$rest_id));
    $id = $stmt->fetch();
    $d = $id['dishId'];
    echo $id['dishId'];
    echo $id['dishName'];

    $stmt = $db->prepare('INSERT INTO DishPhoto(dishId,photo) VALUES(?, ?)');
    $photo = "https://picsum.photos/seed/" .$id['dishId'];
    $photo .= "/300/200";
    $stmt->execute(array($id['dishId'],$photo));
    header("Location: editRestaurant.php?id=$rest_id");

}

?>


