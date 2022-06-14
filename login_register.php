<?php 
session_start();
require_once('sql/connection.php');
require_once('sql/restaurant.class.php');

require_once('templates/common.php');

$db = getDatabaseConnection();
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$categories = Restaurant::getCategories($db);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Ex</title>
</head>
<body>
<?php output_header_wo_search($db) ?>
    <div class="hero">
    
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log in</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form id="login" action= "actions/action_login_register.php" method="POST" class = "input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" class = "input-field" name = "username" placeholder="Username" required>
                <i class="fa-solid fa-lock"></i>
                <input type="password" class = "input-field" name = "password" placeholder="Password" required>
                <button type="submit" name = "submit_login2" class = "submit-btn">Log in</button>
                <?php
                    if(isset($_SESSION["error1"])){
                        $error = $_SESSION["error1"];
                        echo "<div class= error-message>
                                <span class= error-text > $error </span>
                            </div>";
                        }
                ?>  
            </form>
            <form id="register" action = "actions/action_login_register.php" method = "POST" class = "input-group">
                <i class="fa-solid fa-signature"></i>
                <input type="text" class = "input-field" name = "name" placeholder= " Full Name" required>
                <i class="fa-solid fa-user"></i>
                <input type="text" class = "input-field" name = "username" placeholder="Username" required>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" class = "input-field" name = "email" placeholder="Email" required>
                <i class="fa-solid fa-lock"></i>
                <input type="password" class = "input-field" name = "password" placeholder="Password" required>
                <i class="fa-solid fa-map-location-dot"></i>
                <input type="text" class = "input-field" name = "adress" placeholder="Adress" required>
                <i class="fa-solid fa-phone"></i>
                <input type="tel" class = "input-field" name = "phone_number" placeholder="Phone Number" required>
                <button type="submit" name = "submit_register" class = "submit-btn">Register</button>
                <?php
                    if(isset($_SESSION["error1"])){
                        $error = $_SESSION["error1"];
                        echo "<div class= error-message>
                                <span class= error-text > $error </span>
                            </div>";
                        
                    }
                ?> 
            </form>
        </div>
        
        
    </div>
    <footer>
            <div class="footer-content">
                <h3>Descubra e reserve dos melhores restaurantes</h3>
            </div>
            <div class="footer-bottom">
                <p>copyright &copy;2022 Rasca Eats</p>
            </div>
    </footer>

    <script>
        var x = document.getElementById("login")
        var y = document.getElementById("register")
        var z = document.getElementById("btn")
        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
    }
    </script>
    
    
    </body>
</html>
<?php
    unset($_SESSION["error1"]);
?>