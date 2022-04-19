<?php 

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $restaurants = getRestaurants($db);



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


    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log in</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form id="login" class = "input-group">
                <input type="text" class = "input-field" placeholder="Username" required>
                <input type="text" class = "input-field" placeholder="Password" required>
                <button type="submit" class = "submit-btn">Log in</button>
            </form>
            <form id="register" class = "input-group">
                <input type="text" class = "input-field" placeholder="Username" required>
                <input type="email" class = "input-field" placeholder="Email" required>
                <input type="text" class = "input-field" placeholder="Password" required>
                <input type="checkbox" class= "check-box"><span>I agree to the terms & conditions</span>
                <button type="submit" class = "submit-btn">Register</button>
            </form>
        </div>
    </div>
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

    <section id= "restaurants">
        
    </section>

    </body>
</html>