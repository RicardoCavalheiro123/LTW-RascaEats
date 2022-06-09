<?php 
    declare(strict_types = 1); 
?>


<?php function drawLogoutForm(string $name) { ?>
  <form action="actionlogout.php" method="post" class="logout">
    <a href="orders.php">Minhas encomendas</a>
    <a href="profilePage.php"><?=$name?></a>
    <button class="button-4" role="button">Logout</button>
  </form>
<?php } ?>



<?php function output_header_wo_search(){ ?>
  <header>
        <h1><a href="frontPage.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils" id="utensils"></i>

        <div class = "l" id="loginForm">
            <?php 
            if (isset($_SESSION['id'])){ 
                    drawLogoutForm($_SESSION['name'])?>
                    
                
<?php            }
            else{ ?>
                
                    <div class="login">
                        <a href="login_register.php">Login | Register</a>
                    </div>
<?php       }
                ?>
            
        </div>
        

            
    </header>
<?php } ?>

<?php function output_header(){ ?>
  <header>
        <h1><a href="frontPage.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils" id="utensils"></i>
  
        <div class = "l" id="loginForm">
            <?php 
            if (isset($_SESSION['id'])){ 
                    drawLogoutForm($_SESSION['name'])?>
                    
                
<?php            }
            else{ ?>
                
                    <div class="login">
                        <a href="login_register.php">Login | Register</a>
                    </div>
<?php       }
                ?>
            
        </div>
        <div class="search">
            <input type="text" id="searchrestaurant" class="searchInput" name="search" placeholder="search...">
            <i class="fa-solid fa-magnifying-glass" id="magnifyingGlass"></i>
        </div>
            
    </header>
<?php } ?>



<?php function output_footer(){ ?>
  <footer>
        <div class="footer-content">
            <h3>Descubra e reserve dos melhores restaurantes</h3>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2022 Rasca Eats</p>
        </div>
    </footer>
<?php } ?>



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