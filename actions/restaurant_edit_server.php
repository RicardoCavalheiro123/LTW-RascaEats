
<?php 

require_once(__DIR__. '/../sql/connection.php');
require_once(__DIR__. '/../sql/restaurant.class.php');

require_once(__DIR__. '/../templates/comments.php');
require_once(__DIR__. '/../sql/comments.class.php');
require_once(__DIR__. '/../templates/common.php');

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

    $stmt = $db->prepare('SELECT * FROM Restaurant WHERE restaurantId = ?');
    $stmt->execute(array($Restaurant_id));

    //$restaurant = $stmt->fetch();
    //$restaurantName = str_replace(' ', '', $restaurant['restaurantName']);


    
    if($_FILES['file']['name'] != ""){
        
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileExt, $allowed)){
            if($fileError === 0){
                echo "file quase movido";
                $fileDestination = '../images/Restaurant' . $Restaurant_id . '.' . $fileExt;
                $jpg = '../images/Restaurant' . $Restaurant_id . '.jpg';
                $jpeg = '../images/Restaurant' . $Restaurant_id. '.jpeg';
                $png = '../images/Restaurant' . $Restaurant_id. '.png';
                unlink($jpg); unlink($jpeg); unlink($png);
                
                move_uploaded_file($fileTmpName, $fileDestination);

                $stmt = $db->prepare(' UPDATE Restaurant SET photo = ? WHERE restaurantId = ? ');
                
                $stmt->execute(array('../images/Restaurant' . $Restaurant_id. '.' . $fileExt, $Restaurant_id));
            }
        }
    }
    

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
    header("Location: ../pages/owner_restaurant.php?id=" . $Restaurant_id);
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
    
    $rest_id = $_GET['id'];
    $dish_id = $_GET['dish'];
    
    if($_FILES['file']['name'] != ""){
        var_dump($_FILES);
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileExt, $allowed)){
            if($fileError === 0){
                
                $fileDestination = '../images/Dish' . $dish_id . '.' . $fileExt;
                $jpg = '../images/Dish' . $dish_id . '.jpg';
                $jpeg = '../images/Dish' . $dish_id. '.jpeg';
                $png = '../images/Dish' . $dish_id. '.png';
                unlink($jpg); unlink($jpeg); unlink($png);
                
                move_uploaded_file($fileTmpName, $fileDestination);

                $stmt = $db->prepare(' UPDATE Dish SET photo = ? WHERE dishId = ? ');
                
                $stmt->execute(array('../images/Dish' . $dish_id. '.' . $fileExt, $dish_id));
            }
        }
    }
    

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
    header("Location: ../pages/edit_restaurant.php?id=$rest_id");
 
}
if(isset($_POST['deleteDish'])){
    $dish_id = $_GET['dish'];
    $rest_id = $_GET['id'];
    $stmt = $db->prepare('
    Delete from Dish
    WHERE dishId = ?
    ');
    $stmt->execute(array($dish_id));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
 
}
if(isset($_POST['addDish2'])){


    $dish_Name = $_POST['dishName'];      
    $dish_Price = $_POST['dishPrice'];   
    $dish_Category = $_POST['dishCategory'];   
    $rest_id = $_GET['id'];

    $stmt = $db->prepare('SELECT * FROM Dish WHERE restaurantId = ? AND dishName = ?');
    $stmt->execute(array($rest_id, $dish_Name));

    $dish = $stmt->fetch();
    $dishName = str_replace(' ', '', $dish['dishName']);


    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    

    $fileExt = explode('.', $fileName);
    
    $fileExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');


    $stmt = $db->prepare('SELECT * FROM Dish ORDER BY dishId DESC limit 1');
    $stmt->execute();
    $dishId = $stmt->fetch()['dishId'] + 1;

    

    if(in_array($fileExt, $allowed)){
        if($fileError === 0){
            $fileDestination = '../images/Dish' . $dishId . '.' . $fileExt;
            $jpg = '../images/Dish' . $dishId . '.jpg';
            $jpeg = '../images/Dish' . $dishId . '.jpeg';
            $png = '../images/Dish' . $dishId . '.png';
            unlink($jpg); unlink($jpeg); unlink($png);
            
            move_uploaded_file($fileTmpName, $fileDestination);

            
        }
    }

    $photo = '../images/Dish'. $dishId . '.' . $fileExt;

    $stmt = $db->prepare('INSERT INTO Dish(restaurantId, dishName, price, category, photo) VALUES(?, ?, ?, ?, ?)');
    $stmt->execute(array($rest_id, $dish_Name,$dish_Price,$dish_Category, $photo));

    header("Location: ../pages/edit_restaurant.php?id=$rest_id");

}

?>


