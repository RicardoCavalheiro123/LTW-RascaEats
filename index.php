<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $categories = getCategories($db);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ex</title>
</head>
<body>
    <header> 
        <img src="logo.png" alt="Logo" > <br>
        <input type="button" value="Login/Register"> <br>
        <input type="text" placeholder = "Search Restaurants">
        <input type="button" value="Search">

    </header>
    

    <section id= "restaurants">
        <section id = "category">
            <h2>
            Fast-Food
            </h2>
            <article>
                <img src="https://picsum.photos/300/300?food1" alt="Restaurant photo">
                <p>Restaurante 1</p>
                <p>9.3</p>
                <p>Gaia</p>
            </article>
            <article>
                <img src="https://picsum.photos/300/300?food2" alt="Restaurant photo">
                <p>Restaurante 5</p>
                <p>8.1</p>
                <p>Maia</p>
            </article>
            <article>
                <img src="https://picsum.photos/300/300?food3" alt="Restaurant photo">
                <p>Restaurante 2</p>
                <p>9.5</p>
                <p>Gaia</p> 
            </article>
            
        </section>
        <section id = "category">
            <h2>
            Italiano
            </h2>
            <article>
                <img src="https://picsum.photos/300/300?food4" alt="Restaurant photo">
                <p>Restaurante 3</p>
                <p>9.3</p>
                <p>Gaia</p>
            </article>
            <article>
                <img src="https://picsum.photos/300/300?food5" alt="Restaurant photo">
                <p>Restaurante 5</p>
                <p>8.1</p>
                <p>Maia</p>
            </article>
            <article>
                <img src="https://picsum.photos/300/300?food6" alt="Restaurant photo">
                <p>Restaurante 4</p>
                <p>9.5</p>
                <p>Gaia</p> 
            </article>
            
        </section>
        
    </section>
    

    </body>
</html>