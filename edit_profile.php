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
    /*$name = $client['clientName'];
    $email = $client['email'];
    $adress = $client['adress'];
    $phoneNumber = $client['phoneNumber'];
    $password = $client['password'];*/
    $photo =  $client['photo'];
    $photoSelected = True;
    if(is_null($photo)) $photoSelected = False;

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
<?php output_header_wo_search()?>
    <div class="profile">
        <div class="header">

            <h1>Profile Page</h1>

            <?php 
            if($photoSelected){ ?>
 
            <img class="avatar" src=<?php echo $photo ?> alt="Avatar">                   

            <?php
            }
            else{ ?>
            <?php echo $photo ?>
                <span class="bold"><p>You didn't select a photo yet!</p></span>

                <?php
            }
            
            ?> </div>


    <div class="details">
        <h1>Details</h1>
        <form action="server_edit.php" method="post" class="logout">
        <?php 
            if(isset($_POST['name1'])){ ?>
                <div class="row">
                <input type="text" class = "input-field" name = "newName" placeholder= " Full Name" required>
                
                    <button class="button-3" name = "namebtn" role="button">Save</button>
                    
                
            </div> 

            <?php

            }
            
           
          
            else if(isset($_POST['username'])){ ?>
              <div class="row">
              <input type="text" class = "input-field" name = "newUsername" placeholder="Username" required>

                <button class="button-3" name = "usernamebtn" role="button">Save</button>

        </div>

            <?php

            }
            


          
            else if(isset($_POST['email'])){ ?>
                <div class="row">
            <input type="email" class = "input-field" name = "newEmail" placeholder="Email" required>

                <button class="button-3" name = "emailbtn" role="button">Save</i></button>

        </div>

            <?php

            }
            

         
            else if(isset($_POST['adress'])){ ?>
                <div class="row">
            <input type="text" class = "input-field" name = "newAdress" placeholder="Adress" required>

                <button class="button-3" name = "adressbtn" role="button">Save</button>

        </div>

            <?php

            }
            
    
    

    
      
            else if(isset($_POST['phoneNumber'])){ ?>
                <div class="row">
            <input type="tel" class = "input-field" name = "newPhone_number" placeholder="Phone Number" required>

                    <button class="button-3" name = "phoneNumberbtn" role="button">Save</i></button>

            </div>
        </div>

            <?php

            }
            

 
            else if(isset($_POST['password']) || isset($_SESSION["error"])){ ?>
             <div class="row">
            <input type="password" class = "input-field" name = "password1" placeholder="Password" required>
            <input type="password" class = "input-field" name = "password2" placeholder="Confirm your Password" required>
            
                <button class="button-3" name = "passwordbtn" role="button">Save </button>

        </div>

            <?php

            if(isset($_SESSION["error"])){
                $error = $_SESSION["error"];
                echo "<div class=row>
                    <div class= error-message>
                            <span class= error-text > $error  </span>
                        </div>
                    </div>";
                
                }


            }
           
            
            else{
                header('Location: frontpage.php');
            }
            ?>
        
        </form>
        
    
 
</div>
<?php output_footer() ?>

</body>
</html>
<?php
    unset($_SESSION["error"]);
?>