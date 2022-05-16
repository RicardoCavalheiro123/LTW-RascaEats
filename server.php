<?php
    declare(strict_types = 1);

    session_start();

    require_once('sql/connection.php');
    require_once('sql/restaurant.php');
    require_once('sql/client.php');
    $db = getDatabaseConnection();
    $username = "";
    $email = "";
    $adress = "";
    $phoneNumber = 0;

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);




    //Login

    if(isset($_POST['submit_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $db->prepare('SELECT * FROM client WHERE username = ? and password = ?');
        $stmt->execute(array($username,$password));
        $validLogin = $stmt->fetch();
        if($validLogin){
            //$clientId = client::getClientId($db, $username, $password);
            if($validLogin){
                $_SESSION['id'] = $validLogin['clientId'];
                $_SESSION['name'] = $username; 
            }
            header('Location: frontpage.php');
        }
        else{
            $_SESSION["error"] = "Username or Password incorrect";
            header("location: login_register.php");
        }


    }
    if(isset($_POST['submit_register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $adress = $_POST['adress'];
        $phoneNumber = $_POST['phone_number'];
        $stmt = $db->prepare('SELECT * FROM client WHERE username = ?');
        $stmt->execute(array([$username]));
        $userExists = $stmt->fetch();
        if($userExists){
            echo "username already exists in database";
        }
        else{
            echo "user does not exist in database";
        }

    }

?>