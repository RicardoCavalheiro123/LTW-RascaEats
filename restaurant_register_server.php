<?php 

require_once('sql/connection.php');
require_once('sql/restaurant.php');

require_once('templates/comments.php');
require_once('sql/comments.php');
require_once('templates/common.php');

session_start();


$db = getDatabaseConnection();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



if(isset($_POST['registerRestaurant'])){

    

    $Restaurant_Name = $_POST['Restaurant_Name'];      
    $Restaurant_Address = $_POST['Address'];   
    $Restaurant_Category = $_POST['Restaurant_Category'];   
    $Restaurant_Phone_Number = $_POST['Phone_Number'];   

    $file = $_FILES['file'];

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
            $fileDestination = 'images/' . str_replace(' ', '', $Restaurant_Name) . '.' . $fileExt;
            move_uploaded_file($fileTmpName, $fileDestination);
        }
    }

    if($Restaurant_Name != "" && $Restaurant_Address != "" && $Restaurant_Category != "" && $Restaurant_Phone_Number != ""){
        $stmt = $db->prepare('INSERT INTO Restaurant (restaurantName, adress, category, phoneNumber, rating, ownerId, photo) VALUES(?,?,?,?,NULL,?,?)');
    
        $stmt->execute(array($Restaurant_Name,$Restaurant_Address, $Restaurant_Category, $Restaurant_Phone_Number, $_SESSION['id'], $fileDestination));
        
    }
    
    $stmt = $db->prepare('SELECT last_insert_rowid()');
    
    $stmt->execute();
    $restaurantId = $stmt->fetch();

    

    header("Location: restaurantOfOwner.php?id=". $restaurantId['last_insert_rowid()'] );
}


?>