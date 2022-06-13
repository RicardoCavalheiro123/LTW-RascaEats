<?php 
    declare(strict_types = 1); 
     function drawLogoutForm(string $name, $db) { 
        $stmt = $db->prepare('SELECT * FROM Restaurant WHERE ownerId = ?');
        $stmt->execute(array($_SESSION['id']));

        $isOwner = $stmt->fetch();
    
    ?>

  <form action="actionlogout.php" method="post" class="logout">
    <?php 
    if($isOwner){ ?>
        <a href="restaurants.php">Meus Restaurantes<a>
    <?php }
    else{ ?>
        <a href="register_restaurant.php">Registar um Restaurante<a> <?php
    } ?>
    

    <a href="orders.php">Minhas encomendas</a>
    
    <a href="profilePage.php"><?=$name?></a>
    <?php if(isset($_SESSION['img'])){
            ?>
            <img src= "<?php echo $_SESSION['img']; ?>" alt="1" style="width:2%">
            <?php
            }
            ?>
    <button class="button-4" role="button">Logout</button>
  </form>
<?php } ?>



<?php function output_header_wo_search($db){ ?>
  <header>
        <h1><a href="frontPage.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils" id="utensils"></i>

        <div class = "l" id="loginForm">
            <?php 
            if (isset($_SESSION['id'])){ 
                    drawLogoutForm($_SESSION['name'], $db);
                    
                    
                  ?>  
                
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

<?php function output_header($db){ ?>
  <header>
        <h1><a href="frontPage.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils" id="utensils"></i>
  
        <div class = "l" id="loginForm">
            <?php 
            if (isset($_SESSION['id'])){ 
                    drawLogoutForm($_SESSION['name'], $db)?>
                    
                
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






