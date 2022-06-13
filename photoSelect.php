<?php 
    declare(strict_types = 1);
    session_start();
    if (!isset($_SESSION['id'])) die(header('Location: /'));
    require_once('sql/connection.php');
    require_once('sql/client.php');
    require_once('templates/common.php');

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7dd8778261.js" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>
<body>
<?php output_header_wo_search($db)?>
<div id="photos">
<form action="server_edit.php" method="post" class="photoChoose">
    <div class="row">
        <div class="column">
            <img src="images/user1.png" alt="1" style="width:100%">
            <span class="bold"><p>1</p></span>
                
        </div>
        <div class="column">
            <img src="images/user2.png" alt="2" style="width:100%">
            <span class="bold"><p>2</p></span>
        </div>
        <div class="column">
            <img src="images/user3.png" alt="3" style="width:100%">
            <span class="bold"><p>3</p></span>
        </div>
        <div class="column">
            <img src="images/user4.png" alt="4" style="width:100%">
            <span class="bold"><p>4</p></span>
        </div>
        <div class="column">
            <img src="images/user5.png" alt="5" style="width:100%">
            <span class="bold"><p>5</p></span>
        </div>
        </div>
        <p>Choose User Photo</p>
         <span class="custom-dropdown">
            <select name = "userPhoto" id = "userPhoto">    
                <option value = 1>1</option>
                <option value = 2>2</option>  
                <option value = 3>3</option>
                <option value = 4>4</option>
                <option value = 5>5</option>
            </select>
        </span>
        
            <button class="button-3" name = "namebtn" role="button">Save</button>
    </form>
</div>
        

<?php output_footer() ?>


</body>
</html>