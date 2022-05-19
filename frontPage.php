<?php 
    declare(strict_types = 1);
    session_start();
    require_once('sql/connection.php');
    require_once('sql/restaurant.php');
    require_once('templates/common.php');
    //require_once('templates/comments.php');
    //require_once('sql/comments.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $categories = getCategories($db);

    //$comments = getComments($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Rasca Eats</title>
</head>
<body>
<?php output_header() ?>
    

    <section id= "restaurants"><?php 
        foreach($categories as $category){  ?>
            <section id = "category">
                <h2>
                <?php echo $category['category']?>
                </h2> <?php $restaurants = getRestaurantCategory($db, $category['category']);
                foreach($restaurants as $restaurant){ ?>
                    <article>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="https://picsum.photos/300/300?<?php echo $restaurant['restaurantName']?>" alt="Restaurant photo"></a>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                        <p><?php echo $restaurant['rating']?>/5.0</p>
                        <p><?php echo $restaurant['adress']?></p>
                    </article>
        <?php   } ?>
            </section>

<?php   } ?>
        
        
    </section>
    <?php output_footer()  ?>

    </body>
</html>