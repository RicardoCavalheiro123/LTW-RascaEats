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
    $username = $client['username'];
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
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<?php output_header_wo_search()?>
    <div class="profile">
        <div class="header">

            <h1>Profile Page</h1>

            <img class="avatar" src="pinheiro.jpg" alt="Avatar">
    </div>



    <div class="details">
        <h1>Details</h1>
        <div class="row">
            <span class="bold">Name:</span> <p><?=$name?></p>
            <form action="edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "name" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Username:</span> <p><?=$username?></p>
            <form action="edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "username" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Email:</span> <p><?=$email?></p>
            <form action="edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "email" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Password:</span> <p>***</p>
            <form action="edit_profile.php" method="post" class="logout">
                <button class="button-3"  name = "password" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Adress:</span> <p><?=$adress?></p>
            <form action="edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "adress" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Phone Number:</span> <p><?=$phoneNumber?></p>
            <form action="edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "phoneNumber" role="button">Edit <i class="fa-solid fa-pen-to-square"></i> </button>
            </form>
        </div>
    </div>
 
</div>
<?php output_footer() ?>

</body>
</html>