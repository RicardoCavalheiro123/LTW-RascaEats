<?php
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__. '/../sql/connection.php');
    require_once(__DIR__. '/../sql/client.class.php');
    $db = getDatabaseConnection();
    

    $db = getDatabaseConnection();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $userPhoto = filter_input(INPUT_POST, 'userPhoto', FILTER_SANITIZE_STRING);
      


    if($userPhoto) {
      $fileName = "../images/user" .$userPhoto .".png";
      $_SESSION['img'] =  $fileName; 
      $stmt = $db->prepare('
        Update Client set photo = ?
        WHERE clientId = ?
      ');
        
        $stmt->execute(array($fileName,$_SESSION['id']));
        header('Location: ../pages/profile_page.php');
    }
    if(isset($_POST['namebtn'])){
        $stmt = $db->prepare('
        Update Client set clientName = ?
        WHERE clientId = ?
      ');
    
        $stmt->execute(array($_POST['newName'],$_SESSION['id']));
        header('Location: ../pages/profile_page.php');

    }

    if(isset($_POST['usernamebtn'])){

        $stmt = $db->prepare('
        Update Client set username = ?
        WHERE clientId = ?
      ');
    
        $stmt->execute(array($_POST['newUsername'],$_SESSION['id']));
        header('Location: ../pages/profile_page.php');

    }

    if(isset($_POST['passwordbtn'])){
        echo $_POST['password1'];
        echo $_POST['password2'];
        
        if($_POST['password1'] == $_POST['password2']){
            $stmt = $db->prepare('
            Update Client set password = ?
            WHERE clientId = ?
          ');
          $options = ['cost => 12'];
            $stmt->execute(array(password_hash($_POST['password1'],PASSWORD_DEFAULT, $options),$_SESSION['id']));
            header('Location: ../pages/profile_page.php');
        }
        else{
            $_SESSION["error"] = "Passwords do not match";

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        
    }

    if(isset($_POST['emailbtn'])){
        $stmt = $db->prepare('
        Update Client set email = ?
        WHERE clientId = ?
      ');
    
        $stmt->execute(array($_POST['newEmail'],$_SESSION['id']));
        header('Location: ../pages/profile_page.php');
    }
    if(isset($_POST['adressbtn'])){
        
        $stmt = $db->prepare('
        Update Client set adress = ?
        WHERE clientId = ?
      ');
    
        $stmt->execute(array($_POST['newAdress'],$_SESSION['id']));
        header('Location: ../pages/profile_page.php');
    }
    if(isset($_POST['phoneNumberbtn'])){
        
        $stmt = $db->prepare('
        Update Client set phoneNumber = ?
        WHERE clientId = ?
      ');
    
        $stmt->execute(array($_POST['newPhone_number'],$_SESSION['id']));
        header('Location: ../pages/profile_page.php');
    }
    
    if(isset($_POST['phoneNumberbtn'])){
        
      $stmt = $db->prepare('
      Update Client set phoneNumber = ?
      WHERE clientId = ?
    ');
  
      $stmt->execute(array($_POST['newPhone_number'],$_SESSION['id']));
      header('Location: ../pages/profile_page.php');
  }
    
  header('Location: ../pages/profile_page.php');
  
  
    

    
?>