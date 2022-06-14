<?php

use LDAP\Result;

 function output_restaurant($restaurant, $db, $rating, $restaurantImage){ ?>
    <section id= "restaurant">
        <p>
            <?php
            $category = 'category';
            echo $restaurant->$category ?>
        </p>
        <p>
            <?php 
            $name = 'restaurantName';
            echo $restaurant->$name ?>
        </p>
        <p>
            <?php echo $rating ?><i class="fa-solid fa-star"></i>
        </p>
        <p>
            <?php
            $phoneNumber = 'phoneNumber'; 
            echo $restaurant->$phoneNumber ?>
            <i class="fa-solid fa-phone"></i>
        </p>
        <p>
            <?php 
            $address = 'adress';
            echo $restaurant->address; ?>
            
        </p>
        
        <img class = "slide" src= <?php echo $restaurantImage; ?> alt="Restaurant photo">

        <?php if(isset($_SESSION['id'])){ ?>
            <span class="favRestaurant">
                    <button type='submit' name='favRestaurantSubmit' <?php 
                        if (checkFavRestaurant($db)) echo "class = exists" 
                        ?> 
                        onclick="toggleFavRestaurant(<?=$_SESSION['id']?>, <?=$_GET['id']?>)">
                        <i class='fa-solid fa-heart'></i>
                    </button> 

            </span>
        <?php } ?> 
                
        
    </section>

<?php } ?>

<?php function output_restaurant_owner($restaurant, $db, $rating, $restaurantImage){ ?>
    <section id= "restaurant">
        <p>
            <?php
            $category = 'category';
            echo $restaurant->$category ?>
        </p>
        <p>
            <?php 
            $name = 'restaurantName';
            echo $restaurant->$name ?>
        </p>
        <p>
            <?php echo $rating?><i class="fa-solid fa-star"></i>
        </p>
        <p>
            <?php
            $phoneNumber = 'phoneNumber'; 
            echo $restaurant->$phoneNumber ?>
            <i class="fa-solid fa-phone"></i>
        </p>
        <p>
            <?php 
            $address = 'adress';
            echo $restaurant->address; ?>
            
        </p>
        <img class = "slide" src= <?php echo $restaurantImage; ?> alt="Restaurant photo">

        <form action="editRestaurant.php?id=<?php echo $restaurant->restaurantId;?>" method="post" class="editRestaurant">
                <button class="button-4" name= "editInfo" id = "editInfo" role="button">Edit Information</button>
        </form>
        
        <?php if(isset($_SESSION['id'])){ ?>
            <span class="favRestaurant">
                    <button type='submit' name='favRestaurantSubmit' <?php 
                        if (checkFavRestaurant($db)) echo "class = exists" 
                        ?> 
                        onclick="toggleFavRestaurant(<?=$_SESSION['id']?>, <?=$_GET['id']?>)">
                        <i class='fa-solid fa-heart'></i>
                    </button> 

            </span>
        <?php } ?> 
                
        
    </section>

<?php } ?>

<?php function output_list_restaurants($categories, $db){ ?>
    
    <section id= "restaurants"><?php 
        foreach($categories as $category){  ?>
            <section id = "category">
                <h2>
                <?php echo $category['category']?>
                </h2> <?php $restaurants = Restaurant::getRestaurantCategory($db, $category['category']);
                foreach($restaurants as $restaurant){ 
                    
                    $rating = Restaurant::getRating($db,$restaurant['restaurantId']);
                    
                    
                    ?>
                    <article>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="<?php echo $restaurant['photo']?>" alt="Restaurant photo" width="300px" height = "300px"></a>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                        <p><?php echo $rating?>/5.0 ☆</p>
                        <p><?php echo $restaurant['adress']?></p>
                    </article>
        <?php   } ?>
            </section>

        <?php   } ?>
        
        
    </section>

<?php } ?>

<?php function output_list_owned_restaurants($db, $ownerRestaurants) { ?>
    <section id = "restaurantes">

    <?php foreach($ownerRestaurants as $restaurant){ 

        $rating = Restaurant::getRating($db,$restaurant['restaurantId']); ?>

        <article>
            <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="<?php echo $restaurant['photo']?>"alt="Restaurant photo" width="300px" height = "300px"></a>
            <section id = "desc"><a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
            <p><?php echo $rating ?>/5.0 ☆</p>
            <p><?php echo $restaurant['adress']?></p></section>
        </article>

    <?php } 
    
    ?></section>

<?php } ?>

<?php function output_restaurant_register( $db){ ?>
    <div class = "editInf">
    <form action="restaurant_register_server.php" method="post" class="logout" enctype ="multipart/form-data">
        <div class="row">
            <span class="bold">Restaurant Name</span>
            <input type="text" class = "input-field" name = "Restaurant_Name" placeholder= "Restaurant Name" >
            
        </div>
        <div class="row">
            <span class="bold">Address</span>
            <input type="text" class = "input-field" name = "Address" placeholder= "Address">
        </div>
        <div class="row">

            <span class="bold"><p>Restaurant Category</p></span>
            
            <select id="cars" name = "Restaurant_Category" class = "input-field">
                <option value="Fast-Food">Fast-Food</option>
                <option value="Italiano">Italiano</option>
                <option value="Tradicional">Tradicional</option>
                <option value="Japonês">Japonês</option>
            </select>
            
        </div>
        <div class="row">
            <span class="bold">Phone Number</span>
            <input type="text" class = "input-field" name = "Phone_Number" placeholder= "Phone Number" >
        </div>
        <div class="row">
            <input type="file" name="file">
        </div>
        <div class="row">
        
            <button class="button-3" name = "registerRestaurant" id = "editRestaurant" role="button">Add Restaurant</button></div>
    </form>
</div>

<?php } ?>