
<?php 

require_once('sql/connection.php');
require_once('sql/restaurant.php');

require_once('templates/comments.php');
require_once('sql/comments.php');
require_once('templates/common.php');

session_start();


$db = getDatabaseConnection();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$restaurant = Restaurant::getRestaurant($db);

if(isset($_POST['editRestaurant'])){
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
?>


