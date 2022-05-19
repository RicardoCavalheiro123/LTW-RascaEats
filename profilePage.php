<?php 
    declare(strict_types = 1);
    session_start();
    if (!isset($_SESSION['id'])) die(header('Location: /'));
    require_once('sql/connection.php');
    require_once('sql/client.php');
    require_once('templates/common.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $db->prepare('SELECT * FROM client WHERE clientId = ?');
    $stmt->execute(array($_SESSION['id']));
    $client = $stmt->fetch();
    $name = $client['clientName'];
    $email = $client['email'];
    $adress = $client['adress'];
    $phoneNumber = $client['phoneNumber'];
    $password = $client['password'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<header>
        <h1><a href="frontPage.php">Rasca Eats</a></h1>
        <i class="fa-solid fa-utensils"></i>

        <form action="https://www.google.pt/?hl=pt-PT" method="get" id="loginForm">
            <?php 
            if (isset($_SESSION['id'])){ ?>
                    <form action="actionlogout.php" method="get" id="logout2">
                        <a href="profilePage.php"> <?php echo $_SESSION['name'] ?> </a>
                        <a href="actionlogout.php">Logout</a>
                    </form>
                    
                
<?php            }
            else{ ?>
                
                    <div class="login">
                        <a href="login_register.php">Login | Register</a>
                    </div>
<?php       }
                ?>
            
        </form>
        

            
    </header>
    <div class="profile">
        <div class="header">

            <h1>Profile Page</h1>

            <img class="avatar" src="pinheiro.jpg" alt="Avatar">
    </div>



    <div class="details">
        <h1>Details</h1>

        <span class="bold">Name:</span> <p><?=$name?></p>
            <span class="bold">Email:</span> <p><?=$email?></p>
            <span class="bold">Password:</span> <p>***</p>
            <span class="bold">Adress:</span> <p><?=$adress?></p>
            <span class="bold">Phone Number:</span> <p><?=$phoneNumber?></p>
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

</body>
</html>