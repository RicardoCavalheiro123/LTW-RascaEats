<?php function output_restaurant($restaurant, $db, $ratings){ ?>
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
            <?php 
            $rating = 'rating';

            if(is_null($restaurant->$rating)) $restaurant->$rating = 0;
            $count = 0; $sum = 0;


            foreach($ratings as $rate){
                $count += 1;
                $sum = $sum + (int)$rate['rating'];
                $restaurant->$rating = $rate;

            }

            $restaurant->$rating = $sum / $count;

            
            echo $restaurant->$rating; 
   
            
            
            ?><i class="fa-solid fa-star"></i>
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
        <img class = "slide" src="https://picsum.photos/650/400?food1" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/650/400?food2" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/650/400?food3" alt="Restaurant photo">
        <button class="left-button" onclick="plusDivs(-1)">&#10094;</button>
        <button class="right-button" onclick="plusDivs(+1)">&#10095;</button>

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

<?php function output_restaurant_owner($restaurant, $db, $ratings){ ?>
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
            <?php 
            $rating = 'rating';

            if(is_null($restaurant->$rating)) $restaurant->$rating = 0;
            $count = 0; $sum = 0;


            foreach($ratings as $rate){
                $count += 1;
                $sum = $sum + (int)$rate['rating'];
                $restaurant->$rating = $rate;

            }

            $restaurant->$rating = $sum / $count;

            
            echo $restaurant->$rating; 
   
            
            
            ?><i class="fa-solid fa-star"></i>
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
        <img class = "slide" src="https://picsum.photos/650/400?food1" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/650/400?food2" alt="Restaurant photo">
        <img class = "slide" src="https://picsum.photos/650/400?food3" alt="Restaurant photo">
        <button class="left-button" onclick="plusDivs(-1)">&#10094;</button>
        <button class="right-button" onclick="plusDivs(+1)">&#10095;</button>

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