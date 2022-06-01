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
        $stmt = $db->prepare('SELECT * FROM client WHERE username = ?');
        $stmt->execute(array($username));
        $validLogin = $stmt->fetch();
        if($validLogin && password_verify($password,$validLogin['password'])){
            
            $_SESSION['id'] = $validLogin['clientId'];
            $_SESSION['name'] = $username; 
        
            header('Location: frontpage.php');
        }
        else{
            $_SESSION["error1"] = "Username or Password incorrect";
            header("location: login_register.php");
        }


    }
    if(isset($_POST['submit_register'])){
        $fullName = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $adress = $_POST['adress'];
        $phoneNumber = $_POST['phone_number'];
        //verify if username, phoneNumber and mail are unique
        $stmt = $db->prepare('SELECT * FROM client WHERE username = ?');
        $stmt->execute(array($username));
        $userExists = $stmt->fetch();
        $stmt = $db->prepare('SELECT * FROM client WHERE phoneNumber = ?');
        $stmt->execute(array($phoneNumber));
        $phoneExists = $stmt->fetch();
        $stmt = $db->prepare('SELECT * FROM client WHERE email = ?');
        $stmt->execute(array($email));
        $emailExists = $stmt->fetch();

        if($userExists){
            $_SESSION["error1"] = "Username already used";
            header("location: login_register.php");
        }
        else if($phoneExists){
            $_SESSION["error1"] = "Phone Number already used";
            header("location: login_register.php");
        }
        else if($emailExists){
            $_SESSION["error1"] = "Email already used";
            header("location: login_register.php");
        }
        else{
            $options = ['cost => 12'];
            $stmt = $db->prepare('INSERT INTO Client(clientName, email, phoneNumber, adress, password, username) VALUES(? ,?,?,?, ?, ?)');
            $stmt->execute(array($fullName, $email, $phoneNumber, $adress, password_hash($password,PASSWORD_DEFAULT, $options), $username));
            $stmt = $db->prepare('SELECT clientId FROM Client WHERE username = ?');
            $stmt->execute(array($username));
            $id = $stmt->fetch();
            $_SESSION['id'] = $id['clientId'];
            $_SESSION['name'] = $username; 
            header('Location: frontpage.php');
        }   

    }

?>