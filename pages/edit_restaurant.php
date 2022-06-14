
<?php 

require_once(__DIR__. '/../sql/connection.php');
require_once(__DIR__. '/../sql/restaurant.class.php');
require_once(__DIR__. '/../templates/restaurant.php');

require_once(__DIR__. '/../templates/comments.php');
require_once(__DIR__. '/../sql/comments.class.php');

require_once(__DIR__. '/../templates/common.php');

require_once(__DIR__. '/../templates/dishes.php');
require_once(__DIR__. '/../sql/dish.class.php');
require_once(__DIR__. '/../sql/favRestaurant.php');
require_once(__DIR__. '/../sql/favDish.php');

    session_start();


    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $restaurant = Restaurant::getRestaurant($db);
    if (isset($_SESSION['id'])){

        $isOwner = Restaurant::isRestaurantOwner($restaurant,$_SESSION['id']);
        if(!$isOwner){
            header("Location: ../pages/restaurant.php?id=$restaurant->restaurantId");
        }
    }
    $menu = Dish::getMenu($db);

    $dishImages = Dish::getDishImages($db, $restaurant->restaurantId);
    $restaurantImages = Restaurant::getRestaurantImage($db, $restaurant->restaurantId);
    $restaurantImage = $restaurantImages['photo'];

    $comments = Comments::getComments($db);
    $ratings = Comments::getRatings($db);
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/restaurant.css">
    <link rel="stylesheet" href="../css/comments.css">
    <link rel="stylesheet" href="../css/dishes.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <script src="../javascript/cart.js" defer></script>
    <script src="../javascript/search.js" defer></script>
    <script src="../javascript/favRestaurant.js" defer></script>
    <title>Restaurante</title>
</head>
<body>
    <?php output_header_wo_search($db)?>

    
    <?php 
    if(isset($_POST['editInfo'])){ ?>
    <div class = "editInf">
    <form action="../actions/restaurant_edit_server.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="logout" enctype="multipart/form-data">
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
            
            <select id="categories" name = "Restaurant_Category" class = "input-field">
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
            <label for="file">Escolha uma imagem: </label>
            <input type="file" name="file">
        </div>
        <div class="row">
        
            <button class="button-3" name = "editRestaurant" id = "editRestaurant" role="button">Save</button>
    </form>
        </div>

    </div>
    <?php }
    else{
        ?>
 
    <div class = "content-table">
        <table class = "table">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Category</td>
                    <td>Photo</td>
                    <td colspan = "2">Action</td>
                </tr>
            </thead>
            <tbody>
      
        <?php foreach($menu as $dish){ ?>
            <tr>
                    

                        <td><?php echo $dish['dishName'] ?></td>
                        <td><?php echo $dish['price'] ?></td>
                        <td><?php echo $dish['category'] ?></td>
                        <td><img src=<?=$dish['photo']?>></td>
                    
                        <td>
                            <form action="../pages/edit_dish.php?id=<?php echo $restaurant->restaurantId;?>&dish=<?php echo $dish['dishId'];?>" method="post" class="editdish">
                                <button class="button-3" name = "editdish" id = "editdish" role="button">Edit</button>
                            </form>
                            <form action="../actions/restaurant_edit_server.php?id=<?php echo $restaurant->restaurantId;?>&dish=<?php echo $dish['dishId'];?>" method="post" class="edit">
                                <button class="button-3" name = "deleteDish" id = "deleteDish" role="button">Delete</button>
                            </form>
                        </td>

                
                </tr>
            <?php 
            
        } ?>
        </tbody>
    </table>

        <button class = "button-3" id ="returnToRestaurant"><a href="../pages/restaurant.php?id=<?=$_GET['id']?>" ><i class="fa-solid fa-arrow-left"></i> Return to restaurant</a></button>
        <form action="../pages/add_dish.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="add">
            
            <button class="button-3" name = "addDish" id = "addDish" role="button"><i class="fa-solid fa-plus"></i> Add a Dish</button>
        </form>
    </div>
        <?php 
        
    } ?>



    <?php output_footer()  ?>
</body>
</html>