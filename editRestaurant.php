
<?php 

require_once('sql/connection.php');
require_once('sql/restaurant.php');

require_once('templates/comments.php');
require_once('templates/common.php');


session_start();


$db = getDatabaseConnection();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$restaurant = Restaurant::getRestaurant($db);
if (isset($_SESSION['id'])){

    $isOwner = Restaurant::isRestaurantOwner($restaurant,$_SESSION['id']);
    if(!$isOwner){
        header("Location: restaurant.php?id=$restaurant->restaurantId");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/restaurant.css">
    <link rel="stylesheet" href="css/comments.css">
    <link rel="stylesheet" href="css/dishes.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
    <script src="cart.js" defer></script>
    <script src="search.js" defer></script>
    <script src="favRestaurant.js" defer></script>
    <title>Restaurante</title>
</head>
<body>
    <?php output_header()?>

    <?php 
    if(isset($_POST['editInfo'])){ ?>
    <div class = "editInf">
    <form action="restaurant_edit_server.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="logout">
        <div class="row">
            <span class="bold">Restaurant Name</span>
            <span class="b"><p>(<?php echo $restaurant->restaurantName;?>)</p></span>
            <input type="text" class = "input-field" name = "Restaurant_Name" placeholder= "<?=$restaurant->restaurantName?>" >
            
        </div>
        <div class="row">
            <span class="bold">Address</span>
            <span class="b"><p>(<?php echo $restaurant->address;?>)</p></span>
            <input type="text" class = "input-field" name = "Address" placeholder= "<?=$restaurant->address?>">
        </div>
        <div class="row">

            <span class="bold"><p>Restaurant Category</p></span>
            <span class="b"><p>(<?php echo $restaurant->category;?>)</p></span>
            
            <select id="cars" name = "Restaurant_Category" class = "input-field">
                <option value="Fast-Food">Fast-Food</option>
                <option value="Italiano">Italiano</option>
                <option value="Tradicional">Tradicional</option>
                <option value="Japonês">Japonês</option>
            </select>
            
        </div>
        <div class="row">
            <span class="bold">Phone Number</span>
            <span class="b"><p>(<?php echo $restaurant->phoneNumber;?>)</p></span>
            
            <input type="text" class = "input-field" name = "Phone_Number" placeholder= "<?php echo $restaurant->phoneNumber;?>" >
        </div>
        <div class="row">
        
            <button class="button-3" name = "editRestaurant" id = "editRestaurant" role="button">Save</button>
    </form>
        </div>

    </div>
    <?php } ?>



    <?php output_footer()  ?>
    </body>
</html>